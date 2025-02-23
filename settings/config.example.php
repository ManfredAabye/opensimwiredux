<?php
/*
 * Copyright (c) 2007, 2008 Contributors, http://opensimulator.org/
 * Projekt opensimwiredux 2025
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
 */

##################### System #########################
define("SYSNAME", "Opensim Webinterface Redux");
define("SYSURL", "http://yoururl.com/opensimwi");
define("SYSMAIL", "your@email.com");

$userInventoryURI = "http://localhost:8004/";
$userAssetURI = "http://localhost:8003/";

############ Delete Unconfirmed accounts ################
// e.g., 24 for 24 hours; leave empty for no timed delete
$unconfirmed_deltime = "24";

###################### Money Settings ####################

// Key of the account that all fees go to:
$economy_sink_account = "00000000-0000-0000-0000-000000000000";

// Key of the account that all purchased currency is debited from:
$economy_source_account = "00000000-0000-0000-0000-000000000000";

// Minimum amount of real currency (in CENTS!) to allow purchasing:
$minimum_real = 1;

// Error message if the amount is not reached:
$low_amount_error = "You tried to buy less than the minimum amount of currency. You cannot buy currency for less than US$ %.2f.";

// Sets which Page editor should be used:
$editor_to_use = 'standard';

################### GridMap Settings  #####################
// Allowing Zoom on your Map
$ALLOW_ZOOM = true;

// Default StartPoint for Map
$mapstartX = 1001;
$mapstartY = 1000;

// Direction where Info Image has to stay:
// Options: dr = down right; dl = down left; tr = top right; tl = top left; c = center
$display_marker = "dr";

##################### Database ########################
define("C_DB_TYPE", "mysql");
// Your Hostname here:
define("C_DB_HOST", "localhost");
// Your Database name here:
define("C_DB_NAME", " ");
// Your Username for Database here:
define("C_DB_USER", " ");
// Your Database Password here:
define("C_DB_PASS", " ");

################ Database Tables #########################
define("C_ADMIN_TBL", "wi_admin");
define("C_WIUSR_TBL", "wi_users");
define("C_USRBAN_TBL", "wi_banned");
define("C_CODES_TBL", "wi_codetable");
define("C_ADM_TBL", "wi_adminsetting");
define("C_COUNTRY_TBL", "wi_country");
define("C_NAMES_TBL", "wi_lastnames");
define("C_CURRENCY_TBL", "wi_economy_money");
define("C_TRANSACTION_TBL", "wi_economy_transactions");
define("C_INFOWINDOW_TBL", "wi_startscreen_infowindow");
define("C_NEWS_TBL", "wi_startscreen_news");
define("C_PAGE_TBL", "wi_pagemanager");

// OPENSIM DEFAULT TABLES (NEEDED FOR LOGIN SCREEN & MONEY SYSTEM)
define("C_USERS_TBL", "users");
define("C_AGENTS_TBL", "agents");
define("C_REGIONS_TBL", "regions");
?>