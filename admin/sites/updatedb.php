<?php
// Projekt opensimwiredux 2025
if ($_SESSION['ADMINUID'] == $ADMINCHECK) {
?>
<style type="text/css">
.Stil1 {font-size: 18px;font-weight: bold;}
.box {font-size: 12px;height: 20;}
.Stil4 {font-size: 14;}
</style>

<?php
$DbLink = new DB();

if ($_POST['Submit'] == "Update") {
    $DbLink->query("SELECT UUID, username, lastname, passwordHash FROM ".C_USERS_TBL." ");
    while (list($UUID, $username, $lastname, $password) = $DbLink->next_record()) {

        $DbLink2 = new DB();
        $DbLink2->query("SELECT username FROM ".C_WIUSR_TBL." WHERE UUID='$UUID'");
        list($USRNM) = $DbLink2->next_record();

        if (!$USRNM) {
            $DbLink2->query("INSERT INTO ".C_WIUSR_TBL." (UUID, username, lastname, passwordHash, active) VALUES ('$UUID', '$username', '$lastname', '$password', '1')");

            $DbLink2->query("SELECT count(*) FROM ".C_USERS_TBL."");
            list($CUSR) = $DbLink2->next_record();

            $DbLink2->query("SELECT count(*) FROM ".C_WIUSR_TBL."");
            list($CWIUSR) = $DbLink2->next_record();

            if ($CWIUSR == $CUSR) {
                echo "<script>
                window.location.href='index.php?page=home';
                </script>";
            }
        }
    }
}
?>
<table width="100%" height="100%" border="0" align="center">
    <tr>
        <td valign="top">
            <table width="50%" border="0" align="center">
                <tr>
                    <td>
                        <p align="center" class="Stil1">Database update</p>
                    </td>
                </tr>
            </table>

            <br />
            <br />
            <br />
            <table width="336" height="74" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td valign="top" bgcolor="#FFFFFF">
                        <br />
                        <table width="255" height="31" border="1" align="center" cellpadding="5" cellspacing="0" bordercolor="#999999">
                            <tr>
                                <td valign="top">If an update is needed, press the button..</td>
                            </tr>
                        </table>
                        <br />
                        <br />
                        <table width="177" height="32" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td bgcolor="#999999">
                                    <div align="center">
                                        <br />
                                        <?php if ($CUSR == $CWIUSR) { ?>
                                            <input type="submit" name="Submit" value="No update needed..." />
                                        <?php } else { ?>
                                            <form id="form1" name="form1" method="post" action="index.php?page=updatedb">
                                                <input type="submit" name="Submit" value="Update" />
                                            </form>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <br />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php
}
?>