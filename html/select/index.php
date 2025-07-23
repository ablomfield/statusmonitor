<?php
session_start();
if (isset($_POST["type"])) {
    $devtype = $_POST["type"];
    echo ("\$devtype = $devtype\n<br>");
    $_SESSION["devtype"] = $devtype;
    header("Location: /");
} else {
    header("Location: /");
}
?>