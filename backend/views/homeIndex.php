<?php
declare(strict_types=1);
$webPage->append('	
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-md-4">
				<div id="blockNumberCounter"></div>
				<div class="text-center">Current Block</div>
			</div>
			<div class="col-xs-12 col-md-4">
				<div id="superBlockNumberCounter"></div>
				<div class="text-center">Super Block</div>
			</div>
			<div class="col-xs-12 col-md-4">
				<div id="poolNetworkMag"></div>
				<div class="text-center">Network Mag</div>
			</div>
			<div class="col-xs-12 col-md-4">
				<div id="poolMag"></div>
				<div class="text-center">Pool Mag</div>
			</div>
		</div>
		<div class="row">
			<table>
				<thead>
					<tr>
						<th>Pool</th>
					</tr>
				</thead>
				<tbody>
					'.((function() { 
						$html = '';
						foreach ($this->view->cpids as $idx => $cpid) {
							$html .= '
								<tr>
									<td>'.$idx.'</td>
									<td>'.$cpid.'</td>
									<td>Stats</td>
									<td>Netsoft</td>
								</tr>
							';
						}
						return $html;
					 })()).'		
				</tbody>
			</table>
		</div>
	</div>
	<script src="'.ReactUtils::getApp('homeIndex.js').'"></script>
	<script>
		window.renderComponent("blockNumberCounter","BlockNumberCounter",'.$this->view->currentBlock.');		
		window.renderComponent("superBlockNumberCounter","SuperBlockNumberCounter",'.$this->view->currentSuperBlock.');
		//window.renderComponent("poolNetworkMag","PoolNetworkMag",'.$this->view->networkMags.');		
		window.renderComponent("poolMag","PoolMag",'.$this->view->poolMags.');
				
				
	</script>		
');