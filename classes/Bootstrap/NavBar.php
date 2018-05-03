<?php
declare(strict_types=1);

class Bootstrap_NavBar {
	
	private $_brandName = '';
	private $_navItems;
	
	/**
	 * 
	 * @param string $name
	 */
	public function setBrandName(string $name) {
		$this->_brandName = $name;
	}
	
	/**
	 * 
	 * @param string $items
	 */
	public function setNavItems(string $items) {
		$this->_navItems = json_decode($items,true);
		//echo '<pre>';print_r($this->_navItems);
	}
	
	/**
	 * 
	 * @param mixed $item
	 * @param mixed $controller
	 * @return string
	 */
	private function createNavLink($item,$controller):string {
		return '<a class="dropdown-item" href="/'.$controller.'/'.$item['action'].'">'.$item['text'].'</a>';
	}
	
	/**
	 * 
	 * @param mixed $item
	 * @return string
	 */
	private function createNavItem($item):string {
		$html = '';
		if (isset($item['dropdown'])) {
			$html .= '
				<li class="nav-item dropdown '.(strstr($_SERVER['REQUEST_URI'],'/'.$item['controller'])?'active':'').'">
					<a '.(isset($item['id'])?'id="'.$item['id'].'"':'').' class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						'.$item['dropdown'].'
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						'.implode("",array_map(array($this,'createNavLink'),$item['hrefs'],array_fill(0,count($item['hrefs']),$item['controller']))).'
					</div>
				</li>
			';
		}
		return $html;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function render():string {
		$html = '';
		$html .= '
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse">
					<a class="navbar-brand" href="/">'.$this->_brandName.'</a>
					<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
						'.implode("",array_map(array($this,'createNavItem'),$this->_navItems)).'
					</ul>
				</div>
			</nav>
		';
		return $html;
	}
}