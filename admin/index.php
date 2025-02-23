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

// Setze die aktuelle Seite in der Session
if (isset($_GET['page']) && $_GET['page'] != '') {
    $_SESSION['page'] = $_GET['page'];
} else {
    $_SESSION['page'] = 'home';
}

// Überprüfe, ob der Benutzer ein Admin ist
$DbLink = new DB;
$DbLink->query("SELECT password FROM " . C_ADMIN_TBL . " WHERE password = ?", [$_SESSION['ADMINUID'] ?? '']);
$admpass = $DbLink->next_record()[0] ?? null;

if ($admpass) {
    $ADMINCHECK = $admpass;
} else {
    $ADMINCHECK = "454"; // Standardwert, falls kein Admin gefunden wird
}

// Admin-Login überprüfen
if (isset($_POST['adminlogin']) && $_POST['adminlogin'] == "admincheck") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $DbLink->query("SELECT username, password FROM " . C_ADMIN_TBL . " WHERE username = ?", [$username]);
    $adminData = $DbLink->next_record();

    if ($adminData && password_verify($password, $adminData['password'])) {
        $_SESSION['ADMINUID'] = $adminData['password']; // Speichere das gehashte Passwort in der Session
    }
}

// Weiterleitung nach erfolgreicher Überprüfung
if (isset($_POST['check']) && $_POST['check'] == 1) {
    echo "<script language=\"javascript\">
    <!--
    window.location.href=\"index.php?page=home\";
    // -->
    </script>";
    exit; // Beende das Skript, um eine Weiterleitung zu erzwingen
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Welcome to <?php echo htmlspecialchars(SYSNAME); ?></title>
    <style type="text/css">
    <!--
    .Stil9 {font-size: 14px; font-family: Verdana, Arial, Helvetica, sans-serif; }
    body {
        background-image: url(../images/main/bg.jpg);
    }
    -->
    </style>
</head>
<body>
<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" marginheight="0" marginwidth="0">
  <tr>
    <td width="25" rowspan="3">&nbsp;</td>
    <td height="0"></td>
    <td width="25" rowspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>
        <table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" marginwidth="0" marginheight="0">
            <tr>
                <td height="136" colspan="2" bgcolor="#000000">
                    <table border="0" width="100%" cellspacing="0" cellpadding="0" height="132">
                        <tr>
                            <td width="590" height="139" background="../images/main/header.jpg">
                                <img src="../images/main/logo.gif" width="534" height="139" alt="Logo">
                            </td>
                            <td width="124" background="../images/main/header.jpg">&nbsp;</td>
                            <td background="../images/main/header.jpg" width="237">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td width="2%" height="100%" valign="top" background="../images/main/menu_bg.jpg" bgcolor="#CCCCCC">
                    <?php
                    if (isset($_SESSION['ADMINUID']) {
                        include("adminmenu.php");
                    } else {
                        include("menulogin.php");
                    }
                    ?>
                </td>
                <td width="98%" height="100%" background="../images/main/page_bg.jpg">
                    <?php include("adminsites.php"); ?>
                </td>
            </tr>
        </table>
    </td>
  </tr>
  <tr>
    <td height="25" bgcolor="#000000" align="right">
        <table border="0" width="100%" cellspacing="0" cellpadding="0" height="25">
            <tr>
                <td background="../images/main/footer.jpg">&nbsp;</td>
                <td background="../images/main/footer.jpg">&nbsp;</td>
            </tr>
        </table>
    </td>
  </tr>
</table>
</body>
</html>