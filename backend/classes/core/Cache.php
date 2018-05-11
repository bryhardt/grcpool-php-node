<?php
declare(strict_types=1);

class Cache {
	public function __construct() {
		
	}
	
	/**
	 * 
	 * @param string $name
	 * @param int $expire
	 * @return mixed|NULL
	 */
	public function get(string $name,int $expire = -1) {
		$d = Property::getValueFor('cacheDir').'/'.$name;
		if (file_exists($d) && ($expire == -1 || date('U') < filemtime($d)+$expire)) {
			return strstr($name,'.')?file_get_contents($d):unserialize(file_get_contents($d));
		} else {
			return null;
		}
	}
	
	/**
	 * 
	 * @param mixed $data
	 * @param string $name
	 */
	public function set($data,string $name) {
		file_put_contents(Property::getValueFor('cacheDir').'/'.$name,strstr($name,'.')?$data:serialize($data));
	}
}