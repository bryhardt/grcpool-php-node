<?php
declare(strict_types=1);

class GrcPool_Controller extends Controller {
	
	private $_webPage;
	private $_user;
	
	public function __construct() {
		parent::__construct();
		//$memberDao = new GrcPool_Member_DAO();
		//$this->_user = $memberDao->initWithSession();
		$this->_webPage	= new GrcPool_WebPage();		
	}
	
	/**
	 * 
	 * @return GrcPool_WebPage
	 */
	public function getWebPage():GrcPool_WebPage {
		return $this->_webPage;
	}
	
	/**
	 * 
	 * @return GrcPool_Member
	 */
	public function getUser():GrcPool_Member {
		return $this->_user;
	}
	
	/**
	 * 
	 */
	public function render() {
		$controller = $this->view;
		$webPage = $this->_webPage;
		//$webPage->append($this->renderMessages());
		require(getenv("DOCUMENT_ROOT").'/../views/'.$this->getRenderView().'.php');
		$webPage->display();
	}
	
	
}