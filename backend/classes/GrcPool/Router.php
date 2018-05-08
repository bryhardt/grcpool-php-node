<?php
declare(strict_types=1);

class GrcPool_Router extends Router {

	protected $_controllerPath = 'GrcPool_Controller';
	
	/**
	 * 
	 * @param string $uri
	 */
	public function __construct(string $uri) {
		parent::__construct($uri);
	}
	
}
