<?php
	session_start();
	function __autoload($name) {
		require_once('../' . $name . '.class.php');
	}
	$database = new Database();
	$error = new Error();
?>