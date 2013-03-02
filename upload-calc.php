<?php 
if (isset($_POST['upload'])) {
	$max = 150;
	if (!loggedIn()) {
		filterQuotes($_POST['user']);
		filterQuotes($_POST['pass']);
		$user = new User($_POST['user'],$_POST['pass']);
	} else {
		$user = $_SESSION['user'];
	}
	filterQuotes($_POST['map']);
	$map = new Map($_POST['map']);
	$filename = $_FILES['file']['tmp_name'];
	$file = file($filename);
	for ($i = 0; $i < count($file); $i++) {
		$file[$i] = explode(' ',$file[$i]);
		if (count($file[$i]) != 6) {
			//throw error
		}
		$file[$i][4] .= ' ' . $file[$i][5];
	}
	if(count($file) > $max) {
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/upload/error/'.count($file));
	} else {
		foreach ($file as $line) {
			if ($line[3] > 1) $line[3] = 1;
			if ($line[3] < 0) $line[3] = 0;
			$point = new Point($line[0], $line[1], $map, $user->getId(), $line[2], $line[3], $line[4]);
			$map->addPoint($point);
		}
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/map/'.$_POST['map']) ;
		echo '<b>Points inserted into '.$map->getName().'</b>';
	}
}
if (isset($_POST['dl'])) {
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/datapoints.dat') ;
}
?>