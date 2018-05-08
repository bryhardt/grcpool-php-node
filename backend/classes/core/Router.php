<?php
declare(strict_types=1);

abstract class Router {

	protected $_controllerPath;

	private $_uri;
	private $_uriParts;
	private $_routes;
	private $_action;
	private $_requestedAction;
	private $_modules;
	
	/**
	 * 
	 * @param string $uri
	 */
	public function __construct(string $uri) {
		$this->_modules = array();
		if (substr($uri,strlen($uri)-1,1) == '/') {
			$uri = substr($uri,0,strlen($uri)-1);
		}
		if (strstr($uri,'?')) {
			$uri = substr($uri,0,strpos($uri,'?'));	
		}
		$this->_uri = $uri;
		$this->_uriParts = explode("/",$uri);
	}
	
	/**
	 * 
	 * @return Route
	 */
	public function getRoute() {
		$route = new Route();
 		if (count($this->_uriParts) > 1) {
 			$startIdx = 1;
 			$module = '';
 			if (array_search($this->_uriParts[1],$this->_modules) !== false) {
 				$startIdx = 2;
 				$module = $this->_uriParts[1];
 			}
 			if (!isset($this->_uriParts[$startIdx])) {
 				$this->_uriParts[$startIdx] = 'index';
 			}
 			if (count($this->_uriParts) == $startIdx+1) {
 				$this->_uriParts[$startIdx+1] = 'index';	
 			}
 			$route->setModule($module);
 			$route->setController(ucfirst(preg_replace("/[^A-Za-z0-9]/","",$this->_uriParts[$startIdx])));
 			$route->setAction(ucfirst(preg_replace("/[^A-Za-z0-9]/","",$this->_uriParts[$startIdx+1])));
 		}
		return $route;
	}
		
	public function dispatch() {
		$route = $this->getRoute();
		$action = $route->getAction();
		$urlAction = $action;
		if (is_numeric(substr($action,0,1))) {
			$action = 'id'.$action;
		}
		$this->_action = $action.'Action';
		$className = $this->_controllerPath;
		$viewPath = '';
		if ($route->getModule() != "") {
			$className .= '_'.ucfirst($route->getModule());
			$viewPath = $route->getModule().'/';
		}
		$className .= '_'.$route->getController();
		if (!class_exists($className)) {
			if (file_exists(getenv("DOCUMENT_ROOT").'/../views/'.$viewPath.(lcfirst($route->getController()).ucfirst($route->getAction())).'.php')) {
				$controller = new  $this->_controllerPath;
				$controller->setRenderView($viewPath.lcfirst($route->getController()).ucfirst($route->getAction()));
			} else {
				header("HTTP/1.0 404 Not Found");				
				$className = $this->_controllerPath.'_Home';
				$this->_action = 'indexAction';
				$controller = new $className;
				$controller->setRenderView('homeIndex');
			}
		} else {
			$controller = new $className;
			$controller->setRenderView($viewPath.lcfirst($route->getController()).ucfirst($route->getAction()));
		}
		$controller->setName($route->getController());
		if (!method_exists($controller,$this->_action)) {
			if (method_exists($controller,'defaultAction')) {
				$this->_requestedAction = $urlAction;
				$this->_action = 'defaultAction';
				$controller->setRenderView(lcfirst($route->getController()).'Index');
			} else {
				header("HTTP/1.0 404 Not Found");				
				$className = $this->_controllerPath.'_Home';
				$controller = new $className;
				$this->_action = 'indexAction';
				$controller->setRenderView('homeIndex');
			}
		}
		$controller->setUri($this->_uri);
		$controller->callAction($this->_action,$this->_requestedAction);
	}

}