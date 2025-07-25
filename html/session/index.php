<?php
$sitesec = "home";
session_start();
date_default_timezone_set("America/Chicago");

// Import Settings
include($_SERVER['DOCUMENT_ROOT'] . "/includes/settings.php");
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>CollabToolbox</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="/assets/css/main.css" />
  		<link rel="icon" type="image/x-icon" href="/images/icon.png">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
	</head>
	<body class="is-preload">
		<div id="page-wrapper">
			<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php"); ?>
			<!-- Highlights -->
<?php							
	echo("	<section class=\"wrapper style1\">\n");
	echo("		<div class=\"container\">\n");
	echo("			<div class=\"row gtr-200\">\n");
	echo("			<h1>Session Variables</h1>\n");
    echo("			<pre>\n");
    var_dump($_SESSION);
    echo("			</pre>\n");
	echo("			</div>\n");
	echo("		</div>\n");
	echo("	</section>\n");
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