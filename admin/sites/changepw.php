<?php
session_start();

/*
 * Copyright (c) 2007, 2008 Contributors, http://opensimulator.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 * Projekt opensimwiredux 2025
 *
 * See LICENSE for the full licensing terms of this file.
 */

include("../settings/config.php");
include("../settings/mysql.php");

// Überprüfe, ob der Benutzer ein Admin ist
if (isset($_SESSION['ADMINUID'])) {
    $DbLink = new DB;

    // Admin-Daten abrufen
    $DbLink->query("SELECT id, username, password FROM " . C_ADMIN_TBL . " WHERE password = ?", [$_SESSION['ADMINUID']]);
    $adminData = $DbLink->next_record();

    if ($adminData) {
        list($adminid, $username, $adminpass) = $adminData;

        // Passwortänderung verarbeiten
        if (isset($_POST['check']) && $_POST['check'] == "change") {
            $passnew = $_POST['passnew'] ?? '';
            $passvalid = $_POST['passvalid'] ?? '';
            $passold = $_POST['passold'] ?? '';
            $usernamenew = $_POST['usernamenew'] ?? '';

            if ($passnew === $passvalid) {
                // Überprüfe das alte Passwort
                if (password_verify($passold, $adminpass)) {
                    // Neues Passwort hashen
                    $password = password_hash($passnew, PASSWORD_DEFAULT);

                    // Admin-Daten aktualisieren
                    $DbLink->query("UPDATE " . C_ADMIN_TBL . " SET username = ?, password = ? WHERE id = ?", [$usernamenew, $password, $adminid]);

                    // Session zurücksetzen und zerstören
                    session_unset();
                    session_destroy();

                    // Weiterleitung zur Startseite
                    echo "<script language='javascript'>
                    <!--
                    window.location.href='index.php?page=home';
                    // -->
                    </script>";
                    exit;
                } else {
                    $ERROR = "Password doesn't match with the password in the database.";
                }
            } else {
                $ERROR = "Password validation doesn't match.";
            }
        }
    } else {
        // Wenn keine Admin-Daten gefunden wurden, leite zur Startseite weiter
        echo "<script language='javascript'>
        <!--
        window.location.href='index.php?page=home';
        // -->
        </script>";
        exit;
    }
} else {
    // Wenn der Benutzer nicht eingeloggt ist, leite zur Startseite weiter
    echo "<script language='javascript'>
    <!--
    window.location.href='index.php?page=home';
    // -->
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Change Admin Password</title>
    <style type="text/css">
    <!--
    .Stil1 {
        font-size: 18px;
        font-weight: bold;
    }
    -->
    </style>
</head>
<body>
    <table width="100%" height="100%" border="0" align="center">
        <tr>
            <td valign="top">
                <table width="50%" border="0" align="center">
                    <tr>
                        <td>
                            <p align="center" class="Stil1">Change Admin Password</p>
                        </td>
                    </tr>
                </table>
                <br />
                <form name="form1" method="post" action="index.php?page=changepw">
                    <table width="70%" height="199" border="0" align="center" cellpadding="5" cellspacing="5" bgcolor="#FFFFFF">
                        <tr>
                            <td valign="top">
                                <?php if (isset($ERROR)) { ?>
                                    <table width="81%" border="0" align="center">
                                        <tr>
                                            <td bgcolor="#E95249"><div align="center"><?php echo htmlspecialchars($ERROR); ?></div></td>
                                        </tr>
                                    </table>
                                <?php } ?>
                                <br>
                                <table width="80%" border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#999999">
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;New Username</td>
                                        <td valign="top"><input type="text" name="usernamenew" value="<?php echo htmlspecialchars($username); ?>"></td>
                                    </tr>
                                    <tr>
                                        <td width="48%">&nbsp;&nbsp;Old Password</td>
                                        <td width="52%">
                                            <input type="hidden" name="check" value="change" />
                                            <input type="password" name="passold">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;New Password</td>
                                        <td><input type="password" name="passnew"></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;Validate New Password</td>
                                        <td><input type="password" name="passvalid"></td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#999999">&nbsp;</td>
                                        <td bgcolor="#999999"><input type="submit" name="Submit" value="Save"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
        </tr>
    </table>
</body>
</html>