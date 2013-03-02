<?php
	require_once('../start_session.php');
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo $_SERVER['SERVER_HOST'];?>/images/ecostyle.css" />
</head>
<body>
<div class="all">
    <div class="banner" id="banner5"><img src="<?php echo $_SERVER['SERVER_HOST'];?>/resources/bannerresources.jpg"></img></div>
    <?php include ("../mainmenu.php"); ?>
    <div class="content">
      <p>
      <ul>
      <li><a href="http://code.google.com/apis/maps/">Google Maps API</a>: Learn how to make your own map applications.</li>
      <li><a href="http://www.epa.gov/">Environmental Protection Agency</a>: Find out more about environmental issues.</li>
      <li><a href="http://media.mit.edu/">MIT Media Lab</a></li>
      <li><a href="http://urbanecomap.org">Urban Ecomap</a></li>
      <li><a href="http://research.cens.ucla.edu/">Center for Embedded Networked Sensing at UCLA</a></li>
      </ul>
      </p>
    </div>
</div>
</body>
</html>