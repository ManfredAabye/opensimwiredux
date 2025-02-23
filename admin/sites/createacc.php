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
    if (!isset($_GET['aktion'])) {
        if (!isset($_POST['action'])) {
            // Initialisiere Session-Variablen
            $_SESSION['PASSWD'] = "";
            $_SESSION['EMAIC'] = "";

            $DbLink = new DB;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Create Account</title>
    <style type="text/css">
    <!--
    .box {
        font-size: 12px;
        height: 20px;
    }
    -->
    </style>
</head>
<body>
    <form action="index.php?page=createacc" method="post">
        <table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td valign="top">
                    <table width="600" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
                        <?php if (isset($_SESSION['ERROR'])) { ?>
                        <tr>
                            <td colspan="2" bgcolor="#E95249"><div align="center"><?php echo htmlspecialchars($_SESSION['ERROR']); ?></div></td>
                        </tr>
                        <?php } else { ?>
                        <br>
                        <?php } ?>
                        <tr>
                            <td width="176" bgcolor="#999999"><?php echo htmlspecialchars(SYSNAME); ?> Firstname*</td>
                            <td width="410" bgcolor="#CCCCCC"><input class="box" name="accountfirst" type="text" size="25" maxlength="15" value="<?php echo htmlspecialchars($_SESSION['ACCFIRST'] ?? ''); ?>"></td>
                        </tr>
                        <tr>
                            <td bgcolor="#999999"><?php echo htmlspecialchars(SYSNAME); ?> Lastname*</td>
                            <td bgcolor="#CCCCCC">
                                <select class="box" name="accountlast">
                                    <?php
                                    $DbLink->query("SELECT name FROM " . C_NAMES_TBL . " WHERE active=1 ORDER BY name ASC");
                                    while ($record = $DbLink->next_record()) {
                                        list($NAMEDB) = $record;
                                        echo "<option>" . htmlspecialchars($NAMEDB) . "</option>";
                                    }
                                    ?>
                                </select>
                                or this:
                                <input name="accountlast2" type="text" class="box" id="accountlast2" value="<?php echo htmlspecialchars($_SESSION['ACCLAST'] ?? ''); ?>" size="25" maxlength="15" />
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#999999"><?php echo htmlspecialchars(SYSNAME); ?> Password*</td>
                            <td bgcolor="#CCCCCC"><input class="box" name="wordpass" type="password" size="25" maxlength="15"></td>
                        </tr>
                        <tr>
                            <td bgcolor="#999999">Start Region*</td>
                            <td bgcolor="#CCCCCC">
                                <select class="box" name="region">
                                    <?php
                                    $DbLink->query("SELECT regionName, regionHandle FROM " . C_REGIONS_TBL . " ORDER BY regionName ASC");
                                    while ($record = $DbLink->next_record()) {
                                        list($regionName, $regionHandle) = $record;
                                        echo "<option value=\"" . htmlspecialchars($regionHandle) . "\">" . htmlspecialchars($regionName) . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#999999"><em>First Name</em></td>
                            <td bgcolor="#CCCCCC"><input class="box" name="firstname" type="text" size="25" maxlength="15" value="<?php echo htmlspecialchars($_SESSION['NAMEF'] ?? ''); ?>"></td>
                        </tr>
                        <tr>
                            <td bgcolor="#999999"><em>Last Name</em></td>
                            <td bgcolor="#CCCCCC"><input class="box" name="lastname" type="text" size="25" maxlength="15" value="<?php echo htmlspecialchars($_SESSION['NAMEL'] ?? ''); ?>"></td>
                        </tr>
                        <tr>
                            <td bgcolor="#999999"><em>Address</em></td>
                            <td bgcolor="#CCCCCC"><input class="box" name="adress" type="text" size="50" maxlength="60" value="<?php echo htmlspecialchars($_SESSION['ADRESS'] ?? ''); ?>"></td>
                        </tr>
                        <tr>
                            <td bgcolor="#999999"><em>Zip</em></td>
                            <td bgcolor="#CCCCCC"><input class="box" name="zip" type="text" size="25" maxlength="15" value="<?php echo htmlspecialchars($_SESSION['ZIP'] ?? ''); ?>"></td>
                        </tr>
                        <tr>
                            <td bgcolor="#999999"><em>City</em></td>
                            <td bgcolor="#CCCCCC"><input class="box" name="city" type="text" size="25" maxlength="15" value="<?php echo htmlspecialchars($_SESSION['CITY'] ?? ''); ?>"></td>
                        </tr>
                        <tr>
                            <td bgcolor="#999999"><em>Country</em></td>
                            <td bgcolor="#CCCCCC">
                                <select class="box" name="country">
                                    <?php
                                    $DbLink->query("SELECT name FROM " . C_COUNTRY_TBL . " ORDER BY name ASC");
                                    while ($record = $DbLink->next_record()) {
                                        list($COUNTRYDB) = $record;
                                        echo "<option>" . htmlspecialchars($COUNTRYDB) . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#999999"><em>Date of Birth</em></td>
                            <td bgcolor="#CCCCCC">
                                <table cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                        <td>
                                            <select class="box" name="tag">
                                                <?php for ($i = 1; $i <= 31; $i++) { ?>
                                                    <option value="<?php echo $i; ?>" <?php if (isset($_SESSION['tag']) && $_SESSION['tag'] == $i) echo "selected"; ?>><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
                                            <select class="box" name="monat">
                                                <?php for ($i = 1; $i <= 12; $i++) { ?>
                                                    <option value="<?php echo $i; ?>" <?php if (isset($_SESSION['monat']) && $_SESSION['monat'] == $i) echo "selected"; ?>><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
                                            <select class="box" name="jahr">
                                                <?php
                                                $jetzt = getdate();
                                                $jahr1 = $jetzt["year"];
                                                for ($i = 1920; $i <= $jahr1; $i++) { ?>
                                                    <option value="<?php echo $i; ?>" <?php if (isset($_SESSION['jahr']) && $_SESSION['jahr'] == $i) echo "selected"; ?>><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#999999">Email*</td>
                            <td bgcolor="#CCCCCC"><input class="box" name="email" type="text" size="40" maxlength="40" value="<?php echo htmlspecialchars($_SESSION['EMAIL'] ?? ''); ?>"></td>
                        </tr>
                        <tr>
                            <td bgcolor="#999999">Validate Email*</td>
                            <td bgcolor="#CCCCCC"><input class="box" name="emaic" type="text" size="40" maxlength="40"></td>
                        </tr>
                        <tr>
                            <td bgcolor="#FFFFFF">&nbsp;</td>
                            <td bgcolor="#FFFFFF">
                                <div align="right">
                                    <input type="hidden" name="action" value="check">
                                    <input name="submit" type="submit" style="font-family:Verdana; font-size:11px; width:150px; height:19px; border: 1px solid #000000; color: #000000; background-color: #cccccc;" value="Create new Account">
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
<?php
        } elseif (isset($_POST['action']) && $_POST['action'] == "check") {
            // Verarbeite das Formular
            $_SESSION['ACCFIRST'] = $_POST['accountfirst'] ?? '';
            $_SESSION['ACCFIRSL'] = strtolower($_POST['accountfirst'] ?? '');
            $_SESSION['ACCLAST'] = $_POST['accountlast2'] ?? $_POST['accountlast'] ?? '';

            $_SESSION['NAMEF'] = $_POST['firstname'] ?? 'none';
            $_SESSION['NAMEL'] = $_POST['lastname'] ?? 'none';
            $_SESSION['ADRESS'] = $_POST['adress'] ?? 'none';
            $_SESSION['ZIP'] = $_POST['zip'] ?? '000000';
            $_SESSION['CITY'] = $_POST['city'] ?? 'none';
            $_SESSION['COUNTRY'] = $_POST['country'] ?? 'none';

            $_SESSION['EMAIL'] = $_POST['email'] ?? '';
            $_SESSION['EMAIC'] = $_POST['emaic'] ?? '';
            $_SESSION['PASSWD'] = $_POST['wordpass'] ?? '';
            $_SESSION['REGION'] = $_POST['region'] ?? '';

            $tag = $_POST['tag'] ?? '';
            $monat = $_POST['monat'] ?? '';
            $jahr = $_POST['jahr'] ?? '';

            // Überprüfe, ob alle erforderlichen Felder ausgefüllt sind
            if (empty($_SESSION['PASSWD']) || empty($_SESSION['EMAIC']) || empty($_SESSION['EMAIL']) || empty($_SESSION['CITY']) || empty($_SESSION['ZIP']) || empty($_SESSION['ADRESS']) || empty($_SESSION['NAMEL']) || empty($_SESSION['NAMEF']) || empty($_SESSION['ACCFIRST'])) {
                if (empty($_SESSION['EMAIC'])) {
                    $_SESSION['ERROR'] = "Please enter the Email a second time to check.";
                }
                if (empty($_SESSION['PASSWD'])) {
                    $_SESSION['ERROR'] = "Please enter a Password.";
                }
                if (empty($_SESSION['EMAIL'])) {
                    $_SESSION['ERROR'] = "Please enter an Email Address.";
                }
                if (empty($_SESSION['CITY'])) {
                    $_SESSION['ERROR'] = "Please enter a City.";
                }
                if (empty($_SESSION['ZIP'])) {
                    $_SESSION['ERROR'] = "Please enter a ZIP.";
                }
                if (empty($_SESSION['ADRESS'])) {
                    $_SESSION['ERROR'] = "Please enter an Address.";
                }
                if (empty($_SESSION['NAMEL'])) {
                    $_SESSION['ERROR'] = "Please enter a Real Last Name.";
                }
                if (empty($_SESSION['NAMEF'])) {
                    $_SESSION['ERROR'] = "Please enter your Real First Name.";
                }
                if (empty($_SESSION['ACCFIRST'])) {
                    $_SESSION['ERROR'] = "Please enter a First Name for your account.";
                }
                echo "<script language='javascript'>
                <!--
                window.location.href='index.php?page=createacc';
                // -->
                </script>";
            } else {
                // Überprüfe, ob der Benutzername oder die E-Mail bereits existiert
                $DbLink->query("SELECT username FROM " . C_USERS_TBL . " WHERE username = ? AND lastname = ?", [$_SESSION['ACCFIRST'], $_SESSION['ACCLAST']]);
                $NAMECHECK1 = $DbLink->next_record();

                $DbLink->query("SELECT username FROM " . C_USERS_TBL . " WHERE username = ? AND lastname = ?", [$_SESSION['ACCFIRSL'], $_SESSION['ACCLAST']]);
                $NAMECHECK2 = $DbLink->next_record();

                $DbLink->query("SELECT emailadress FROM " . C_WIUSR_TBL . " WHERE emailadress = ?", [$_SESSION['EMAIL']]);
                $EMAILCHECK = $DbLink->next_record();

                if ($EMAILCHECK) {
                    $_SESSION['ERROR'] = "This Email Address is already Registered.";
                    echo "<script language='javascript'>
                    <!--
                    window.location.href='index.php?page=createacc';
                    // -->
                    </script>";
                } elseif ($NAMECHECK1 || $NAMECHECK2) {
                    $_SESSION['ERROR'] = "This Account Name is already in use.";
                    echo "<script language='javascript'>
                    <!--
                    window.location.href='index.php?page=createacc';
                    // -->
                    </script>";
                } else {
                    if ($_SESSION['EMAIL'] === $_SESSION['EMAIC']) {
                        $_SESSION['ACTION'] = "THX";
                        $_SESSION['ERROR'] = "";

                        echo "<script language='javascript'>
                        <!--
                        window.location.href='index.php?page=createacc&aktion=ok';
                        // -->
                        </script>";
                    } else {
                        $_SESSION['ERROR'] = "Email Confirmation not correct.";
                        echo "<script language='javascript'>
                        <!--
                        window.location.href='index.php?page=createacc';
                        // -->
                        </script>";
                    }
                }
            }
        }
    } elseif (isset($_GET['aktion']) && $_GET['aktion'] == "ok") {
        if (empty($_SESSION['PASSWD']) || empty($_SESSION['EMAIC']) || empty($_SESSION['EMAIL']) || empty($_SESSION['CITY']) || empty($_SESSION['ZIP']) || empty($_SESSION['ADRESS']) || empty($_SESSION['NAMEL']) || empty($_SESSION['NAMEF']) || empty($_SESSION['ACCFIRST'])) {
            // Fehlerbehandlung
        } else {
            if (empty($_SESSION['ERROR']) && $_SESSION['ACTION'] == 'THX') {
                $passneu = $_SESSION['PASSWD'];
                $passwordHash = password_hash($passneu, PASSWORD_DEFAULT);

                $DbLink->query("SELECT username FROM " . C_USERS_TBL . " WHERE username = ? AND lastname = ?", [$_SESSION['ACCFIRST'], $_SESSION['ACCLAST']]);
                $USERCHECK = $DbLink->next_record();

                $DbLink->query("SELECT username FROM " . C_USERS_TBL . " WHERE username = ? AND lastname = ?", [$_SESSION['ACCFIRSL'], $_SESSION['ACCLAST']]);
                $USERCHE2CK = $DbLink->next_record();

                if ($USERCHECK || $USERCHE2CK) {
                    $_SESSION['ERROR'] = "User already exists in Database.";
                    echo "<script language='javascript'>
                    <!--
                    window.location.href='index.php?page=createacc';
                    // -->
                    </script>";
                } else {
                    $image = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', 0, 0, 0, 0, 0, 0, 0, 0);
                    $UUID = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
                        mt_rand(0, 0x0fff) | 0x4000,
                        mt_rand(0, 0x3fff) | 0x8000,
                        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));

                    $DbLink->query("INSERT INTO " . C_USERS_TBL . " 
                    (UUID, username, lastname, passwordHash, homeRegion, created, lastLogin)
                    VALUES
                    (?, ?, ?, ?, ?, ?, ?)", [$UUID, $_SESSION['ACCFIRST'], $_SESSION['ACCLAST'], $passwordHash, $_SESSION['REGION'], time(), 0]);

                    $DbLink->query("INSERT INTO " . C_WIUSR_TBL . " 
                    (UUID, username, lastname, passwordHash, realname1, realname2, adress1, zip1, city1, country1, emailadress)
                    VALUES
                    (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [$UUID, $_SESSION['ACCFIRST'], $_SESSION['ACCLAST'], $passwordHash, $_SESSION['NAMEF'], $_SESSION['NAMEL'], $_SESSION['ADRESS'], $_SESSION['ZIP'], $_SESSION['CITY'], $_SESSION['COUNTRY'], $_SESSION['EMAIL']]);

                    // Sende Bestätigungs-E-Mail
                    $date_arr = getdate();
                    $date = "$date_arr[mday].$date_arr[mon].$date_arr[year]";
                    $sendto = $_SESSION['EMAIL'];
                    $subject = "Account Password from " . SYSNAME;
                    $body = "Thanks $_SESSION[NAMEF] $_SESSION[NAMEL]\n\n";
                    $body .= "Your Account was successfully created at " . SYSNAME . ".\n";
                    $body .= "\n\nYour Password for " . SYSNAME . ":\n\n";
                    $body .= "$_SESSION[PASSWD]\n\n";
                    $body .= "Thank you for using " . SYSNAME . "";
                    $header = " ";
                    $mail_status = mail($sendto, $subject, $body, $header);
                }
            } else {
                echo "<script language='javascript'>
                <!--
                window.location.href='index.php?page=create';
                // -->
                </script>";
            }
        }
?>
<table width="100%" height="410" border="0">
    <tr>
        <td valign="top" bgcolor="#666666">
            <br>
            <br>
            <br>
            <table width="50%" border="0" align="center" cellpadding="3" cellspacing="2">
                <tr>
                    <td bgcolor="#FFFFFF"><div align="center"><strong>Account Successfully Created</strong></div></td>
                </tr>
                <tr>
                    <td bgcolor="#FFFFFF">
                        <blockquote>
                            <p><br>
                                <br>
                                The account was successfully created <br>
                                with the following Data:<br>
                                <br>
                                <?php echo htmlspecialchars(SYSNAME); ?> First Name: <b><?php echo htmlspecialchars($_SESSION['ACCFIRST']); ?></b></p>
                            <p>
                                <?php echo htmlspecialchars(SYSNAME); ?> Last Name: <b><?php echo htmlspecialchars($_SESSION['ACCLAST']); ?></b><br>
                                <br>
                                <br>
                                <br>
                                <br>
                            </p>
                        </blockquote>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php
    }
} else {
    echo "<script language='javascript'>
    <!--
    window.location.href='index.php?page=home';
    // -->
    </script>";
}
?>