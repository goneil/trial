<?php
if (isset($_POST['changePass'])) {
	filterQuotes($_POST['old']);
	filterQuotes($_POST['new']);
	if (!$_SESSION['user']->changePassword($_POST['old'], $_POST['new'])) {
		echo "Could not change password.";
	}
}

if (isset($_POST['newProj'])) {
	filterQuotes($_POST['name']);
	filterQuotes($_POST['desc']);
	$proj = new Project();
	$vars['name'] = $_POST['name'];
	$vars['description'] = $_POST['desc'];
	$proj->createNew($vars);
}
?>