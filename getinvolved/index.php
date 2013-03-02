<?php
	require_once('../start_session.php');
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
	<li><a href="students.php">Students</a></li>
	<li><a href="teachers.php">Teachers</a></li>
	<li><a href="ngos.php">NGOs</a></li>
	<li><a href="developers.php">Developers</a></li>
      </ul>
      </p>
    </div>
</div>
</body>
</html>