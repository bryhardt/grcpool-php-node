<?php
class Bootstrap_Panel {
	
	private $header = '';
	private $content = '';
	private $footer = '';
	//private $context = 'default';
	//private $subContent = '';
	private $id = '';
	
	//public function setSubContent($s) {$this->subContent = $s;}
	public function setHeader($s) {$this->header = $s;}
	public function setContent($s) {$this->content = $s;}
	public function setFooter($s) {$this->content = $s;}
	//public function setContext($s) {$this->context = $s;}
	public function setId($s) {$this->id = $s;}
	
	public function render() {
		return '
			<div id="'.$this->id.'" class="card mb-3">
				'.($this->header?'<h5 class="card-header">'.$this->header.'</h5>':'').'
				'.($this->content?'<div class="card-body">'.$this->content.'</div>':'').'
				'.($this->footer?'<div class="card-footer">'.$this->footer.'</div>':'').'
			</div>
		';
	}
	
}