<?php
/* ***********************************************************************
THIS FILE WAS CREATED AUTOMATICALLY BY PHP MODEL/OBJECT CREATOR
MANUAL MODIFICATIONS WILL BE AUTOMATICALLY OVERWRITTEN
************************************************************************ */
abstract class GrcPool_Projectrain_MODEL {

	public function __construct() { }

	private $_id = 0;
	private $_transaction = '';
	private $_project = '';
	private $_accountId = 0;
	private $_poolId = 0;
	private $_projectRaw = '';
	private $_amount = 0.00000000;
	private $_paid = 0;
	public function setId(int $int) {$this->_id=$int;}
	public function getId():int {return $this->_id;}
	public function setTransaction(string $string) {$this->_transaction=$string;}
	public function getTransaction():string {return $this->_transaction;}
	public function setProject(string $string) {$this->_project=$string;}
	public function getProject():string {return $this->_project;}
	public function setAccountId(int $int) {$this->_accountId=$int;}
	public function getAccountId():int {return $this->_accountId;}
	public function setPoolId(int $int) {$this->_poolId=$int;}
	public function getPoolId():int {return $this->_poolId;}
	public function setProjectRaw(string $string) {$this->_projectRaw=$string;}
	public function getProjectRaw():string {return $this->_projectRaw;}
	public function setAmount(float $float) {$this->_amount=$float;}
	public function getAmount():float {return $this->_amount;}
	public function setPaid(int $int) {$this->_paid=$int;}
	public function getPaid():int {return $this->_paid;}
}

abstract class GrcPool_Projectrain_MODELDAO extends TableDAO {
	protected $_database = Constants::DATABASE_NAME;
	protected $_table = 'projectrain';
	protected $_model = 'GrcPool_Projectrain_OBJ';
	protected $_primaryKey = 'id';
	protected $_fields = array(
		'id' => array('type'=>'INT','dbType'=>'int(11)'),
		'transaction' => array('type'=>'STRING','dbType'=>'varchar(100)'),
		'project' => array('type'=>'STRING','dbType'=>'varchar(100)'),
		'accountId' => array('type'=>'INT','dbType'=>'tinyint(3)'),
		'poolId' => array('type'=>'INT','dbType'=>'tinyint(2)'),
		'projectRaw' => array('type'=>'STRING','dbType'=>'varchar(500)'),
		'amount' => array('type'=>'FLOAT','dbType'=>'decimal(20,8)'),
		'paid' => array('type'=>'INT','dbType'=>'tinyint(1)'),
	);
}