<?php
	require_once('../start_session.php');
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo $_SERVER['SERVER_HOST'];?>/images/ecostyle.css" />
</head>
<body>
<div class="all">
    <div class="banner" id="banner1"><img src="<?php echo $_SERVER['SERVER_HOST'];?>/images/grassbanner1.jpg"></img></div>
    <?php include ("../mainmenu.php"); ?>
    <div class="content">
      <p>
      <ul>
	<li><a href="team.php">Our Team</a></li>
	<li><a href="vision.php">Vision</a></li>
	<li><a href="contact.php">Contact</a></li>
      </ul>
      </p>
    </div>
</div>
</body>
</html>