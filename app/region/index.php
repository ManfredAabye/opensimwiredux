﻿<style type="text/css">
<!--
.styleTitel {
	font-size: 16px;
	font-weight: bold;
	color: #105BA7;
	font-family: Arial, Helvetica, sans-serif;
}

.styleText {font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #666666;}
.styleTopTitle {
	font-size: 20px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style>
<? 
include("../../settings/config.php");
include("../../settings/mysql.php");

if($_GET[region]){
$DbLink = new DB;
$DbLink->query("SELECT uuid,regionName,serverIP,serverHttpPort,locX,locY,owner_uuid FROM ".C_REGIONS_TBL." where uuid='$_GET[region]'");
list($UUID,$regionName,$serverIP,$serverHttpPort,$locX,$locY,$owner) = $DbLink->next_record();

$DbLink->query("SELECT username,lastname FROM ".C_USERS_TBL." where uuid='$owner'");
list($firstN,$lastN) = $DbLink->next_record();

}?>
<title><?=SYSNAME?> Region Information</title>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" valign="top"><span class="styleTopTitle">
          <?=SYSNAME?> 
          Region Information</span></td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><hr></td>
  </tr>
  <tr>
    <td width="55%" valign="top"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><span class="styleTitel">Region: <?=$regionName?></span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="styleText">UUID: <?=$UUID?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="styleText">Coordinates X: <?=$locX?> Y: <?=$locY?></td>
      </tr>
      <tr>
        <td class="styleText">&nbsp;</td>
      </tr>
      <tr>
        <td class="styleText">Server: <?=$serverIP?></td>
      </tr>
      <tr>
        <td class="styleText">&nbsp;</td>
      </tr>
      <tr>
        <td class="styleText">Owner: <a href="<?=SYSURL?>/app/agent/?agent=<?=$owner?>"><?=$firstN?> <?=$lastN?></a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
    <br>
    <br></td>
	<?
	$SERVER ="http://$serverIP:$serverHttpPort";
	$UUID = str_replace("-", "", $UUID);
	?>
    <td width="45%" valign="top"><br>
      <br>
      <table border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
          <td bgcolor="#999999"><div align="center">
            <table width="256" height="256" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td bgcolor="#FFFFFF" background="<?=$SERVER?>/index.php?method=regionImage<?=$UUID?>">&nbsp;</td>
              </tr>
            </table>
          </div></td>
        </tr>
      </table></td>
  </tr>
</table>
