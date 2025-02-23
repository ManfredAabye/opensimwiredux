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
if (isset($_SESSION['ADMINUID']) && $_SESSION['ADMINUID'] == $ADMINCHECK) {
    $DbLink = new DB;

    // Verarbeite das Formular für Benutzerdaten
    if (isset($_POST['userdata']) && $_POST['userdata'] == "set") {
        $uuid = $_POST['uuid'] ?? '';
        $accfirst = $_POST['accfirst'] ?? '';
        $acclast = $_POST['acclast'] ?? '';
        $fname = $_POST['fname'] ?? '';
        $lname = $_POST['lname'] ?? '';
        $street = $_POST['street'] ?? '';
        $zip = $_POST['zip'] ?? '';
        $city = $_POST['city'] ?? '';
        $country = $_POST['country'] ?? '';
        $email = $_POST['email'] ?? '';

        // Überprüfe, ob der Benutzer existiert
        $DbLink->query("SELECT UUID FROM " . C_USERS_TBL . " WHERE username = ? AND lastname = ?", [$accfirst, $acclast]);
        $CHECKUSER = $DbLink->next_record()[0] ?? null;

        // Aktualisiere die Benutzerdaten
        $DbLink->query("UPDATE " . C_WIUSR_TBL . " SET 
            realname1 = ?,
            realname2 = ?,
            adress1 = ?,
            zip1 = ?,
            city1 = ?,
            country1 = ?,
            emailadress = ?
            WHERE UUID = ?", [$fname, $lname, $street, $zip, $city, $country, $email, $uuid]);

        if (!$CHECKUSER) {
            $DbLink->query("UPDATE " . C_WIUSR_TBL . " SET 
                username = ?,
                lastname = ?
                WHERE UUID = ?", [$accfirst, $acclast, $uuid]);

            $DbLink->query("UPDATE " . C_USERS_TBL . " SET 
                username = ?,
                lastname = ?
                WHERE UUID = ?", [$accfirst, $acclast, $uuid]);
        }

        echo "<script language='javascript'>
        <!--
        window.location.href='index.php?page=edit&userid=" . htmlspecialchars($uuid) . "';
        // -->
        </script>";
    }

    // Verarbeite das Formular für den Status
    if (isset($_POST['state']) && $_POST['state'] == "set") {
        $uuid = $_POST['uuid'] ?? '';
        $status = $_POST['status'] ?? '';
        $active = $_POST['active'] ?? '';

        $DbLink->query("SELECT UUID, username, lastname, passwordHash, created FROM " . C_USERS_TBL . " WHERE UUID = ?", [$uuid]);
        list($uuid, $username, $lastname, $password, $created) = $DbLink->next_record();

        $DbLink->query("SELECT passwordHash, active FROM " . C_WIUSR_TBL . " WHERE UUID = ?", [$uuid]);
        list($passbkp, $active) = $DbLink->next_record();

        if ($active != 3) {
            if ($status == 0) {
                $DbLink->query("UPDATE " . C_USERS_TBL . " SET passwordHash = '' WHERE UUID = ?", [$uuid]);
                $DbLink->query("UPDATE " . C_WIUSR_TBL . " SET active = ? WHERE UUID = ?", [$status, $uuid]);
            } else {
                $DbLink->query("UPDATE " . C_USERS_TBL . " SET passwordHash = ? WHERE UUID = ?", [$passbkp, $uuid]);
                $DbLink->query("UPDATE " . C_WIUSR_TBL . " SET active = ? WHERE UUID = ?", [$status, $uuid]);
            }
        } else {
            if ($status == 1) {
                $DbLink->query("SELECT passwordSalt FROM " . C_WIUSR_TBL . " WHERE UUID = ?", [$uuid]);
                list($passSalt) = $DbLink->next_record();

                $DbLink->query("UPDATE " . C_USERS_TBL . " SET passwordHash = ? WHERE UUID = ?", [$passSalt, $uuid]);
                $DbLink->query("UPDATE " . C_WIUSR_TBL . " SET passwordHash = ?, active = ?, passwordSalt = '' WHERE UUID = ?", [$passSalt, $status, $uuid]);
                $DbLink->query("DELETE FROM " . C_CODES_TBL . " WHERE UUID = ?", [$uuid]);
            }
        }

        echo "<script language='javascript'>
        <!--
        window.location.href='index.php?page=edit&userid=" . htmlspecialchars($uuid) . "';
        // -->
        </script>";
    }

    // Lade Benutzerdaten
    $uuid = $_GET['userid'] ?? '';
    $DbLink->query("SELECT UUID, username, lastname FROM " . C_USERS_TBL . " WHERE UUID = ?", [$uuid]);
    list($uuid, $accfirst, $acclast) = $DbLink->next_record();

    $DbLink->query("SELECT realname1, realname2, adress1, zip1, city1, country1, emailadress FROM " . C_WIUSR_TBL . " WHERE UUID = ?", [$uuid]);
    list($firstnm, $lastnm, $street, $zip, $city, $country, $email) = $DbLink->next_record();

    $DbLink->query("SELECT a.active, (SELECT info FROM " . C_CODES_TBL . " b WHERE b.uuid = a.uuid) as confirm FROM " . C_WIUSR_TBL . " a WHERE UUID = ?", [$uuid]);
    list($active, $confirm) = $DbLink->next_record();

    if ($confirm == 'confirm') {
        $active = 3;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Edit User</title>
    <style type="text/css">
    <!--
    .Stil3 {font-size: 16px; font-weight: bold; }
    .Stil4 {font-size: 16px}
    .style1 {
        font-size: 2px;
        color: #FFFFFF;
    }
    .style2 {
        color: #666666;
        font-weight: bold;
    }
    .box {
        font-size: 12px;
        height: 20px;
    }
    -->
    </style>
</head>
<body>
    <table width="100%" height="100%" border="0">
        <tr>
            <td><div align="center" class="Stil3"></div></td>
        </tr>
        <tr>
            <td>
                <table width="600" border="0" align="center" cellpadding="0" cellspacing="15" bgcolor="#FFFFFF">
                    <tr>
                        <td>
                            <table width="600" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#999999">
                                <form name="form1" method="post" action="index.php?page=edit">
                                    <input type="hidden" name="userdata" value="set" />
                                    <input type="hidden" name="uuid" value="<?php echo htmlspecialchars($uuid); ?>" />
                                    <tr>
                                        <td class="style2">USERID</td>
                                        <td bgcolor="#CCCCCC">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" bgcolor="#CCCCCC"><?php echo htmlspecialchars($uuid); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" bgcolor="#FFFFFF" class="style1">.</td>
                                    </tr>
                                    <tr>
                                        <td class="style2">Account first name</td>
                                        <td class="style2">Account last name</td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#CCCCCC" class="style2">
                                            <input style="width:70%" name="accfirst" type="text" id="accfirst" value="<?php echo htmlspecialchars($accfirst); ?>" />
                                        </td>
                                        <td bgcolor="#CCCCCC" class="style2">
                                            <input style="width:70%" name="acclast" type="text" id="acclast" value="<?php echo htmlspecialchars($acclast); ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#CCCCCC" class="style2">&nbsp;</td>
                                        <td bgcolor="#CCCCCC" class="style2">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" bordercolor="#ECE9D8" bgcolor="#FFFFFF" class="style1">.</td>
                                    </tr>
                                    <tr>
                                        <td width="296" class="style2">Real first name</td>
                                        <td width="298" class="style2">Real last name</td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#CCCCCC"><input style="width:70%" name="fname" type="text" id="fname" value="<?php echo htmlspecialchars($firstnm); ?>" /></td>
                                        <td bgcolor="#CCCCCC"><input style="width:70%" name="lname" type="text" id="lname" value="<?php echo htmlspecialchars($lastnm); ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" bgcolor="#FFFFFF" class="style1">.</td>
                                    </tr>
                                    <tr>
                                        <td class="style2">Street</td>
                                        <td class="style2">City</td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#CCCCCC"><input style="width:70%" name="street" type="text" id="street" value="<?php echo htmlspecialchars($street); ?>" /></td>
                                        <td bgcolor="#CCCCCC">
                                            <input name="zip" type="text" id="city" value="<?php echo htmlspecialchars($zip); ?>" size="8" />
                                            <input name="city" type="text" id="street2" value="<?php echo htmlspecialchars($city); ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" bgcolor="#FFFFFF" class="style1">.</td>
                                    </tr>
                                    <tr>
                                        <td class="style2">Country</td>
                                        <td bgcolor="#CCCCCC">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#CCCCCC">
                                            <select class="box" name="country">
                                                <?php
                                                $DbLink->query("SELECT name FROM " . C_COUNTRY_TBL . " ORDER BY name ASC");
                                                while ($record = $DbLink->next_record()) {
                                                    list($COUNTRYDB) = $record;
                                                    echo "<option value=\"" . htmlspecialchars($COUNTRYDB) . "\" " . ($country == $COUNTRYDB ? "selected" : "") . ">" . htmlspecialchars($COUNTRYDB) . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td bgcolor="#CCCCCC">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" bgcolor="#FFFFFF"><span class="style1">.</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="style2">Email</span></td>
                                        <td bgcolor="#CCCCCC">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td bgcolor="#CCCCCC"><input style="width:70%" name="email" type="text" id="email" value="<?php echo htmlspecialchars($email); ?>" /></td>
                                        <td bgcolor="#CCCCCC">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" bgcolor="#FFFFFF" class="style1">.</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" bgcolor="#CCCCCC">
                                            <div align="center">
                                                <input type="submit" name="Submit2" value="Save Changes" />
                                            </div>
                                        </td>
                                    </tr>
                                </form>
                                <tr>
                                    <td colspan="2" bgcolor="#FFFFFF" class="style1">.</td>
                                </tr>
                                <tr>
                                    <td bgcolor="#CCCCCC">&nbsp;</td>
                                    <td bgcolor="#CCCCCC">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="2" bgcolor="#CCCCCC">
                                        <table width="376" border="0" cellpadding="4" cellspacing="3" bordercolor="#FFFF00" bgcolor="#FFFFFF">
                                            <form name="form2" method="post" action="index.php?page=edit">
                                                <tr>
                                                    <td width="218" bgcolor="#999999"><span class="Stil4">Current Status:</span></td>
                                                    <td width="282"><span class="Stil4"><span class="Stil3">
                                                        <?php
                                                        if ($active == 1) {
                                                            echo "<FONT COLOR=#00FF00>Active</FONT>";
                                                        } elseif ($active == 3) {
                                                            echo "<FONT COLOR=#FF0000>Not Confirmed</FONT>";
                                                        } else {
                                                            echo "<FONT COLOR=#FF0000>Inactive</FONT>";
                                                        }
                                                        ?>
                                                    </span></span></td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor="#999999"><span class="Stil4">Set Status:</span></td>
                                                    <td><span class="Stil4">
                                                        <input type="hidden" name="state" value="set" />
                                                        <input type="hidden" name="uuid" value="<?php echo htmlspecialchars($uuid); ?>" />
                                                        <input type="hidden" name="active" value="<?php echo htmlspecialchars($active); ?>" />
                                                        <select name="status">
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                    </span></td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor="#FFFFFF">&nbsp;</td>
                                                    <td>
                                                        <div align="right">
                                                            <input type="submit" name="Submit" value="Save Status" />
                                                        </div>
                                                    </td>
                                                </tr>
                                            </form>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td bgcolor="#CCCCCC">&nbsp;</td>
                                    <td bgcolor="#CCCCCC">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <br />
                <br />
                <br />
                <br />
            </td>
        </tr>
    </table>
<?php
} else {
    echo "<script language='javascript'>
    <!--
    window.location.href='index.php?page=home';
    // -->
    </script>";
}
?>