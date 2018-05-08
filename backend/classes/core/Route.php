<?php
declare(strict_types=1);

class Route {

	private $_module = '';
	private $_controller = 'Home';
	private $_action = 'index';
	
	/**
	 * 
	 * @param string $module
	 */
	public function setModule(string $module) {
		$this->_module = $module;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getModule():string {
		return $this->_module;
	}
	
	/**
	 * 
	 * @param string $controller
	 */
	public function setController(string $controller) {
		$this->_controller = $controller;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getController():string {
		return $this->_controller;
	}
	
	/**
	 * 
	 * @param string $action
	 */
	public function setAction(string $action) {
		$this->_action = $action;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getAction():string {
		return $this->_action;
	}
	
}