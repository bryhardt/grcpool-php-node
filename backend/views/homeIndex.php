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
		</div>
	</div>
	
							

	<script src="'.ReactUtils::getApp('homeIndex.js').'"></script>
	<script>
		window.renderComponent("blockNumberCounter","BlockNumberCounter",{blockHeight:1000000,blockTime:'.(time()-20).'});		
		window.renderComponent("superBlockNumberCounter","SuperBlockNumberCounter",{blockHeight:1000000,blockTime:'.(time()-20000).'});
	</script>		
');