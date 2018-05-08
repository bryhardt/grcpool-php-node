<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class RouterTest extends TestCase{

	public function testRoutes() {

		$router = new GrcPool_Router('/');
		$route = $router->getRoute();
		$this->assertEquals('Home',$route->getController());
		$this->assertEquals('index',$route->getAction());
		
		$router = new GrcPool_Router('/hosts');
		$route = $router->getRoute();
		$this->assertEquals('Hosts',$route->getController());

	}
	

}