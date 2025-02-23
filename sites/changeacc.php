<?
if($_SESSION[USERID] == ""){
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=home';
// -->
</script>";
}else{ 

$DbLink = new DB;

$DbLink->query("SELECT region FROM ".C_ADM_TBL."");
list($REGIOCHECK) = $DbLink->next_record();

if(($REGIOCHECK=="0")or($REGIOCHECK=="1")){
$DbLink->query("SELECT homeRegion FROM ".C_USERS_TBL." WHERE UUID='$_SESSION[USERID]'");
list($oldregionid) = $DbLink->next_record();

$DbLink->query("SELECT regionName FROM ".C_REGIONS_TBL." WHERE regionHandle='$oldregionid'");
list($oldregionname) = $DbLink->next_record();

	  
if($_POST[Submit1]=="Save"){
$startregion=$_POST[region];

$DbLink->query("SELECT regionHandle FROM ".C_REGIONS_TBL." WHERE regionName='$startregion' ");
list($homeid) = $DbLink->next_record();

$DbLink->query("UPDATE ".C_USERS_TBL." SET homeRegion='$homeid' WHERE UUID='$_SESSION[USERID]' ");
}
}

if($_POST[Submit2]=="Save"){
if($_POST[passnew]==$_POST[passvalid]){
$password = md5(md5($_POST[passnew]) . ":" );
$passwold = md5(md5($_POST[passold]) . ":" );

$DbLink->query("SELECT passwordHash FROM ".C_USERS_TBL." WHERE UUID='$_SESSION[USERID]'");
list($pwss) = $DbLink->next_record();

if($pwss==$passwold){
$DbLink->query("UPDATE ".C_USERS_TBL." SET passwordHash='$password' WHERE UUID='$_SESSION[USERID]' ");
$DbLink->query("UPDATE ".C_WIUSR_TBL." SET passwordHash='$password' WHERE UUID='$_SESSION[USERID]' ");

session_unset();
session_destroy();
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=home';
// -->
</script>";

}else{
$ERRORS="Password doesnt match the password in the Database";
}

}else{
$ERRORS="Check new passwords validation Failed";
}
}

?>
<style type="text/css">
<!--
.Stil1 {
	font-size: 18px;
	font-weight: bold;
}
.box {	font-size: 12px;
	height: 20;	
}
-->
</style>
<table width="100%" height="425" border="0" align="center">
            <tr>
              <td valign="top"><table width="50%" border="0" align="center">
				<tr>
                  <td><p align="center" class="Stil1">Change Account</p>                  </td>
                </tr>
              </table>
              <br>
              <table width="64%" height="19" border="0" align="center" cellpadding="1" cellspacing="3" bgcolor="#666666">
                <? if(($REGIOCHECK=="0")or($REGIOCHECK=="1")){ ?>
				<tr>
                  <td colspan="2" valign="top" bgcolor="#666666"><div align="center"><strong>Change Start Region </strong></div></td>
                </tr>
				<form name="form1" method="post" action="index.php?page=change">
                <tr>
                  <td valign="top" bgcolor="#FFFFFF">Old Region: </td>
                  <td valign="top" bgcolor="#FFFFFF"><?=$oldregionname?></td>
                </tr>
                <tr>
                  <td width="47%" valign="top" bgcolor="#FFFFFF">Start Region:  </td>
                  <td width="53%" valign="top" bgcolor="#FFFFFF"><select class="box" wide="25" name="region">
                    <?   
	  $DbLink->query("SELECT regionName FROM ".C_REGIONS_TBL." ORDER BY regionName ASC ");
	  while(list($NAMERGN) = $DbLink->next_record())
	  {
	  ?>
                    <option>
                    <?=$NAMERGN?>
                    </option>
                    <?	
	  }
      ?>
                  </select></td>
                </tr>
                <tr>
                  <td valign="top" bgcolor="#666666">&nbsp;</td>
                  <td valign="top" bgcolor="#FFFFFF">
                    <input type="submit" name="Submit1" value="Save">                  </td>
                </tr>
				</form>
				<? } ?>
                <tr>
                  <td valign="top" bgcolor="#666666">&nbsp;</td>
                  <td valign="top" bgcolor="#666666">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" bgcolor="#666666"><div align="center"><strong>Change Password </strong></div></td>
                </tr>
				<? if($ERRORS){?>
                <tr>
                  <td colspan="2" valign="top" bgcolor="#666666"><div align="center"><?=$ERRORS?></div></td>
                </tr>
				<? } ?>
				<form name="form1" method="post" action="index.php?page=change">
                <tr>
                  <td valign="top" bgcolor="#FFFFFF">Old Password </td>
                  <td valign="top" bgcolor="#FFFFFF"><input type="password" name="passold"></td>
                </tr>
                <tr>
                  <td valign="top" bgcolor="#FFFFFF">New Password </td>
                  <td valign="top" bgcolor="#FFFFFF"><input type="password" name="passnew"></td>
                </tr>
                <tr>
                  <td valign="top" bgcolor="#FFFFFF">Validate Password </td>
                  <td valign="top" bgcolor="#FFFFFF"><input type="password" name="passvalid"></td>
                </tr>
                <tr>
                  <td valign="top" bgcolor="#666666">&nbsp;</td>
                  <td valign="top" bgcolor="#FFFFFF"><input type="submit" name="Submit2" value="Save"></td>
                </tr>
				</form>
              </table></td>
            </tr>
</table>
<? } ?>