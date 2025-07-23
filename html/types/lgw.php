<?php
echo ("			<h1>Local Gateways</h1>\n");
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
  echo ("					  <p>Found " . $trunkcount . " trunk(s) for $orgname</p>\n");
  echo ("					    <table class=\"default\">\n");
  for ($x = 0; $x < $trunkcount; $x++) {
    if ($trunksjson->trunks[$x]->trunkType == "REGISTERING") {
      echo ("					      <tr>\n");
      echo ("					        <td>\n");
      echo ("     					    <label class=\"radio-container\">\n");
      echo ("			     		        <input type=\"radio\" name=\"trunkid\" value=\"" . $trunksjson->trunks[$x]->id . "\">\n");
      echo ("					            <span class=\"radio-checkmark\"></span>\n");
      echo ("					        </td>\n");
      echo ("					        <td>\n");
      echo ("					         " . $trunksjson->trunks[$x]->name . "</label>\n");
      echo ("					        </td>\n");
      echo ("					      </tr>\n");
    }
  }
  echo ("					    </table>\n");
} else {
  echo "					  <p>Sorry, no local gateways found.</p>\n";
}

?>