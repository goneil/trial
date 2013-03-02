<img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/images/projectsphotos.jpg" align="middle" width="500"><br/><br/>  
<h2>The following is the list of open projects</h2>
<?php
	$projs = getOpenProjects();
	echo '<ul>';
	foreach ($projs as $proj) {
		$p = new Project($proj);
		echo '<li> - <a href="http://',$_SERVER['HTTP_HOST'],'/project/',$p->getID(),'">',$p->getName(),'</a> ',$p->getBlurb(),'</li>',"\n";
	}
	echo '</ul>';
?>