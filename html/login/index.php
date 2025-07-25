<?php
session_start();

// Import Settings
include($_SERVER['DOCUMENT_ROOT'] . "/includes/settings.php");

if (isset($_GET['code'])) {
    // Retrieve Code
    $oauth_code = $_GET['code'];
    $oauth_state = $_GET['state'];
    $accessarr = array(
        'grant_type' => 'authorization_code',
        'redirect_uri' => 'https://statusmonitor.collabtoolbox.com/login',
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $oauth_code
    );
    $accessenc = http_build_query($accessarr);
    $getaccess = curl_init();
    curl_setopt_array($getaccess, array(
        CURLOPT_URL => 'https://webexapis.com/v1/access_token',
        CURLOPT_RETURNTRANSFER => true, // return the transfer as a string of the return value
        CURLOPT_TIMEOUT => 0,   // The maximum number of seconds to allow cURL functions to execute.
        CURLOPT_POST => true,   // This line must place before CURLOPT_POSTFIELDS
        CURLOPT_POSTFIELDS => $accessenc // Data that will send
    ));
    $accessdata = curl_exec($getaccess);
    $accessjson = json_decode($accessdata);
    $authtoken = $accessjson->access_token;

    // Retrieve User Details using authtoken
    $personurl = "https://webexapis.com/v1/people/me";
    $getperson = curl_init($personurl);
    curl_setopt($getperson, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($getperson, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $getperson,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $authtoken
        )
    );
    $persondata = curl_exec($getperson);
    $personjson = json_decode($persondata);
    $personid = $personjson->id;
    $orgid = $personjson->orgId;
    $emailarr = $personjson->emails;
    $email = $emailarr[0];
    $_SESSION["displayname"] = $personjson->displayName;
    $_SESSION["orgid"] = $personjson->orgId;
    $_SESSION["authtoken"] = $authtoken;
    $_SESSION["personid"] = $personid;

    // Retrieve Org Details using authtoken
    $orgurl = "https://webexapis.com/v1/organizations/" . $orgid;
    $getorg = curl_init($orgurl);
    curl_setopt($getorg, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($getorg, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $getorg,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $authtoken
        )
    );
    $orgdata = curl_exec($getorg);
    $orgjson = json_decode($orgdata);
    $orgname = $orgjson->displayName;
    $_SESSION["orgname"] = $orgname;

        // Write History
    if ($dbconn->query("INSERT INTO history (histtime,ipaddr,emailaddr,orgname) values (NOW(),'" . $_SERVER['REMOTE_ADDR'] . "','" . $email . "', '" . $orgname . "')") === TRUE) {
        $_SESSION["historyid"] = $dbconn->insert_id;
    }

    header("Location: /");
} else {
    header("Location: /");
}
