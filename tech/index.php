<?php
	require_once('../start_session.php');
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo $_SERVER['SERVER_HOST'];?>/images/ecostyle.css" />
</head>
<body>
<div class="all">
    <div class="banner" id="banner2"><img src="<?php echo $_SERVER['SERVER_HOST'];?>/tech/bannertech.jpg"></img></div>
    <?php include ("../mainmenu.php"); ?>
    <div class="content">
      <p>
      <ul>
       <li><a href="/tech/intro.php">Intro</a></li>
       <li><a href="/tech/mobile.php">Mobile</a></li>
       <li><a href="/tech/server.php">Server</a></li>
       <li><a href="/tech/sensors.php">Sensors</a></li>
      </ul>
      </p>
    </div>
</div>
</body>
</html>