<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.instagram.com/oembed?url=".Io::param("url"),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Cache-Control: no-cache",
    "Postman-Token: 2f02a2dc-aa7b-499b-bc84-36ac92d827a2"
  ),
));
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, CURLAUTH_BASIC );
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC );

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $responseObj = json_decode($response);

  echo $responseObj->html;
}

// <?php

// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => "https://api.instagram.com/oembed?url=https://www.instagram.com/p/BiTTXMxlnrf/",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 30,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "GET",
//   CURLOPT_HTTPHEADER => array(
//     "Cache-Control: no-cache",
//     "Postman-Token: 597464f2-0de7-4419-b008-d0b428fb35ed"
//   ),
// ));
// curl_setopt($curl, CURLOPT_FOLLOWLOCATION, CURLAUTH_BASIC );
// curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC );

// $response = curl_exec($curl);

// Io::pre(curl_getinfo($curl));
// $err = curl_error($curl);

// curl_close($curl);

// if ($err) {
//   echo "cURL Error #:" . $err;
// } else {
//   echo $response;
// }