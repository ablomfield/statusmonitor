<?php
session_start();
$_SESSION["personid"] = "";
$_SESSION = array();
session_unset();
session_destroy();
Header("Location: /");
?>