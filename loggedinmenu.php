<!-- Projekt opensimwiredux 2025 -->
<style type="text/css">
<!--
.Stil9 {font-size: 14px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.boxmenu {font-size: 1px}
-->
</style>
<table width="245" border="0" align="center" cellpadding="0" cellspacing="0">
<?php
$DbLink = new DB;
$DbLink->query("SELECT id, code, sitename, url, target FROM ".C_PAGE_TBL." WHERE active='1' AND type='1' AND ((display='1') OR (display='2')) ORDER BY rank ASC");
while($record = $DbLink->next_record())
{
    list($siteid, $sitecode, $sitename, $siteurl, $sitetarget) = $record;
    if(!($siteurl == 'index.php?page=transactions' && ($economy_sink_account == '00000000-0000-0000-0000-000000000000' || $economy_source_account == '00000000-0000-0000-0000-000000000000'))) {
?>
    <tr>
        <td>
            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0"
            <?php
            if($siteurl != "") {
                if($siteurl != "" && $sitetarget == '_self') {
                    if($_GET['btn'] == $siteid) {
                        echo 'background="images/main/menu_selected.jpg"';
                    } else {
                        echo 'background="images/main/menu_unselected.jpg"';
                    }
                    echo 'onclick="document.location.href=\'',$siteurl,'&btn=',$siteid,'\'"';
                } else {
                    echo 'onclick="window.open(\'',$siteurl,'\',\'mywindow\',\'width=400,height=200\')"';
                }
            } else {
                echo 'onclick="document.location.href=\'index.php?&page=smodul&id=',$siteid,'&btn=',$siteid,'\'"';
                if($_GET['page'] == 'smodul' && $_GET['btn'] == $siteid) {
                    echo 'background="images/main/menu_selected.jpg"';
                } else {
                    echo 'background="images/main/menu_unselected.jpg"';
                }
            }
            ?>
            >
            <tr>
                <td width="25" style="cursor:pointer;font-weight:bold;">&nbsp;</td>
                <td style="cursor:pointer;font-weight:bold;"><?=$sitename?></td>
            </tr>
            </table>
        </td>
    </tr>
<?php
        if($_GET['btn'] == $siteid) {
            $DbLink1 = new DB;
            $DbLink1->query("SELECT id, code, sitename, url, target FROM ".C_PAGE_TBL." WHERE active='1' AND type='2' AND ((display='1') OR (display='2')) AND code='$sitecode' ORDER BY rank ASC");
            while($subrecord = $DbLink1->next_record()) {
                list($subsiteid, $subsitecode, $subsitename, $subsiteurl, $subsitetarget) = $subrecord;
                if(!($subsiteurl == 'index.php?page=transactions' && ($economy_sink_account == '00000000-0000-0000-0000-000000000000' || $economy_source_account == '00000000-0000-0000-0000-000000000000'))) {
?>
    <tr>
        <td>
            <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0"
            <?php
            if($subsiteurl != "") {
                if($subsiteurl != "" && $subsitetarget == '_self') {
                    if($_GET['subbtn'] == $subsiteid) {
                        echo 'background="images/main/submenu_selected.jpg"';
                    } else {
                        echo 'background="images/main/submenu_unselected.jpg"';
                    }
                    echo 'onclick="document.location.href=\'',$subsiteurl,'&btn=',$siteid,'&subbtn=',$subsiteid,'\'"';
                } else {
                    echo 'onclick="window.open(\'',$subsiteurl,'\',\'mywindow\',\'width=400,height=200\')"';
                }
            } else {
                echo 'onclick="document.location.href=\'index.php?&page=smodul&id=',$subsiteid,'&btn=',$siteid,'&subbtn=',$subsiteid,'\'"';
                if($_GET['page'] == 'smodul' && $_GET['subbtn'] == $subsiteid) {
                    echo 'background="images/main/submenu_selected.jpg"';
                } else {
                    echo 'background="images/main/submenu_unselected.jpg"';
                }
            }
            ?>
            >
            <tr>
                <td width="25" style="cursor:pointer;font-weight:bold;">&nbsp;</td>
                <td style="cursor:pointer;font-weight:bold;"><?=$subsitename?></td>
            </tr>
            </table>
        </td>
    </tr>
<?php
                }
            }
        }
    }
}
?>
<tr>
    <td><span class="boxmenu">.</span></td>
</tr>
<tr>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>&nbsp;</td>
</tr>
</table>
