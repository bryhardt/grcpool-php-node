<?php
declare(strict_types=1);

class GrcPool_Controller_About extends GrcPool_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function projectStatusAction() {
		
		$this->view->poolFilter = $this->args(0,Controller::VALIDATION_NUMBER);
		if (!($this->view->poolFilter == 1 || $this->view->poolFilter == 2)) {
			$this->view->poolFilter = 0;
		}
		
		$cache = new Cache();
		$superBlock = $cache->get(Constants::CACHE_SUPERBLOCK_DATA);
		if ($superBlock) {
			$superBlock = json_decode($superBlock,true);
		}
		$this->view->numberOfProjects = $superBlock['whiteListCount'];
		$this->view->networkProjects = $superBlock['projects'] ?? array();
		
		$accountDao = new GrcPool_Boinc_Account_DAO();
		$accounts = $accountDao->fetchAll(array(),array('name'=>'asc'));
		
		$keyDao = new GrcPool_Boinc_Account_Key_DAO();
		$keys = $keyDao->fetchAll();
		
		$this->view->accounts = array();
		foreach ($accounts as $account) {
			for ($p = 1; $p <= Property::getValueFor(Constants::PROPERTY_NUMBER_OF_POOLS); $p++) {
				$obj = $keyDao->fetchObj($keys,array($keyDao->where('poolId',$p),$keyDao->where('accountId',$account->getId())));
				if ($obj) {
					$account->{'pool'.$p.'Attach'} = $account->getWhiteList()&&$account->getAttachable()&&$obj->getWeak()!=''&&$obj->getAttachable();
				} else {
					$account->{'pool'.$p.'Attach'} = false;
				}
			}
			array_push($this->view->accounts,$account);
		}
		
		$hostCreditDao = new GrcPool_Member_Host_Credit_DAO();
		$totalMag = $hostCreditDao->getTotalMag();
		$this->view->totalMag = $totalMag;
		
		$projStats = $hostCreditDao->getProjectStats();
		$this->view->projStats = $projStats;
		
		$boincStatsDao = new GrcPool_Boinc_Account_Stats_DAO();
		$stats = $boincStatsDao->getWithName('READY_TO_SEND');
		$this->view->tasksToSend = array();
		foreach ($stats as $stat) {
			$this->view->tasksToSend[$stat->getAccountId()] = $stat->getValue();
		}
		
		$boincUrlDao = new GrcPool_Boinc_Account_Url_DAO();
		$boincUrls = $boincUrlDao->fetchAll();
		$this->view->boincUrls = $boincUrls;
		
	}
	
	
	
	
}