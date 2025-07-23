<?php
// Retrieve Trunk List
$trunksurl = "https://webexapis.com/v1/telephony/config/premisePstn/trunks?orgId=$orgid";
$gettrunks = curl_init($trunksurl);
curl_setopt($gettrunks, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($gettrunks, CURLOPT_RETURNTRANSFER, true);
curl_setopt($gettrunks, CURLOPT_FAILONERROR, true);
curl_setopt(
    $gettrunks,
    CURLOPT_HTTPHEADER,
    array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $authtoken
    )
);
$trunksdata = curl_exec($gettrunks);
if (curl_errno($gettrunks) == "0") {
    $trunksjson = json_decode($trunksdata);
    $trunksarray = json_decode($trunksdata, true);
    $trunkcount = count($trunksarray['trunks']);
    echo ("					    <table class=\"default\">\n");
    for ($x = 0; $x < $trunkcount; $x++) {
        echo ("					      <tr>\n");
        echo ("					        <td>\n");
        echo ("     					    <img src=\"/images/online.png\">\n");
        echo ("					        </td>\n");
        echo ("					        <td>\n");
        echo ("					         " . $trunksjson->trunks[$x]->name . "\n");
        echo ("					        </td>\n");
        echo ("					      </tr>\n");
    }
    echo ("					    </table>\n");
} else {
    echo "					  <p>Sorry, no local gateways found.</p>\n";
}