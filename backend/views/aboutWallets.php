<?php
$webPage->appendTitle('Pool Wallets');

$panel1 = new Bootstrap_Panel();
$panel1->setHeader('Staking Wallets');
$panel1->setContent('
	The staking wallets maintain the magnitude, receives the proof of research awards, and interest payments.
	At regular intervals, the balance of the staking wallet is checked and if it is found greater than its seeded balance, the
	excess is sent to the pool\'s hot wallet to generate an updated owed amount.
	<br/><br/>
	The pool\'s staking wallet address'.(count($this->view->hotWallets)>1?'es':'').':
	<ul>
		'.(implode('',
			array_map(function($arr,$key) {
				return '<li>'.(count($this->view->stakingWallets)>1?'#'.($key+1):'').' <a href="'.GrcPool_Utils::getGrcAddressUrl($arr).'">'.$arr.'</a> <i class="fa fa-external-link"></i></li>';
			},$this->view->stakingWallets,array_keys($this->view->stakingWallets))
		)).'
	</ul>
');

$panel2 = new Bootstrap_Panel();
$panel2->setHeader('Hot Wallets');
$panel2->setContent('
	The hot wallets contain the necessary GRC to handle all owed GRC within the pool at any moment. Since the hot wallet does not stake or collect interest,
	there is no reason to hold GRC on the pool.
	<br/><br/>
	The pool\'s hot wallet address'.(count($this->view->hotWallets)>1?'es':'').':
	<ul>
		'.(implode('',
			array_map(function($arr,$key) {
				return '<li>'.(count($this->view->hotWallets)>1?'#'.($key+1):'').' <a href="'.GrcPool_Utils::getGrcAddressUrl($arr).'">'.$arr.'</a> <i class="fa fa-external-link"></i></li>';
			},$this->view->hotWallets,array_keys($this->view->hotWallets))
		)).'
	</ul> 
');

$webPage->append('
	<div class="container-fluid mb-3">
		Each pool utilizes two wallets, one for staking and one for payout (hot).
		This two wallet system allow for more flexibility and security.
	</div>
	'.$panel1->render().'
	'.$panel2->render().'
');