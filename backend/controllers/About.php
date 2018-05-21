<?php
declare(strict_types=1);

class GrcPool_Controller_About extends GrcPool_Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function walletsAction() {
		$walletDao = new GrcPool_Wallet_Basis_DAO();
		$settingsDao = new GrcPool_Settings_DAO();
		
		$this->view->hotWallets = array();
		$this->view->stakingWallets = array();
		for ($p = 1; $p <= Property::getValueFor(Constants::PROPERTY_NUMBER_OF_POOLS); $p++) {
			array_push($this->view->hotWallets,$settingsDao->getValueWithName(Constants::SETTINGS_HOT_WALLET_ADDRESS.($p>1?$p:'')));
			array_push($this->view->stakingWallets,$settingsDao->getValueWithName(Constants::SETTINGS_STAKING_WALLET_ADDRESS.($p>1?$p:'')));
		}
	}
		
	public function calculationsAction() {
		$settingsDao = new GrcPool_Settings_DAO();
		$this->view->seed = $settingsDao->getValueWithName(Constants::SETTINGS_SEED);
	}
		
	public function feesAction() {
		$settingsDao = new GrcPool_Settings_DAO();
		$this->view->payoutFee = $settingsDao->getValueWithName(Constants::SETTINGS_PAYOUT_FEE);
		$this->view->donationAddress = $settingsDao->getValueWithName(Constants::SETTINGS_GRC_DONATION_ADDRESS);
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