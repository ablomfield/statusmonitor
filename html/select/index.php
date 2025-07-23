<?php

if (isset($_REQUEST["type"])) {
    $devtype = $_REQUEST["type"];
    $_SESSION["devtype"] = $devtype;
    header("Location: /");
} else {
    header("Location: /");
}
?>