<?php
$webPage->append('
	<script src="'.ReactUtils::getApp('homeIndex.js').'"></script>
	<div id="blockNumberCounter" class="col-lg-6" style="border:1px solid pink"></div>							
	<script>
		window.renderComponent("blockNumberCounter","BlockNumberCounter",{});		
	</script>		
');