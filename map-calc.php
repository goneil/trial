<?php
if (isset($request[1])) {
	$map = new Map($request[1]);
	$options = array();
	$options['width'] = 525;
	$options['height'] = 400;
	if (isset($_POST['filters'])) {
		if (!empty($_POST['start'])) {
			$options['start'] = $_POST['start'];
		}
		if (!empty($_POST['end'])) {
			$options['end'] = $_POST['end'];
		}
		if (!empty($_POST['users'])) {
			$options['users'] = $_POST['users'];
		}
		if (!empty($_POST['maps'])) {
			$options['maps'] = $_POST['maps'];
		}
	}
	$proj = new Project($map->getProject());
	if (loggedIn() && $proj->isUser($_SESSION['user'])) {
		//insert new points
		if (isset($_POST['insert'])) {
			//it usually has empty values from the form if nothing is entered, this presents a problem, so i removed
			//the ones that don't have any values, if you get what i'm saying...
			function process($list) {
				$temp = array();
				for ($i = 0; $i < count($list);$i++) {
					if (!empty($list[$i])) {
						filterQuotes($list[$i]);
						array_push($temp, (double)$list[$i]);
					}
				}
				return $temp;
			}
			
			$lat = process($_POST['lat']);
			$lng = process($_POST['lng']);
			$radius = process($_POST['radius']);
			$value = process($_POST['value']);
			//stick all the stuff into databases
			for ($i = 0; $i < count($lat); $i++) {
				if ($value[$i] > 1) $value[$i] = 1;
				if ($value[$i] < 0) $value[$i] = 0;
				//$query = "INSERT INTO `data` VALUES ('0','$lat[$i]','$lng[$i]','$radius[$i]','$value[$i]',NOW())";
				//echo $query;
				//if (!mysql_query($query)) die('Invalid query: ' . mysql_error());
				$point = new Point($lat[$i], $lng[$i], $map->getID(), $userInfo['uid'], $radius[$i], $value[$i]);
				$map->addPoint($point);
			}
		}
	}
	if (loggedIn() && $proj->isAdmin($_SESSION['user'])) {
		if (isset($request[2]) && $request[2] == 'admin') {
			if (isset($request[3]) && $request[3] == 'edit') {
				if (isset($_POST['edit'])) {
				}
			}
		}
	}
} else { 
	$map = new Map();
	$options = array();
	
	?>
	
<?php } ?>