<?php
require(dirname(__FILE__).'/../bootstrap.php');
$data = array(
	"blockHeight" => $argv[1],
	"blockTime" => time(),
	"blockHash" => md5($argv[1].time())
);
$data_string = json_encode($data);
$ch = curl_init('http://localhost:3001/updateBlock');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'APIKEY: '.Property::getValueFor('nodeKey'),
	'Content-Type: application/json',
	'Content-Length: ' . strlen($data_string))
);
 
$result = curl_exec($ch);
print_r($result);