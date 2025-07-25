<?php
$sitesec = "home";
session_start();
date_default_timezone_set("America/Chicago");

// Import Settings
include($_SERVER['DOCUMENT_ROOT'] . "/includes/settings.php");

// Get Login Details
if (isset($_SESSION['authtoken'])) {
	$loggedin = True;
	$displayname = $_SESSION["displayname"];
	$authtoken = $_SESSION["authtoken"];
	$orgid = $_SESSION["orgid"];
	$orgname = $_SESSION["orgname"];
} else {
	$loggedin = False;
}
?>
<!DOCTYPE HTML>
<html>

<head>
	<title><?php echo($sitetitle); ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="/assets/css/main.css" />
	<link rel="icon" type="image/x-icon" href="/images/icon.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<?php
if ($personid != "" && $devtype != "") {
	echo("	<meta http-equiv=\"refresh\" content=\"30\">\n");
}
?></head>

<body class="is-preload">
	<div id="page-wrapper">
		<!-- Header -->
		<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php"); ?>
		<!-- Highlights -->
		<?php
		if ($personid != "") {
			// Show Status
			echo ("	<section class=\"wrapper style1\">\n");
			echo ("		<div class=\"container\">\n");
			echo ("			<div class=\"row aln-center gtr-200\">\n");
			if ($devtype == "lgw") {
				include("types/lgw.php");
			} elseif ($devtype == "workspace") {
				include("types/workspace.php");
			} else {
				include("types/select.php");
			}
			echo ("			</div>\n");
			echo ("		</div>\n");
			echo ("	</section>\n");
		} else {
			// Show Login Button
			echo ("	<section class=\"wrapper style1\">\n");
			echo ("		<div class=\"container\">\n");
			echo ("			<div class=\"row aln-center gtr-200\">\n");
			echo ("          <p><button onclick=\"window.location.href='" . $oauth_url . "'\" class=\"button\">Sign In with Webex</button></p>\n");
			echo ("			</div>\n");
			echo ("		</div>\n");
			echo ("	</section>\n");
		}
		?>
		<!-- Footer -->
		<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"); ?>
	</div>
	<!-- Scripts -->
	<script src="/assets/js/jquery.min.js"></script>
	<script src="/assets/js/jquery.dropotron.min.js"></script>
	<script src="/assets/js/browser.min.js"></script>
	<script src="/assets/js/breakpoints.min.js"></script>
	<script src="/assets/js/util.js"></script>
	<script src="/assets/js/main.js"></script>
</body>

</html>