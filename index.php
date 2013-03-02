<?php
session_start();
function __autoload($name) {
	require_once($name . '.class.php');
}
$database = new Database();
$error = new Error();
require_once('functions.inc.php');
if (!isset($_SESSION['user'])) {
	$_SESSION['user'] = new User();
}
if (isset($_POST['logout'])) {
	$_SESSION['user']->logout();
}
$request = array_slice(explode('/',$_SERVER['REQUEST_URI']),1);
if (loggedIn()) { 
	$userInfo = $_SESSION['user']->getInfo();
}
switch ($request[0]) {
	case 'upload': $calc = 'upload-calc.php'; break;
	case 'setup': $calc = 'setup-calc.php'; break;
	case 'register': $calc = 'register-calc.php'; break;
	case 'user': $calc = 'user-calc.php'; break;
	case 'login': $calc = 'login-calc.php'; break;
	case 'map': $calc = 'map-calc.php'; break;
	case 'project': $calc = 'project-calc.php'; break;
	case 'projects': $calc = 'projects-calc.php'; break;
	case 'demo': $calc = 'demo-calc.php'; break;
	default: $calc = 'index-calc.php';
}
include($calc);
if (loggedIn()) { 
	$userInfo = $_SESSION['user']->getInfo();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/images/ecostyle.css" />
	<script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/images/script.js" type="text/javascript"></script>
</head>
<body>
<div class="all">
    <div class="banner" id="banner1"><img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/images/grassbanner1.jpg"></img></div>
	<div>
		<?php if (loggedIn()) {
			echo '<div class="navbar">';
			echo '<div style="display: inline;">Welcome ',$userInfo['name'],'! </div>';
			echo '<div style="display: inline;">[ <a class="navbar" href="http://'.$_SERVER['HTTP_HOST'].'#" onclick="document.logoutform.submit();">Logout</a> ]</div>';
			echo '<div style="display: inline;"><form method="post" name="logoutform"><input type="hidden" name="logout" value="Log Out" /></form></div>';
			echo '</div>';
		} else {
			echo '<div class="navbar">Please [ <a class="navbar" href="http://'.$_SERVER['HTTP_HOST'].'/login">login</a> ] or [ <a class="navbar" href="http://'.$_SERVER['HTTP_HOST'].'/register">register</a> ]</div>';
		}?>
	</div> 
    <?php include('mainmenu.php'); ?>
    <div class="content">
	<?php
	if (!isset($draw)) {
		switch ($request[0]){
			case 'home': $draw = 'index-draw.php';break;
			case 'upload': $draw = 'upload-draw.php'; break;
			case 'register': $draw = 'register-draw.php'; break;
			case 'user': $draw = 'user-draw.php'; break;
			case 'login': $draw = 'login-draw.php'; break;
			case 'map': $draw = 'map-draw.php'; break;
			case 'project': $draw = 'project-draw.php'; break;
			case 'projects': $draw = 'projects-draw.php'; break;
			case 'demo': $draw = 'demo-draw.php'; break;
			default: $draw = 'index-draw.php';
		}
	}
	include($draw);
	?>
	</div>
</div>
</body>
</html>


