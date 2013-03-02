<?php 
if (isset($_POST['newUser'])) {
	filterQuotes($_POST['uname']);
	filterQuotes($_POST['pass']);
	filterQuotes($_POST['name']);
	filterQuotes($_POST['email']);
	if (!$_SESSION['user']->createUser($_POST['uname'], $_POST['pass'], $_POST['name'], $_POST['email'])) {
		echo "User not created";
	}
}
?>