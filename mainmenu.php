<?php require_once('functions.inc.php'); ?>
<div id="menu" style="z-index: 10;">
    <ul id="mainmenu">
    <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/home">Home</a>
	
	<?php
		if (loggedIn()) {
			echo '<li><a href="http://'.$_SERVER['HTTP_HOST'].'/project">My Projects</a>';
			echo '</li>';
			echo '<li><a href="http://'.$_SERVER['HTTP_HOST'].'/map">Create Map</a>';
			echo '</li>';
		} else {
			echo '<li><a href="http://'.$_SERVER['HTTP_HOST'].'/login">Login</a>';
			echo '</li>';
			echo '<li><a href="http://'.$_SERVER['HTTP_HOST'].'/demo">Create Map</a>';
			echo '</li>';
		}
	?>
    <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/about">About</a>
        <ul class="submenu">
			<li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/about/team.php">Our Team</a></li>
			<li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/about/vision.php">Vision</a></li>
            <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/about/contact.php">Contact</a></li>
        </ul>
	</li>
    <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/tech">Technology</a>
        <ul class="submenu">
			<li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/tech/intro.php">Intro</a></li>
			<li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/tech/mobile.php">Mobile</a></li>
            <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/tech/server.php">Server</a></li>
            <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/tech/sensors.php">Sensors</a></li>
        </ul>
	</li>
    <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/projects">Open Projects</a></li>
    <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/getinvolved">Get Involved</a>
        <ul class= "submenu">
			<li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/getinvolved/students.php">Students</a></li>
			<li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/getinvolved/teachers.php">Teachers</a></li>
			<li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/getinvolved/ngos.php">NGOs</a></li>
			<li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/getinvolved/developers.php">Developers</a></li>
		</ul>
	</li>
	<li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/resources">Resources</a></li>
	<li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/sponsors">Sponsors</a></li>
    </ul>
</div>