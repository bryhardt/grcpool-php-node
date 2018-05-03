<?php
declare(strict_types=1);

class ReactUtils {
	/**
	 * 
	 * @param string $appName.js
	 * @return string
	 */
	public static function getAppFile(string $appName):string {
		$data = file_get_contents(dirname(__FILE__).'/../../manifest.json');
		$json = json_decode($data,true);
		return isset($json[$appName])?$json[$appName]:'';		
	}
}