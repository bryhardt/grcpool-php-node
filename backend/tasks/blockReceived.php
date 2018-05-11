<?php
require_once(dirname(__FILE__).'/../bootstrap.php');

$daemon = new GridcoinDaemon(Property::getValueFor('daemon-1'));

//////////////////////////////////////////////////////////////////////
// CURRENT BLOCK
$json = $daemon->getInfo();
$blockData = array();
$blockData['blockHeight'] = $json['blocks'];
$blockData['blockTime'] = time();
$blockData['blockHash'] = isset($argv[1])?$argv[1]:'';
$jsonString = json_encode($blockData);
$cache = new Cache();
$cache->set($jsonString,Constants::CACHE_CURRENT_BLOCK);
$ch = curl_init(Property::getValueFor('nodeServer').'updateBlock');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonString);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'APIKEY: '.Property::getValueFor('nodeKey'),
	'Content-Type: application/json',
	'Content-Length: ' . strlen($jsonString))
);
$result = curl_exec($ch);

////////////////////////////////////////////////////////////////////////
// SUPER BLOCK
$json = $daemon->getSuperBlock();
$data = json_decode($cache->get(Constants::CACHE_SUPER_BLOCK),true);
if ($data == null || $data['blockHeight'] != $json['block'] || true) {
	$blockData = array();
	$blockData['blockHeight'] = $json['block'];
	$blockData['blockTime'] = $json['timestamp'];
	$blockData['blockHash'] = '';
	$jsonString = json_encode($blockData);
	$cache->set($jsonString,Constants::CACHE_SUPER_BLOCK);
	$ch = curl_init(Property::getValueFor('nodeServer').'updateSuperBlock');
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonString);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'APIKEY: '.Property::getValueFor('nodeKey'),
		'Content-Type: application/json',
		'Content-Length: ' . strlen($jsonString))
	);
	$result = curl_exec($ch);
}
