<?php
// Projekt opensimwiredux 2025

// Definieren der erforderlichen Konstanten
// define('C_CODES_TBL', 'wi_codetable'); // Beispiel: Name der Codes-Tabelle
// define('C_USERS_TBL', 'wi_users');    // Beispiel: Name der Benutzer-Tabelle
// define('C_WIUSR_TBL', 'wi_wiusr');    // Beispiel: Name der WI-User-Tabelle
// define('C_DB_HOST', 'localhost');     // Datenbank-Host
// define('C_DB_NAME', 'deine_datenbank'); // Datenbank-Name
// define('C_DB_USER', 'dein_benutzer'); // Datenbank-Benutzer
// define('C_DB_PASS', 'dein_passwort'); // Datenbank-Passwort

// Standardwert für $unconfirmed_deltime
$unconfirmed_deltime = 24; // Beispielwert in Stunden

// Datenbankverbindung herstellen
$DbLink = new DB;

// Löschen abgelaufener Passwort-Reset-Codes
$DbLink->query("DELETE FROM " . C_CODES_TBL . " WHERE (time + 86400) < ? AND info='pwreset'", [time()]);

// Löschen nicht bestätigter Benutzerkonten
if (!empty($unconfirmed_deltime)) {
    $deletetime = 60 * 60 * $unconfirmed_deltime;

    $DbLink->query("SELECT UUID FROM " . C_CODES_TBL . " WHERE (time + ?) < ? AND info='confirm'", [$deletetime, time()]);
    while ($record = $DbLink->next_record()) {
        if ($record === null) {
            break;
        }
        list($REGUUID) = $record;

        // Neue Datenbankverbindung für Löschoperationen
        $DbLink1 = new DB;
        $DbLink1->query("DELETE FROM " . C_USERS_TBL . " WHERE UUID=?", [$REGUUID]);
        $DbLink1->query("DELETE FROM " . C_WIUSR_TBL . " WHERE UUID=?", [$REGUUID]);
        $DbLink1->query("DELETE FROM " . C_CODES_TBL . " WHERE UUID=?", [$REGUUID]);

        // Schließen der zweiten Datenbankverbindung
        $DbLink1->close();
    }
}

// Schließen der ersten Datenbankverbindung
$DbLink->close();

/*
 * Copyright (c) 2007, 2008 Contributors, http://opensimulator.org/
 * Projekt opensimwiredux 2025
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 */

// Updated for PHP 8.3 using MySQLi

class DB
{
    private $Host = C_DB_HOST;          // Hostname of our MySQL server
    private $Database = C_DB_NAME;      // Logical database name on that server
    private $User = C_DB_USER;          // Database user
    private $Password = C_DB_PASS;      // Database user's password
    private $Link_ID = null;            // MySQLi connection object
    private $Query_ID = null;           // Result of most recent query
    private $Record = array();          // Current fetch_assoc() result
    private $Row = 0;                   // Current row number
    private $Errno = 0;                 // Error state of query
    private $Error = "";                // Error message

    /**
     * Handle database errors and halt execution.
     *
     * @param string $msg Custom error message
     */
    private function halt($msg)
    {
        echo "</TD></TR></TABLE><B>Database error:</B> $msg<BR>\n";
        echo "<B>MySQLi error:</B> $this->Errno ($this->Error)<BR>\n";
        die("Session halted.");
    }

    /**
     * Establish a connection to the MySQL server.
     */
    private function connect()
    {
        if ($this->Link_ID === null) {
            $this->Link_ID = new mysqli($this->Host, $this->User, $this->Password, $this->Database);

            if ($this->Link_ID->connect_error) {
                $this->Errno = $this->Link_ID->connect_errno;
                $this->Error = $this->Link_ID->connect_error;
                $this->halt("Connection failed: " . $this->Error);
            }
        }
    }

    /**
     * Escape a string for safe use in SQL queries.
     *
     * @param string $String The string to escape
     * @return string Escaped string
     */
    public function escape($String)
    {
        $this->connect();
        return $this->Link_ID->real_escape_string($String);
    }

    /**
     * Execute a SQL query.
     *
     * @param string $Query_String The SQL query to execute
     * @param array $params Optional parameters for prepared statements
     * @return mysqli_result|bool Query result
     */
    public function query($Query_String, $params = [])
    {
        $this->connect();

        // Vorbereitetes Statement verwenden, wenn Parameter vorhanden sind
        if (!empty($params)) {
            $stmt = $this->Link_ID->prepare($Query_String);
            if ($stmt === false) {
                $this->halt("Prepare failed: " . $this->Link_ID->error);
            }

            // Parameter binden
            $types = str_repeat('s', count($params)); // Annahme: alle Parameter sind Strings
            $stmt->bind_param($types, ...$params);

            // Statement ausführen
            $stmt->execute();

            // Ergebnis holen (nur für SELECT-Abfragen)
            if (strpos(strtoupper($Query_String), 'SELECT') === 0) {
                $this->Query_ID = $stmt->get_result();
            } else {
                $this->Query_ID = true; // Für INSERT, UPDATE, DELETE
            }

            $stmt->close();
        } else {
            // Normale Abfrage ohne Parameter
            $this->Query_ID = $this->Link_ID->query($Query_String);
        }

        // Fehlerbehandlung
        $this->Row = 0;
        $this->Errno = $this->Link_ID->errno;
        $this->Error = $this->Link_ID->error;

        if (!$this->Query_ID) {
            $this->halt("Invalid SQL: " . $Query_String);
        }

        return $this->Query_ID;
    }

    /**
     * Fetch the next record from the result set.
     *
     * @return array|null Associative array of the next record, or null if no more records
     */
    public function next_record()
    {
        if ($this->Query_ID instanceof mysqli_result) {
            $this->Record = $this->Query_ID->fetch_assoc();
            $this->Row += 1;

            if (!$this->Record) {
                $this->Query_ID->free();
                $this->Query_ID = null;
            }
        } else {
            $this->Record = null;
        }

        return $this->Record;
    }

    /**
     * Get the number of rows in the result set.
     *
     * @return int Number of rows
     */
    public function num_rows()
    {
        return ($this->Query_ID instanceof mysqli_result) ? $this->Query_ID->num_rows : 0;
    }

    /**
     * Get the number of affected rows by the last query.
     *
     * @return int Number of affected rows
     */
    public function affected_rows()
    {
        return $this->Link_ID->affected_rows;
    }

    /**
     * Optimize a table.
     *
     * @param string $tbl_name Name of the table to optimize
     */
    public function optimize($tbl_name)
    {
        $this->connect();
        $this->Query_ID = $this->Link_ID->query("OPTIMIZE TABLE $tbl_name");
    }

    /**
     * Clean up the result set.
     */
    public function clean_results()
    {
        if ($this->Query_ID instanceof mysqli_result) {
            $this->Query_ID->free();
            $this->Query_ID = null;
        }
    }

    /**
     * Close the database connection.
     */
    public function close()
    {
        if ($this->Link_ID !== null) {
            $this->Link_ID->close();
            $this->Link_ID = null;
        }
    }
}
?>