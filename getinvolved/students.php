<?php
	require_once('../start_session.php');
    ini_set('display_errors', 'Off');


?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo $_SERVER['SERVER_HOST'];?>/images/ecostyle.css" />
</head>
<body>
<div class="all">
    <div class="banner" id="banner4"><img src="<?php echo $_SERVER['SERVER_HOST'];?>/getinvolved/bannergetinvolved.jpg"></img></div>
    <?php include ("../mainmenu.php"); ?>
    <div class="content">
      <p>
      <ul>
	<li>Start a project at your school</li>
	<li>How to build your sensor</li>
	<li>Upload your data!</li>
      <ul>
      </p>
    </div>
</div>
</body>
</html>
