<?php
// Retrieve YAML Settings
$yamlsettings = yaml_parse_file('/opt/statusmonitor/settings.yaml');
$dbserver = $yamlsettings['Database']['ServerName'];
$dbuser = $yamlsettings['Database']['Username'];
$dbpass = $yamlsettings['Database']['Password'];
$dbname = $yamlsettings['Database']['DBName'];

// Load Settings from Database
$dbconn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
if ($dbconn->connect_error) {
    die("Connection failed: " . $dbconn->connect_error);
}

// Set Variables
$rssettings = mysqli_query($dbconn, "SELECT * FROM settings") or die("Error in Selecting " . mysqli_error($dbconn));
$rowsettings = mysqli_fetch_assoc($rssettings);
$sitetitle = $rowsettings["sitetitle"];
$client_id = $rowsettings["client_id"];
$client_secret = $rowsettings["client_secret"];
$integration_id = $rowsettings["integration_id"];
$oauth_url = $rowsettings["oauth_url"];


if (isset($_SESSION["personid"])) {
	$personid = $_SESSION["personid"];
  } else {
	$personid = "";
}

if (isset($_SESSION["devtype"])) {
	$devtype = $_SESSION["devtype"];
  } else {
	$devtype = "";
}
?>