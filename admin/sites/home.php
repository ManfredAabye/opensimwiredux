<?php
// Admin home.php
// Debugging: Überprüfe die SQL-Abfragen
error_log("SQL-Abfrage: SELECT gridstatus, active, color, title, message FROM " . C_INFOWINDOW_TBL);
error_log("SQL-Abfrage: SELECT count(*) FROM " . C_AGENTS_TBL . " WHERE agentOnline = 1 AND logintime > (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now()) - 86400))");
error_log("SQL-Abfrage: SELECT count(*) FROM " . C_AGENTS_TBL . " WHERE logintime > UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now()) - 2419200)");
error_log("SQL-Abfrage: SELECT count(*) FROM " . C_USERS_TBL);
error_log("SQL-Abfrage: SELECT count(*) FROM " . C_REGIONS_TBL);
error_log("SQL-Abfrage: SELECT content FROM " . C_PAGE_TBL . " WHERE id='1'");

// Defaultwerte für Variablen
$GRIDSTATUS = '0'; // Standard: OFFLINE
$INFOBOX = '0'; // Standard: Infobox deaktiviert
$BOXCOLOR = '#000000'; // Standard: Schwarze Farbe
$BOX_TITLE = 'System Status'; // Standardtitel
$BOX_INFOTEXT = 'Keine Informationen verfügbar.'; // Standardtext
$NOWONLINE = 0; // Standard: 0 Benutzer online
$LASTMONTHONLINE = 0; // Standard: 0 Benutzer im letzten Monat
$USERCOUNT = 0; // Standard: 0 Benutzer
$REGIONSCOUNT = 0; // Standard: 0 Regionen
$ERROR = $_GET['error'] ?? ''; // Standard: Kein Fehler
$content = 'Keine Inhalte verfügbar.'; // Standardinhalt

// Datenbankabfragen mit Defaultwerten
$DbLink = new DB;

// Abfrage für GRIDSTATUS, INFOBOX, BOXCOLOR, BOX_TITLE, BOX_INFOTEXT
$DbLink->query("SELECT gridstatus, active, color, title, message FROM " . C_INFOWINDOW_TBL);
if ($record = $DbLink->next_record()) {
    list($GRIDSTATUS, $INFOBOX, $BOXCOLOR, $BOX_TITLE, $BOX_INFOTEXT) = array_pad($record, 5, null);
}

// Abfrage für NOWONLINE
$DbLink->query("SELECT count(*) FROM " . C_AGENTS_TBL . " WHERE agentOnline = 1 AND logintime > (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now()) - 86400))");
if ($record = $DbLink->next_record()) {
    list($NOWONLINE) = array_pad($record, 1, 0);
}

// Abfrage für LASTMONTHONLINE
$DbLink->query("SELECT count(*) FROM " . C_AGENTS_TBL . " WHERE logintime > UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now()) - 2419200)");
if ($record = $DbLink->next_record()) {
    list($LASTMONTHONLINE) = array_pad($record, 1, 0);
}

// Abfrage für USERCOUNT
$DbLink->query("SELECT count(*) FROM " . C_USERS_TBL);
if ($record = $DbLink->next_record()) {
    list($USERCOUNT) = array_pad($record, 1, 0);
}

// Abfrage für REGIONSCOUNT
$DbLink->query("SELECT count(*) FROM " . C_REGIONS_TBL);
if ($record = $DbLink->next_record()) {
    list($REGIONSCOUNT) = array_pad($record, 1, 0);
}

// Weiterleitung, falls btn nicht gesetzt ist
if (($_GET['btn'] ?? '') == "" && $ERROR == "") {
    echo "<script language='javascript'>
    <!--
    window.location.href='index.php?page=home&btn=1';
    // -->
    </script>";
} elseif (($_GET['btn'] ?? '') == "" && $ERROR != "") {
    echo "<script language='javascript'>
    <!--
    window.location.href='index.php?page=home&btn=1&error=$ERROR';
    // -->
    </script>";
}
?>

<style type="text/css">
<!--
.Stil1 {
    font-size: 18px;
    font-weight: bold;
}
.txtcolor {color: #cccccc}
.placeholder{font-size: 3px}
.style2 {font-size: 11px}
-->
</style>

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><span class="placeholder">.</span></td>
  </tr>
  <tr>
    <td width="63%" rowspan="2" valign="top">
      <table width="90%" height="195" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
          <td valign="top">
            <p><strong>Welcome to the new Opensimwi Redux Admin</strong><br />
              <br />
              Here you can create users, edit the loginscreen, manage pages,<br />
              view logs and more.<br />
              <br />
              To the side you see the System Status-&gt; <br />
              <br />
              This interface for Opensim was created by Rookiie Roux and friends<br />
              <br />
              <span class="style2">* Copyright (c) 2007, 2008 Contributors, http://opensimulator.org/<br />
              * See CONTRIBUTORS for a full list of copyright holders.</span>
            </p>
          </td>
        </tr>
      </table>
    </td>
    <td width="33%" height="146" valign="top">
      <table border="0" align="right" cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td valign="top" align="right">
              <table cellspacing="0" cellpadding="0" width="300" border="0">
                <tbody>
                  <tr>
                    <td style="BACKGROUND-POSITION: left top; BACKGROUND-IMAGE: url(../../images/login_screens/icons/gridbox_tl.png); WIDTH: 5px; BACKGROUND-REPEAT: no-repeat; HEIGHT: 5px">
                      <img height="5" src="../../images/login_screens/spacer.gif" width="5" />
                    </td>
                    <td style="BACKGROUND-POSITION: left top; BACKGROUND-IMAGE: url(../../images/login_screens/icons/grey.gif); BACKGROUND-REPEAT: repeat-x; HEIGHT: 5px; BACKGROUND-COLOR: #000000">
                      <img height="5" src="../../images/login_screens/spacer.gif" width="5" />
                    </td>
                    <td style="BACKGROUND-POSITION: right top; BACKGROUND-IMAGE: url(../../images/login_screens/icons/gridbox_tr.png); WIDTH: 5px; BACKGROUND-REPEAT: no-repeat; HEIGHT: 5px">
                      <img height="5" src="../../images/login_screens/spacer.gif" width="5" />
                    </td>
                  </tr>
                  <tr>
                    <td style="BACKGROUND-POSITION: left top; BACKGROUND-IMAGE: url(../../images/login_screens/icons/grey.gif); WIDTH: 5px; BACKGROUND-REPEAT: repeat-y; BACKGROUND-COLOR: #000000"></td>
                    <td style="FONT-SIZE: 1.2em; COLOR: #ccc; BACKGROUND-COLOR: #000">
                      <table cellspacing="0" cellpadding="1" width="100%" border="0">
                        <tbody>
                          <tr>
                            <td style="PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" align="left">
                              <span class="txtcolor"><strong>GRID STATUS:</strong></span>
                            </td>
                            <td style="PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" align="right">
                              <?php if ($GRIDSTATUS == '1') { ?>
                                <span style="FONT-WEIGHT: bold; COLOR: #12d212">ONLINE</span>
                              <?php } else { ?>
                                <span style="FONT-WEIGHT: bold; COLOR: #ea0202">OFFLINE</span>
                              <?php } ?>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <div style="BACKGROUND-IMAGE: url(../../images/login_screens/icons/grey_dot.gif); MARGIN: 0px; BACKGROUND-REPEAT: repeat-x; MARGIN: 1px 0px 0px">
                        <img height="1" src="images/login_screens/spacer.gif" width="1" />
                      </div>
                      <table cellspacing="0" cellpadding="0" width="100%" border="0">
                        <tbody>
                          <tr bgcolor="#151515">
                            <td style="PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" valign="top" nowrap="nowrap" align="left">
                              <span class="txtcolor">Total Users:</span>
                            </td>
                            <td style="PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" valign="top" nowrap="nowrap" align="right" width="1%">
                              <span class="txtcolor"><?= $USERCOUNT ?></span>
                            </td>
                          </tr>
                          <tr bgcolor="#000000">
                            <td style="PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" valign="top" nowrap="nowrap" align="left">
                              <span class="txtcolor">Total Regions:</span>
                            </td>
                            <td style="PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" valign="top" nowrap="nowrap" align="right" width="1%">
                              <span class="txtcolor"><?= $REGIONSCOUNT ?></span>
                            </td>
                          </tr>
                          <tr bgcolor="#151515">
                            <td style="PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" valign="top" nowrap="nowrap" align="left">
                              <span class="txtcolor">Unique Visitors last 30 days:</span>
                            </td>
                            <td style="PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" valign="top" nowrap="nowrap" align="right" width="1%">
                              <span class="txtcolor"><?= $LASTMONTHONLINE ?></span>
                            </td>
                          </tr>
                          <tr bgcolor="#000000">
                            <td style="PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" valign="top" nowrap="nowrap" align="left">
                              <span class="txtcolor"><strong>Online Now:</strong></span>
                            </td>
                            <td style="PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" valign="top" nowrap="nowrap" align="right" width="1%">
                              <span class="txtcolor"><strong><?= $NOWONLINE ?></strong></span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                    <td style="BACKGROUND-POSITION: right top; BACKGROUND-IMAGE: url(../../images/login_screens/icons/grey.gif); WIDTH: 5px; BACKGROUND-REPEAT: repeat-y; BACKGROUND-COLOR: #000000"></td>
                  </tr>
                  <tr>
                    <td style="BACKGROUND-POSITION: left bottom; BACKGROUND-IMAGE: url(../../images/login_screens/icons/gridbox_bl.png); WIDTH: 5px; BACKGROUND-REPEAT: no-repeat; HEIGHT: 5px"></td>
                    <td style="BACKGROUND-POSITION: left bottom; BACKGROUND-IMAGE: url(../../images/login_screens/icons/grey.gif); BACKGROUND-REPEAT: repeat-x; HEIGHT: 5px; BACKGROUND-COLOR: #000000"></td>
                    <td style="BACKGROUND-POSITION: right bottom; BACKGROUND-IMAGE: url(../../images/login_screens/icons/gridbox_br.png); WIDTH: 5px; BACKGROUND-REPEAT: no-repeat; HEIGHT: 5px"></td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
        </tbody>
      </table>
    </td>
    <td width="3%">&nbsp;</td>
  </tr>
  <tr>
    <td height="130">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<?php
if (!$isAdmin) {
?>
<table width="100%" height="100%" border="0" align="center">
  <tr>
    <td valign="top">
      <table width="50%" border="0" align="center">
        <tr>
          <td>
            <p align="center" class="Stil1">Admin Home</p>
          </td>
        </tr>
      </table>
      <br />
      <table width="64%" height="199" border="0" align="center" cellpadding="5" cellspacing="5" bgcolor="#FFFFFF">
        <tr>
          <td valign="top">
            <p align="center"><br />
              <br />
              <br />
              Welcome to <?= SYSNAME ?> Admin,<br />
              <br />
              Please login to use the Admin Tool!</p>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php
}
?>