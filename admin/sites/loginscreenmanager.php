<?php
session_start();

/*
 * Copyright (c) 2007, 2008 Contributors, http://opensimulator.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 * Projekt opensimwiredux 2025
 *
 * See LICENSE for the full licensing terms of this file.
 */

// Überprüfe, ob der Benutzer ein Admin ist
if (!isset($_SESSION['ADMINUID'])) {
    echo "<script language=\"javascript\">
    <!--
    window.location.href=\"index.php?page=home\";
    // -->
    </script>";
    exit;
}

$DbLink = new DB;

// Verarbeite das Löschen von News-Einträgen
if (isset($_GET['delete']) && $_GET['delete'] == 1) {
    $id = $_GET['id'] ?? '';
    $DbLink->query("DELETE FROM " . C_NEWS_TBL . " WHERE id = ?", [$id]);
}

// Verarbeite das Speichern der Infobox-Einstellungen
if (isset($_POST['infobox']) && $_POST['infobox'] == "save") {
    $gridstatus = $_POST['gridstatus'] ?? '';
    $boxstatus = $_POST['boxstatus'] ?? '';
    $boxcolor = $_POST['boxcolor'] ?? '';
    $infotitle = $_POST['infotitle'] ?? '';
    $infomessage = $_POST['infomessage'] ?? '';

    $DbLink->query("UPDATE " . C_INFOWINDOW_TBL . " SET 
        gridstatus = ?,
        active = ?,
        color = ?,
        title = ?,
        message = ?", [$gridstatus, $boxstatus, $boxcolor, $infotitle, $infomessage]);
}

// Lade die aktuellen Infobox-Einstellungen
$DbLink->query("SELECT gridstatus, active, color, title, message FROM " . C_INFOWINDOW_TBL);
list($gridstatus, $boxstatus, $boxcolor, $infotitle, $infomessage) = $DbLink->next_record();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Loginscreen Manager</title>
    <style type="text/css">
    <!--
    body {
        font-family: Arial, sans-serif;
    }
    .white { background-color: #FFFFFF; }
    .green { background-color: #00FF00; }
    .yellow { background-color: #FFFF00; }
    .red { background-color: #FF0000; }
    -->
    </style>
</head>
<body>
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <table cellpadding="2" cellspacing="1" width="95%">
                    <tr>
                        <td align="right" bgcolor="#1F5BA1">
                            <div align="center"><font color="#FFFFFF"><b>Loginscreen Manager</b></font></div>
                        </td>
                    </tr>
                </table>
                <br />
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="62%" valign="top">
                            <table width="90%" border="0" cellpadding="3" cellspacing="0" bgcolor="#336EB2">
                                <form action="index.php?page=loginscreen" method="post">
                                    <input type="hidden" name="infobox" value="save" />
                                    <tr>
                                        <td width="18%"><div align="right"><font color="#FFFFFF">Gridstatus</font></div></td>
                                        <td width="10%">
                                            <select name="gridstatus" id="gridstatus">
                                                <option value="1" style="background-color:#00FF00" <?php if ($gridstatus == "1") echo "selected"; ?>>Online</option>
                                                <option value="0" style="background-color:#FF0000" <?php if ($gridstatus == "0") echo "selected"; ?>>Offline</option>
                                            </select>
                                        </td>
                                        <td width="18%"><div align="right"><font color="#FFFFFF">Window Status</font></div></td>
                                        <td width="13%">
                                            <select name="boxstatus" id="boxstatus">
                                                <option value="1" style="background-color:#00FF00" <?php if ($boxstatus == "1") echo "selected"; ?>>Active</option>
                                                <option value="0" style="background-color:#FF0000" <?php if ($boxstatus == "0") echo "selected"; ?>>Inactive</option>
                                            </select>
                                        </td>
                                        <td width="19%"><div align="right"><font color="#FFFFFF">Window Color</font></div></td>
                                        <td width="22%">
                                            <select name="boxcolor" id="boxcolor">
                                                <option value="white" style="background-color:#FFFFFF" <?php if ($boxcolor == "white") echo "selected"; ?>>white</option>
                                                <option value="green" style="background-color:#00FF00" <?php if ($boxcolor == "green") echo "selected"; ?>>green</option>
                                                <option value="yellow" style="background-color:#FFFF00" <?php if ($boxcolor == "yellow") echo "selected"; ?>>yellow</option>
                                                <option value="red" style="background-color:#FF0000" <?php if ($boxcolor == "red") echo "selected"; ?>>red</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><font color="#336EB2" size="1">.</font></td>
                                    </tr>
                                    <tr>
                                        <td valign="top"><font color="#FFFFFF">Window Title</font></td>
                                        <td colspan="5"><input name="infotitle" type="text" id="infotitle" size="59" value="<?php echo htmlspecialchars($infotitle); ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td valign="top"><font color="#FFFFFF">Window Message</font></td>
                                        <td colspan="5">
                                            <textarea name="infomessage" cols="45" rows="10" id="infomessage"><?php echo htmlspecialchars($infomessage); ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <div align="right">
                                                <input type="submit" name="Submit" value="Save Info Window Settings" />
                                            </div>
                                        </td>
                                    </tr>
                                </form>
                            </table>
                        </td>
                    </tr>
                </table>
                <br />
                <a style="color:#FFFFFF" href="index.php?page=news_add">Create News item</a><br />
                <br />

                <table width="100%" cellpadding="2" cellspacing="1" border="0" bgcolor="#FFFFFF">
                    <tr>
                        <td bgcolor="#336EB2">
                            <table width="100%" cellpadding="2" cellspacing="0" border="0">
                                <tr>
                                    <td width="611" bgcolor="#1F5BA1"><font color="#FFFFFF"><b>Title</b></font></td>
                                    <td width="154" bgcolor="#1F5BA1"><font color="#FFFFFF"><b>Date</b></font></td>
                                    <td bgcolor="#1F5BA1" colspan="2"><font color="#FFFFFF"><b></b></font></td>
                                </tr>
                                <?php
                                $DbLink->query("SELECT id, title, time FROM " . C_NEWS_TBL . " ORDER BY time DESC");
                                while ($record = $DbLink->next_record()) {
                                    list($id, $title, $TIME) = $record;

                                    if (strlen($title) > 67) {
                                        $title = substr($title, 0, 32) . "...";
                                    }
                                ?>
                                <tr>
                                    <td><b><font color="#CCCCCC"><?php echo htmlspecialchars($title); ?></font></b></td>
                                    <td><font color="#CCCCCC"><b><?php echo date("D d M", $TIME); ?></b></font></td>
                                    <td width="55"><a href="index.php?page=news_edit&editid=<?php echo htmlspecialchars($id); ?>">EDIT</a></td>
                                    <td width="63"><a href="index.php?page=loginscreen&delete=1&id=<?php echo htmlspecialchars($id); ?>">DEL</a></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </td>
                    </tr>
                </table>
                <br><br>
            </td>
        </tr>
    </table>
</body>
</html>