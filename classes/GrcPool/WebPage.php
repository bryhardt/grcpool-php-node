<?php
class GrcPool_WebPage {
 	public $title;
 	public $head = '';
 	public $script = '';
 	
 	public $metaKeywords = 'gridcoin, pool, mining, boinc, science, research, cryptocurrency';
 	public $metaDescription = 'This is a Gridcoin Research Mining Pool. Join the pool, crunch, and earn Gridcoin!';
// 	public $pageTitle;

// 	private $head = '';
// 	private $body = '';
// 	private $script = '';
// 	private $secondaryNav = '';
// 	private $homeBody = '';
// 	private $isHome = false;
// 	private $breadcrumbs = array();

// 	public function setHome($b) {$this->isHome = $b;}
// 	public function appendHomeBody($str) {$this->homeBody .= $str;}
// 	public function setSecondaryNav($str) {$this->secondaryNav=$str;}
// 	public function getBody() {return $this->body;}
// 	public function setBody($str) {$this->body = $str;}
// 	public function append($str) {$this->body .= $str;}
// 	public function appendHead($str) {$this->head .= $str;}
// 	public function appendScript($str) {$this->script .= $str;}
// 	public function appendTitle($str) {$this->title .= ' &bull; '.$str;}
// 	public function renderSecondaryNav() {
// 		if ($this->secondaryNav) {
// 			return '<div style="margin-top:20px;margin-bottom:30px;">'.$this->secondaryNav.'</div>';
// 		}
// 	}
// 	public function setPageTitle($str) {
// 		$this->pageTitle = $str;
// 	}
// 	public function addBreadcrumb($title,$icon = '',$href='') {
// 		array_push($this->breadcrumbs,array('title'=>$title,'link'=>$href,'icon'=>$icon));
// 	}
// 	private function renderPageTitle() {
// 		return $this->pageTitle?'<div class="page-header rowpad" style="margin-top:10px;"><h1>'.$this->pageTitle.'</h1></div>':'';
// 	}
// 	private function renderBreadcrumb() {
// 		$result = '';
// 		if ($this->breadcrumbs) {
// 			$result .= '<ol class="rounded breadcrumb hidden-xs" style="margin-bottom:20px;">';
// 			$result .= '<li><a href="/"><i class="fa fa-home"></i> Home</a></li>';
// 			foreach ($this->breadcrumbs as $idx => $crumb) {
// 				$result .= '<li style="'.($crumb['link']!=""?'':'color:gray;').'" class="'.($idx+1 == count($this->breadcrumbs)?'':'').'">'.($crumb['link']!=""?'<a href="'.$crumb['link'].'">':'').''.($crumb['icon']!=""?'<i class="fa fa-'.$crumb['icon'].'"></i> ':'').$crumb['title'].''.($crumb['link']!=""?'</a>':'').'</li>';
// 			}
// 			$result .= '</ol>';
// 		}
// 		return $result;
// 	}
// 	private function getUserBar() {
// 		global $USER;
// 		$cache = new Cache();
// 		$blockData = new BlockData($cache->get(Constants::CACHE_BLOCK_DATA));
// 		$dao = new GrcPool_View_Member_Host_Project_Credit_DAO();
// 		$owed = '';
// 		if ($USER->getId() != 0) {
// 			$owed = $dao->getOwedForMember($USER->getId());
// 		}
// 		return '
// 			<div class="container" style="padding-top:20px;">
// 				<div class="pull-right rowpadsmall">
// 					'.($USER->getId() == 0?'
// 						<a href="/login"><i class="fa fa-power-off"></i> login</a>
// 						&nbsp;|&nbsp;
// 						<a href="/signup"><i class="fa fa-edit"></i> sign up</a>
// 					':'
// 						<a href="/logout"><i class="fa fa-power-off"></i> logout</a>
// 						&nbsp;|&nbsp;
// 						<a href="/account">
// 						'.($USER->hasAlerts()?'
// 							<i class="fa fa-warning text-danger"></i>
// 						':'
// 							<i class="fa fa-user"></i>
// 						').'
//  						'.($USER->getUsername()).'</a>
// 						|
// 						Owed: <a href="/account/owed">'.number_format($owed,3,'.','').'</a>
// 					').'
// 				</div>
// 				<div>
// 					<small>
// 						<a href="/content/block" style="color:black;text-decoration:underline;"><span id="blockHeight">'.$blockData->block.'</span></a> | 
// 						grc: <i class="fa fa-bitcoin"></i><span id="btc_grc">'.$cache->get(Constants::CACHE_POLONIEX_GRC_VALUE).'</span>
// 						|
// 						btc: <i class="fa fa-dollar"></i><span id="btc_usd">'.$cache->get(Constants::CACHE_COINBASE_BTC_VALUE).'</span>
// 					</small>
// 				</div>
// 			</div>
// 		';
// 	}

	private function getBanner():string {
		//$settingsDao = new GrcPool_Settings_DAO();
		//$online = $settingsDao->getValueWithName(Constants::SETTINGS_GRC_CLIENT_ONLINE);
		$return = '';
		//if (!$online) {
		//	$return .= '<div style="padding:10px;color:white;font-weight:bold;background-color:darkred;text-align:center;">'.$settingsDao->getValueWithName(Constants::SETTINGS_GRC_CLIENT_MESSAGE).'</div>';
		//}
		//$message = $settingsDao->getValueWithName(Constants::SETTINGS_GRC_MESSAGE);
		//if ($message != '') {
		//	$return .= '<div style="padding:11px;color:white;font-weight:bold;background-color:#333;text-align:center;">'.$message.'</div>';
		//}
		return $return;
	}

 	/**
 	 * 
 	 * @return int
 	 */
 	private function getNumberOfPolls():int {
 		$numberOfPolls = 0;
 		// 		$pollDao = new GrcPool_Poll_Question_DAO();
 		// 		$polls = $pollDao->getActivePolls();
 		// 		$numberOfPolls = count($polls);
 		// 		if ($USER->getId() != 0) {
 		// 			$voteDao = new GrcPool_Poll_Vote_DAO();
 		// 			$ids = $voteDao->getPollsVotedIn($USER->getId());
 		// 			foreach ($polls as $poll) {
 		// 				if (array_search($poll->getId(),$ids) !== false) {
 		// 					$numberOfPolls--;
 		// 				}
 		// 			}
 		// 		}
 		// 		if ($numberOfPolls < 0) {
 		// 			$numberOfPolls = 0;
 		// 		}
 		return $numberOfPolls;
 	}
 	
 	/**
 	 * 
 	 * @return Bootstrap_NavBar
 	 */
 	private function getNavBar():Bootstrap_NavBar {
 		$navbar = new Bootstrap_NavBar();
 		$navbar->setBrandName('grcpool.com'); // TODO
 		$navbar->setNavItems(file_get_contents(dirname(__FILE__).'/../../content/nav.json'));
 		return $navbar;
 	}
 	
	public function display() {
		echo '<!doctype html>
			<html lang="en">
				<head>
  					<meta charset="utf-8">
  					<title>'.$this->title.'</title>
  					<meta name="description" content="'.$this->metaDescription.'">
  					<meta name="author" content="'.$this->metaKeywords.'">
	 				<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 				<meta http-equiv="X-UA-Compatible" content="IE=edge">
	 				<link rel="icon" href="/favicon.ico?20170214" type="image/x-icon"> 
 					<link rel="stylesheet" href="/assets/libs/bootstrap.4.0.0/theme/toolkit-inverse.min.css"/>
					<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.11/css/all.css" integrity="sha384-p2jx59pefphTFIpeqCcISO9MdVfIm4pNnsL08A6v5vaQc4owkQqxMV8kg4Yvhaw/" crossorigin="anonymous">
 					<link rel="stylesheet" href="/assets/css/grcpool.css?20170714"/>	
	 				<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	 				<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
	 				<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
	 				<link rel="manifest" href="/manifest.json">
	 				<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	 				<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />						
	 				<meta name="theme-color" content="#ffffff">
	 				<meta name="msapplication-TileImage" content="/ms-icon-144x144.png?20170214">
	 				<meta property="og:description" content="This is a mining pool for the cryptocurrency Gridcoin."/>
	 				<meta property="og:title" content="grcpool.com"/>
	 				<meta property="og:url" content="https://www.grcpool.com"/>
	 				<meta property="og:site_name" content="grcpool.com"/>
	 				<meta property="og:type" content="website"/>
	 				<meta property="og:image" content="https://www.grcpool.com/assets/images/gpLogo1200.png"/>
	  				'.$this->head.'
	  				<script>
	  					var webPageData = {
	  						"numberOfPolls" : '.$this->getNumberOfPolls().'
	  					}
	  				</script>
					<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>	  								
  				</head>
  				<body>
	  				'.$this->getBanner().'
  					'.$this->getNavBar()->render().'	  								
					<div class="container-fluid">
	  					<div class="dashhead">
  							<div class="dashhead-titles">
    							<!--<h6 class="dashhead-subtitle">Dashboards</h6>
    							<h3 class="dashhead-title">Overview</h3>-->
  							</div>
  							<div class="dashhead-toolbar">
    							<div class="dashhead-toolbar-item">
  									Login
    							</div>
    							<span class="dashhead-toolbar-divider hidden-xs"></span>
    							<div class="btn-group dashhead-toolbar-item btn-group-thirds">
									Sign Up
    							</div>
  							</div>
						</div>  								
  					</div>

<canvas id="chartjs-4" class="chartjs" width="1454" height="726" style="display: block; height: 363px; width: 727px;"></canvas>	
<script>  							
new Chart(document.getElementById("chartjs-4"),{
  	"type":"doughnut",
    "title" : "whatever",
  	"data":{"labels":["Red","Blue","Yellow"],
  	"datasets":[
  		{
  			"label":"My First Dataset",
  			"data":[300,50,100],
  			"backgroundColor":["rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)"]
		}
  	]}});  		
  							
  							
  	setTimeout(function updateConfigByMutating(chart) {
    chart.options.title.text = \'new title\';
    chart.update();},2000);
 </script>					
					<div id="react-BTCPrice">$ 10,000</div>
					<div id="react-GRCPrice">B .00000001</div>
					<div id="react-BlockHeight">1,000,000</div>

					<script>
						var reactWebPageData = {	
							"BTCPrice" : 10000.00,
							"GRCPrice" : .00000100,
							"BlockHeight" : 1000000
						}
					</script>
					<script src="/assets/libs/react/'.ReactUtils::getAppFile('webPage.js').'"></script>
							
							
							
 					<script src="/assets/libs/jquery.3.3.1/jquery-3.3.1.min.js" type="text/javascript"></script>
  					<script src="/assets/libs/popper.1.14.3/popper.min.js" type="text/javascript"></script>
					<script type="text/javascript" src="/assets/libs/bootstrap.4.0.0/theme/toolkit.min.js"></script>
	 				'.$this->script.'
					<script>
					  (function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
					  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
					  })(window,document,\'script\',\'https://www.google-analytics.com/analytics.js\',\'ga\');
					  ga(\'create\', \'UA-91641882-1\', \'auto\');
					  ga(\'send\', \'pageview\');
					</script>
					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1836912156576334";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, \'script\', \'facebook-jssdk\'));</script>
					<script src="https://apis.google.com/js/platform.js"></script>
					<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
					<script>
						window.addEventListener("load", function(){
						window.cookieconsent.initialise({
					  		"palette": {
					    	"popup": {
					      		"background": "#252e39"
					    	},
					    	"button": {
					      		"background": "#14a7d0"
					    	}
					  	},
					  	"theme": "edgeless"
						})});
					</script>  							    		
  				</body>
			</html>
		';
	}
	
// 	public function display() {
// 		echo '<!DOCTYPE html>
//  		<html>
//  			<head>
//  				<title>Gridcoin Pool '.$this->title.'</title>
//  				<meta name="keywords" content="'.htmlspecialchars($this->metaKeywords).'"/>
//  				<meta name="description" content="'.htmlspecialchars($this->metaDescription).'"/>
//  				<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
// 				<meta name="viewport" content="width=device-width, initial-scale=1.0">
// 				<meta http-equiv="X-UA-Compatible" content="IE=edge">
// 				<link rel="icon" href="/favicon.ico?20170214" type="image/x-icon"> 
// 				<link rel="stylesheet" href="/assets/libs/bootstrap/3.3.5/css/bootstrap.min.css"/>
// 				<link rel="stylesheet" href="/assets/libs/fontAwesome/4.6.3/css/font-awesome.min.css"/>
// 				<link rel="stylesheet" href="/assets/css/grcpool.css?20170714"/>	
// 				<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
// 				<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
// 				<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
// 				<link rel="manifest" href="/manifest.json">
// 				<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
// 				<meta name="theme-color" content="#ffffff">
// 				<link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
// 				<meta name="msapplication-TileImage" content="/ms-icon-144x144.png?20170214">
// 				<meta property="og:description" content="This is a mining pool for the cryptocurrency Gridcoin."/>
// 				<meta property="og:title" content="grcpool.com"/>
// 				<meta property="og:url" content="https://www.grcpool.com"/>
// 				<meta property="og:site_name" content="grcpool.com"/>
// 				<meta property="og:type" content="website"/>
// 				<!--<meta property="fb:admins" content=""/>-->
// 				<meta property="og:image" content="https://www.grcpool.com/assets/images/gpLogo1200.png"/>
//  				'.$this->head.'
// 				<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
//  			</head>
//  			<body>
// 				'.$this->getTestBanner().'
// 				'.($this->isHome?'<div style="background-repeat:no-repeat;background-image:url(/assets/images/pool.jpg)">':'').'
// 	 				'.$this->getUserBar().'
// 		 			<div class="container" style="margin-bottom:20px;">
// 						<nav class="navbar navbar-inverse" style="margin-bottom:10px;">
// 			  				<div class="container-fluid">
// 			    				<div class="navbar-header">
// 			     						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
// 			       						<span class="sr-only">Toggle navigation</span>
// 			        					<span class="icon-bar"></span>
// 			       						<span class="icon-bar"></span>
// 			       						<span class="icon-bar"></span>
// 			     						</button>
// 										<a href="/" class="navbar-left"><img style="width:35px;height:35px;margin-top:7px;margin-right:5px;" src="/assets/images/gpLogo.png"></a>
// 			     						<a class="navbar-brand" href="/">
// 	 										<span style="color:white;">grcpool</span></span>
// 	 									</a>
// 			   					</div>
// 			   					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
// 			     					<ul class="nav navbar-nav">
// 		 								<li class="dropdown '.(strstr($_SERVER['REQUEST_URI'],'/about')?'active':'').'">
// 			          						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About <span class="caret"></span></a>
// 			          						<ul class="dropdown-menu">
// 			            						<li><a href="/about/fees">Fees and Donations</a></li>
// 		 										<li><a href="/about/calculations">Calculations</a></li>
// 		 										<li><a href="/about/hotWallet">Pool Staking Wallet</a></li>
// 												<li><a href="/about/sparc">SPARC Network</a></li>
// 		 										<li><a href="/about/system">System Status</a></li>
// 			         						</ul>
// 								        </li>
// 			      					</ul>
// 			    				</div>
// 			  				</div>
// 						</nav>
// 						<div>
// 							<div class="pull-right" style="margin-left:5px;">
// 								<div class="g-ytsubscribe" data-channelid="UC7HniwuUMx4EXlB2OXG89BA" data-layout="default" data-count="default"></div>
// 							</div>
// 							<div class="pull-right"  style="margin-left:5px;height:24px;border-radius:3px;">
// 								<a style="" href="https://twitter.com/grcpool" class="twitter-follow-button" data-show-count="false">Follow @grcpool</a>
// 							</div>
// 							<div class="pull-right" style="height:24px;border-radius:3px;">
// 								<div style="" class="fb-follow" data-href="https://www.facebook.com/gridcoinpool" data-layout="button_count" data-size="small" data-show-faces="false"></div>
// 							</div>
// 						</div>
// 						<br clear="all"/>
// 		 			</div>
// 	 				<div class="container">
// 						'.$this->renderBreadcrumb().'
// 	 					'.$this->renderSecondaryNav().'
// 	 					'.$this->renderPageTitle().'
// 	 					'.($this->isHome?$this->homeBody:$this->body).'
// 	 					<br/><br/>
// 	 				</div>
// 	 			'.($this->isHome?'</div>':'').'
// 	 			<div class="container">
// 					'.($this->isHome?$this->body:'').'
// 	 					<hr/>
// 	 					<div class="pull-right" style="margin-left:50px;"><a href="mailto:admin@grcpool.com">admin@grcpool.com</a></div>
// 	 					<span style="white-space: nowrap;"><a href="https://www.gridcoin.us/">Gridcoin Website</a> |</span>
// 	 					<span style="white-space: nowrap;"><a href="http://www.gridresearchcorp.com/gridcoin/">Gridcoin Block Explorer</a> |</span>
// 	 					<span style="white-space: nowrap;"><a href="http://teamgridcoin.slack.com">Gridcoin Slack</a> |</span>
// 	 					<span style="white-space: nowrap;"><a href="https://cryptocurrencytalk.com/topic/1331-new-coin-launch-announcement-grc-gridcoin/?view=getnewpost">Gridcoin Forum</a></span>
// 	 					<br/><br/><br/><br/><br/><br/><br/><br/>
// 	 				</div>
	 	

// 			</body>
//  		</html>';
// 	}
}
