<?php
declare(strict_types=1);

class GridcoinDaemon {
	
	private $daemon = '';
	private $version = '';
	private $testnet;

	/**
	 * 
	 * @param string $daemon
	 */
	public function __construct(string $daemon) {
		$this->daemon = $daemon;
	}

	/**
	 * 
	 * @return array
	 */
	private function getVersionArray() {
		$version = $this->getVersion();
		$parts = explode(".",$version);
		$parts[0] = str_replace('v','',$parts[0]);
		$parts2 = explode("-",$parts[3]);
		$parts[3] = $parts2[0];
		return $parts;
	}

	/**
	 * 
	 * @param unknown $v
	 * @return boolean
	 */
	public function greaterThanVersion($v) {
		$parts = explode(".",$v);
		$version = $this->getVersionArray();
		if ($version[0] > $parts[0]) {
			return true;
		} else if ($version[0] == $parts[0]) {
			if ($version[1] > $parts[1]) {
				return true;
			} else if ($version[1] == $parts[1]) {
				if ($version[2] > $parts[2]) {
					return true;
				} else if ($version[2] == $parts[2]) {
					if ($version[3] > $parts[3]) {
						return true;
					}
				}
			}
		}
		return false;
	}
	
	/**
	 * 
	 * @param unknown $cmd
	 * @return string|NULL
	 */
 	private function executeDaemon($cmd) {
 		$command = $this->daemon.' '.$cmd;
 		$stdout = $stderr = $status = null;
 		$descriptorspec = array(
 				1 => array('pipe', 'w'),
 				2 => array('pipe', 'w')
 		);
 		$process = proc_open($command, $descriptorspec, $pipes);
 		if (is_resource($process)) {
 			$stdout = stream_get_contents($pipes[1]);
 			fclose($pipes[1]);
 			$stderr = stream_get_contents($pipes[2]);
 			// TODO log error
 			fclose($pipes[2]);
 			$status = proc_close($process);
 		}
 		return $stdout;
 	}
	
 	/**
 	 * 
 	 * @param string $value
 	 * @throws Exception
 	 * @return string
 	 */
	private function safe_json_encode(string $value){
		$encoded = json_encode($value);
		switch (json_last_error()) {
			case JSON_ERROR_NONE:
				return $encoded;
			case JSON_ERROR_DEPTH:
				throw new Exception();
			case JSON_ERROR_STATE_MISMATCH:
				throw new Exception();
			case JSON_ERROR_CTRL_CHAR:
				throw new Exception();
			case JSON_ERROR_SYNTAX:
				throw new Exception();
			case JSON_ERROR_UTF8:
				$clean = $this->utf8ize($value);
				return $this->safe_json_encode($clean);
			default:
				throw new Exception();
		}
	}
	
	/**
	 * 
	 * @param unknown $mixed
	 * @return string
	 */
	private function utf8ize($mixed) {
		if (is_array($mixed)) {
			foreach ($mixed as $key => $value) {
				$mixed[$key] = $this->utf8ize($value);
			}
		} else if (is_string ($mixed)) {
			return utf8_encode($mixed);
		}
		return $mixed;
	}
	
////////////////////////////////////////////////////////////////////////////////

	/**
	 * 
	 * @return mixed
	 */
	public function isTestnet() {
		if ($this->testnet == null) {
			$data = $this->executeDaemon('getinfo');
			$json = json_decode($data,true);
			$this->testnet = $json['testnet'];
		}
		return $this->testnet;
	}

	/**
	 *
	 * @return string
	 */
	public function getVersion() {
		if ($this->version == '') {
			$data = $this->executeDaemon('getinfo');
			$json = json_decode($data,true);
			$version = $json['version'];
			$this->version = trim($version);
		}
		return $this->version;
	}
	
	/**
	 * 
	 * @return mixed
	 */
 	public function getInfo() {
 		$data = $this->executeDaemon('getinfo');
 		$json = json_decode($data,true);
 		$this->version = trim($json['version']);
 		$this->testnet = $json['testnet'];
 		return $json;
 	}
	
 	/**
 	 * 
 	 * @return mixed[]
 	 */
 	public function getSuperBlock() {
 		if ($this->greaterThanVersion('3.7.11.1',true)) {
 			$data = $this->executeDaemon('superblockage');
 			$data = json_decode($data,true);
 		} else {
 			$data = $this->executeDaemon('execute superblockage');
 			$data = json_decode($data,true);
 			$data = $data[1];
 		}
 		$result = array();
 		$result['timestamp'] = strtotime(str_replace('-','/',$data['Superblock Timestamp']));
 		$result['age'] = $data['Superblock Age'];
 		$result['pending'] = floor($data['Pending Superblock Height']);
 		$result['block'] = floor($data['Superblock Block Number']);
 		return $result;
 	}
 	
 	/**
 	 * 
 	 * @param string $cpid
 	 * @return mixed
 	 */
 	public function getRsa(string $cpid = '') {
 		if ($cpid == '') {
 			$data = $this->executeDaemon('list rsa');
 		} else {
 			$data = $this->executeDaemon('list magnitude '.$cpid);
 		}
 		$json = json_decode($data,true);
 		return $json;
 	}
 	
 	/**
 	 * 
 	 * @param string $cpid
 	 * @return int
 	 */
 	public function getMagnitude(string $cpid = ''):int {
  		$data = $this->getRsa($cpid);
 		$mag = 0;
 		if (isset($data[1]) && isset($data[1]['Magnitude (Last Superblock)'])) {
 			$mag = $data[1]['Magnitude (Last Superblock)'];
 		}
 		return trim($mag);
 	}
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
////////////////////////////////////////////////////////////////////////////////	
	
// 	public function getActualDataDir() {
// 		return $this->datadir.($this->testnet?'/testnet':'');
// 	}
	
// 	/**
// 	 * 
// 	 * @return GrcPool_Daemon_PollQuestion[]
// 	 */	
// 	public function getPolls() {
// 		$result = array();
// 		$data = $this->executeDaemon('execute listpolls');
// 		$json = json_decode($data,true);
// 		if (isset($json[1]) && isset($json[1][0])) {
// 			$first = true;
// 			foreach ($json[1][0] as $idx => $p) {
// 				if ($first) {
// 					$first = false;
// 					continue;
// 				}
// 				$poll = new GrcPool_Daemon_Poll();
// 				$poll->setTitle(trim($p));
// 				$expireStart = strpos($idx,'(');
// 				$expireEnd = strpos($idx,')');
// 				$expire = trim(substr($idx,$expireStart+1,$expireEnd-$expireStart-1));
// 				$parts = explode(" ",$expire);
// 				$parts2 = explode("-",$parts[0]);
// 				$expire = strtotime($parts2[2].'-'.$parts2[0].'-'.$parts2[1].' '.$parts[1]);
// 				$poll->setExpire($expire);
// 				$poll->setType(trim(substr($idx,strpos($idx,'-',$expireEnd)+1)));
// 				$data = $this->getPollDetail($poll->getTitle());
// 				$detail = json_decode($data,true);
// 				if (isset($detail[1]['Error'])) {
// 					continue;
// 				}
// 				$poll->setQuestion($detail[1][0]['Question']);
// 				$poll->setTotalVotes($detail[1][0]['Participants']);
// 				$poll->setTotalShares($detail[1][0]['Total Shares']);
// 				$poll->setBestAnswer($detail[1][0]['Best Answer']);
// 				$keys = array_keys($detail[1][0]);
// 				for ($i = 3; $i < count($keys)-3; $i++) {
// 					$pollAnswer = new GrcPool_Daemon_PollAnswer();
// 					$voteStart = strpos($keys[$i],'[');
// 					$voteEnd =  strpos($keys[$i],']');
// 					$pollAnswer->setVotes(substr($keys[$i],$voteStart+1,$voteEnd-$voteStart-1));
// 					$parts = explode(" ",$keys[$i]);
// 					$pollAnswer->setAnswer($parts[count($parts)-1]);
// 					$pollAnswer->setShare($detail[1][0][$keys[$i]]);
// 					$poll->addAnswer($pollAnswer);
// 				}
// 				array_push($result,$poll);
// 			}
// 		}		
// 		return $result;
// 	}
	
// 	public function getPollDetail($question) {
// 		$question = str_replace('"','\"',$question);
// 		return $this->executeDaemon('execute listpollresults "'.$question.'"');
// 	}
	
// 	public function setDataDir($s) {
// 		$this->datadir = $s;
// 	}
// 	public function setPath($s) {
// 		$this->path = $s;
// 	}
// 	public function isTestNet() {
// 		return $this->testnet;
// 	}
// 	public function setTestnet($b) {
// 		$this->testnet = $b;
// 	}
	
// 	public function getBlockHeight() {
// 		return trim($this->executeDaemon('getblockcount'));
// 	}
	

	
// 	public function isAddress($address) {
// 		$data = $this->executeDaemon('validateaddress '.$address);
// 		$data = json_decode($data,true);
// 		if (isset($data['isvalid'])) {
// 			return $data['isvalid'];
// 		} else {
// 			return false;
// 		}
// 	}
	
// 	public function send($toAddress,$amount,$comment = '') {
// 		if ($this->testnet) {
// 			$cmd = 'sendtoaddress '.$toAddress.' '.$amount.($comment!=''?' "'.$comment.'" "'.$comment.'"':'');
// 			echo $cmd."\n";
// 			$data = $this->executeDaemon($cmd);
// 		} else {
// 			$data = $this->executeDaemon('sendtoaddress '.$toAddress.' '.$amount);
// 		}
// 		return trim($data);
// 	}

	

// 	public function getAvailableBalance() {
// 		$data = $this->executeDaemon('getbalance');
// 		return trim($data);
// 	}
	
// 	public function getTotalInterest($cpid = '') {
// 		$data = $this->getRsa($cpid);
// 		$interest = isset($data[1]['CPID Lifetime Interest Paid'])?$data[1]['CPID Lifetime Interest Paid']:0;
// 		return $interest;
// 	}
	
// 	public function getMoneySupply() {
// 		$info = $this->getInfo();
// 		return $info['moneysupply'];
// 	}
	
	
// 	public function getTotalBalance() {
// 		$data = $this->executeDaemon('getinfo');
// 		$json = json_decode($data,true);
// 		$balance = $json['balance']+$json['stake'];
// 		return trim($balance);
// 	}


	
// //	public function getStakingInfo() {
// //		$data = $this->executeDaemon('getstakinginfo');
// //		$json = json_decode($data,true);
// //		return $json;
// //	}
	

	
// 	public function sendMany($many) {
// 		//sendmany <fromaccount> {address:amount,...} [minconf=1] [comment]
// 		//sendmany "test" "{\"mrAgidiJ5TwxGsQNnADRxY6cyWRnm4x2Xd\":25.01,\"mhoAu3qvv81BdZWeaxZH2qmPFc6Et8LD4r\":35.000001}"
// 		$string = '';
// 		foreach ($many as $m) {
			 
// 		}
// 	}
	
// 	public function getBlockHash($block) {
// 		return $this->executeDaemon('getblockhash '.$block);
// 	}
	
// 	public function getBlock($blockHash) {
// 		return json_decode($this->executeDaemon('getblock '.$blockHash),true);
// 	}
	
// 	public function getWhitelistedProjects($block = '') {
// 		if ($block == '') {
// 			$data = $this->getSuperBlockAge();
// 			$block = $data['block'];
// 		}
// 		if ($block == '') return;
// 		$blockHash = $this->getBlockHash($block);
// 		if ($blockHash == '') return;
// 		$blockData = $this->getBlock($blockHash);
// 		if ($blockData['IsSuperBlock'] == '') return;
// 		$txHash = $blockData['tx'][0];
// 		$txJson = $this->executeDaemon('gettransaction '.$txHash);
// 		$txJson = $this->utf8ize($txJson);
// 		$tx = json_decode($txJson,true);
// 		$hashBoinc = $tx['hashboinc'];
// 		$thisMatchArray = null;
/* 		preg_match_all("/<(?'Key'[a-zA-Z].*?)>(?'Value'.*?)<\/.*?>/m", $hashBoinc, $thisMatch); */
// 		for($c=0;$c < count($thisMatch['Key']);$c++) {
// 			if($thisMatch['Key'][$c] == "|") {
// 				$thisMatchArray[$thisMatch['Key'][$c]][] = addslashes($thisMatch['Value'][$c]);
// 			} else {
// 				$thisMatchArray[$thisMatch['Key'][$c]] = addslashes($thisMatch['Value'][$c]);
// 			}
// 		}
// 		preg_match_all("/(?'Project'.*?),(?'TotalRAC'.*?);/m", $thisMatchArray['AVERAGES'], $thisMatchProjects);
// 		$projects = $thisMatchProjects['Project'];
// 		array_pop($projects);
// 		return $projects;
		

// 	}
	
	
	
//}
