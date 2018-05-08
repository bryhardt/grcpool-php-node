<?php
declare(strict_types=1);

class Property {

	private $_propFile;
	
	/**
	 * 
	 * @param string $propertyFile
	 */
	public function __construct(string $propertyFile) {
		if (file_exists($propertyFile)) {
			$this->_propFile = json_decode(file_get_contents($propertyFile),true);
		}
	}
	
	/**
	 * 
	 * @param string $name
	 * @return string
	 */
	public function get(string $name):string {
		if (isset($this->_propFile[$name])) {
			return $this->_propFile[$name];
		}
	}

	/**
	 * 
	 * @param string $name
	 * @return string
	 */
	public static function getValueFor(string $name):string {
		if (file_exists(Constants::PROPERTY_FILE)) {
			$props = json_decode(file_get_contents(Constants::PROPERTY_FILE),true);
			if (isset($props[$name])) {
				return $props[$name];
			}
		}
		return null;
	}
	
	/**
	 * 
	 * @return bool
	 */
	public static function isDevelopment():bool {
		return CONSTANTS::PROPERTY_ENVIRONMENT_DEV == Property::getValueFor(Constants::PROPERTY_ENVIRONMENT);
	}

}