<?php
declare(strict_types=1);

class ReactUtils {
	/**
	 * 
	 * @param string $appName.js
	 * @return string
	 */
	public static function getApp(string $appName):string {
		$data = file_get_contents(dirname(__FILE__).'/../../../server/assets/libs/react-'.Property::getValueFor(Constants::PROPERTY_ENVIRONMENT).'/manifest.json');
		$json = json_decode($data,true);
		return isset($json[$appName])?'/assets/libs/react-'.Property::getValueFor(Constants::PROPERTY_ENVIRONMENT).'/'.$json[$appName]:'';		
	}
}