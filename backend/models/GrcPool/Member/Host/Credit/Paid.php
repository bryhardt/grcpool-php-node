<?php
/* ***********************************************************************
THIS FILE WAS CREATED AUTOMATICALLY BY PHP MODEL/OBJECT CREATOR
MANUAL MODIFICATIONS WILL BE AUTOMATICALLY OVERWRITTEN
************************************************************************ */
abstract class GrcPool_Member_Host_Credit_Paid_MODEL {

	public function __construct() { }

	private $_id = 0;
	private $_hostDbid = 0;
	private $_totalCredit = 0;
	private $_avgCredit = 0;
	private $_accountId = 0;
	private $_mag = 0;
	private $_owed = 0.00000000;
	private $_memberId = 0;
	private $_poolId = 1;
	private $_theTime = 0;
	public function setId(int $int) {$this->_id=$int;}
	public function getId():int {return $this->_id;}
	public function setHostDbid(int $int) {$this->_hostDbid=$int;}
	public function getHostDbid():int {return $this->_hostDbid;}
	public function setTotalCredit(float $float) {$this->_totalCredit=$float;}
	public function getTotalCredit():float {return $this->_totalCredit;}
	public function setAvgCredit(float $float) {$this->_avgCredit=$float;}
	public function getAvgCredit():float {return $this->_avgCredit;}
	public function setAccountId(int $int) {$this->_accountId=$int;}
	public function getAccountId():int {return $this->_accountId;}
	public function setMag(float $float) {$this->_mag=$float;}
	public function getMag():float {return $this->_mag;}
	public function setOwed(float $float) {$this->_owed=$float;}
	public function getOwed():float {return $this->_owed;}
	public function setMemberId(int $int) {$this->_memberId=$int;}
	public function getMemberId():int {return $this->_memberId;}
	public function setPoolId(int $int) {$this->_poolId=$int;}
	public function getPoolId():int {return $this->_poolId;}
	public function setTheTime(int $int) {$this->_theTime=$int;}
	public function getTheTime():int {return $this->_theTime;}
}

abstract class GrcPool_Member_Host_Credit_Paid_MODELDAO extends TableDAO {
	protected $_database = Constants::DATABASE_NAME;
	protected $_table = 'member_host_credit_paid';
	protected $_model = 'GrcPool_Member_Host_Credit_Paid_OBJ';
	protected $_primaryKey = 'id';
	protected $_fields = array(
		'id' => array('type'=>'INT','dbType'=>'int(11)'),
		'hostDbid' => array('type'=>'INT','dbType'=>'int(11)'),
		'totalCredit' => array('type'=>'FLOAT','dbType'=>'decimal(22,6)'),
		'avgCredit' => array('type'=>'FLOAT','dbType'=>'decimal(22,6)'),
		'accountId' => array('type'=>'INT','dbType'=>'smallint(5)'),
		'mag' => array('type'=>'FLOAT','dbType'=>'decimal(9,2)'),
		'owed' => array('type'=>'FLOAT','dbType'=>'decimal(16,8)'),
		'memberId' => array('type'=>'INT','dbType'=>'int(11)'),
		'poolId' => array('type'=>'INT','dbType'=>'smallint(2)'),
		'theTime' => array('type'=>'INT','dbType'=>'int(11)'),
	);
}