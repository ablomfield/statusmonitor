<?php

if (isset($_POST["type"])) {
    $devtype = $_POST["type"];
    $_SESSION["devtype"] = $devtype;
    //header("Location: /");
} else {
    header("Location: /");
}
?>