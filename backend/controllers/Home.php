<?php
declare(strict_types=1);

class GrcPool_Controller_Home extends GrcPool_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function indexAction() {
		
 		$hostCreditDao = new GrcPool_Member_Host_Credit_DAO();
		
 		$cache = new Cache();
 		$this->view->currentBlock = $cache->get(Constants::CACHE_CURRENT_BLOCK);
 		$this->view->currentSuperBlock = $cache->get(Constants::CACHE_SUPER_BLOCK);

// 		$superblockData = new SuperBlockData($cache->get(Constants::CACHE_SUPERBLOCK_DATA));
		
	
 		$settingsDao = new GrcPool_Settings_DAO();
// 		$this->view->poolWhiteListCount = $settingsDao->getValueWithName(Constants::SETTINGS_POOL_WHITELIST_COUNT);
// 		$this->view->txFee = $settingsDao->getValueWithName(Constants::SETTINGS_PAYOUT_FEE);
// 		$this->view->minPayout = $settingsDao->getValueWithName(Constants::SETTINGS_MIN_OWE_PAYOUT);
// 		$this->view->minStake = $settingsDao->getValueWithName(Constants::SETTINGS_MIN_STAKE_BALANCE);
 		$this->view->totalPaidOut = array();
 		$this->view->cpids = array();
 		$this->view->poolMags = array();
 		$this->view->networkMags = array();
 		$this->view->activeHosts = array();
 		for ($i = 1; $i <= Property::getValueFor(Constants::PROPERTY_NUMBER_OF_POOLS); $i++) {
 			$this->view->poolMags[$i] = $hostCreditDao->getTotalMagForPool($i);
 			if ($this->view->poolMags[$i] == '') {
 				$this->view->poolMags[$i] = 0;
 			}
 			$this->view->networkMags[$i] = 0;
 			$this->view->activeHosts[$i] = $hostCreditDao->getNumberOfActiveHostsForPool($i);
 			$this->view->cpids[$i] = $settingsDao->getValueWithName(Constants::SETTINGS_CPID.($i==1?'':$i));
 			$this->view->totalPaidOut[$i] = $settingsDao->getValueWithName(Constants::SETTINGS_TOTAL_PAID_OUT.($i==1?'':$i));
 		}
		$this->view->poolMags = json_encode($this->view->poolMags);
 		$this->view->networkMags = json_encode($this->view->networkMags);
// 		$this->view->totalPaidOutSparc = $settingsDao->getValueWithName(Constants::SETTINGS_TOTAL_PAID_OUT_SPARC);
// 		$this->view->online = $settingsDao->getValueWithName(Constants::SETTINGS_GRC_CLIENT_ONLINE);
// 		$this->view->onlineMessage = '';
// 		if (!$this->view->online) {
// 			$this->view->onlineMessage = $settingsDao->getValueWithName(Constants::SETTINGS_GRC_CLIENT_MESSAGE);
// 		}
// 		$this->view->superblockData = $superblockData;
		
	}
	
}