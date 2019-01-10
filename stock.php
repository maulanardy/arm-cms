<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://www.idx.co.id/umbraco/Surface/Home/GetStockInfo?code=MYRX",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Cache-Control: no-cache",
    "Postman-Token: 7bf9d72f-a5d4-4cc0-90e1-e27a55ff0b7a"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $stock = json_decode($response);
  // $stock = $obj[0];
  // echo "<pre>";
  // print_r($stock);
  // echo "</pre>";

}
?>

<h4>PT. Hanson International Tbk</h4>
<h2>MYRX:IJ</h2>
<h3><?php echo date("d/m/Y")?></h3>
<h2><?php echo $stock->Percent >= 0 ? "UP " : "DOWN "?><?php echo number_format((float)$stock->Price, 2, '.', '')?></h2>