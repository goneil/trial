<?php
if (isset($_POST['login'])) {
	filterQuotes($_POST['uname']);
	filterQuotes($_POST['pass']);
	if (!$_SESSION['user']->login($_POST['uname'], $_POST['pass'])) {
		echo "<b>Error logging in.</b>";
	} else {
		header('Location: http://'.$_SERVER['HTTP_HOST'].'') ;
	}
}
?>