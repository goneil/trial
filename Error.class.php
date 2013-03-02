<?php
class Error {
	private $buffer = '';
	
	function write($str) {
		$this->buffer .= $str . ' ';
	}
	
	function flush() {
		echo $this->buffer;
		$this->buffer = '';
	}
}
?>