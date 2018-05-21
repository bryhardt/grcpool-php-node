<?php
$webPage->appendTitle('Feed and Donations');

$panel1 = new Bootstrap_Panel();
$panel1->setHeader('Fees');
$panel1->setContent('
	The pool is currently operating at a flat payout fee of only <strong>'.$this->view->payoutFee.'</strong> GRC. 
');

$panel2 = new Bootstrap_Panel();
$panel2->setHeader('Donations');
$panel2->setContent('
	The default donation setting is zero. Any donation amount would be very much appreciated.
	Donations are optional and can be configured from your account page.
	If you would like to directly donate to the support of the pool, please use address: <i class="fa fa-external-link"></i> <a href="'.GrcPool_Utils::getGrcAddressUrl($this->view->donationAddress).'">'.$this->view->donationAddress.'</a>.
');

$webPage->append('
	<div class="container-fluid">
		'.$panel1->render().'
		'.$panel2->render().'
	</div>
');