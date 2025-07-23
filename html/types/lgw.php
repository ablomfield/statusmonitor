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
        // Retrieve Trunk Information
        $trunkid = $trunksjson->trunks[$x]->id;
        $trunkdeturl = "https://webexapis.com/v1/telephony/config/premisePstn/trunks/$trunkid?orgId=$orgid";
        $gettrunkdet = curl_init($trunkdeturl);
        curl_setopt($gettrunkdet, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($gettrunkdet, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $gettrunkdet,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $authtoken
            )
        );
        $trunkdetdata = curl_exec($gettrunkdet);
        $trunkdetjson = json_decode($trunkdetdata);
        if ($trunkdetjson->status == "online") {
            $statusimg = "/images/status-green.png";
        } else {
            $statusimg = "/images/status-red.png";
        }
        echo ("					      <tr>\n");
        echo ("					        <td>\n");
        echo ("     					    <img src=\"" . $statusimg . "\">\n");
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
