<?php
//prints the javascript needed to work the map
//options to be implemented
//options to include project, date range, from certain users
//does not include the map div
function printMapScript($map,$options = array()) { 
	$width = 550;
	$height = 400;
	if (!$map instanceof Map) $map = new Map($map);
	$points = $map->getPoints();
	//then to pass through Options filters
	if (isset($options['height'])) $height = $options['height'];
	if (isset($options['width'])) $width = $options['width'];
	if (isset($options['maps']) && $options['maps']) {
		if (is_array($options['maps'])) {
			foreach ($options['maps'] as $mapID) {
				$temp_map = new Map($mapId);
				foreach ($temp_map->getPoints() as $p) {
					array_push($points, $p);
				}
			}
		} else {
			$temp_map = new Map($options['maps']);
			foreach ($temp_map->getPoints() as $p) {
				array_push($points, $p);
			}
		}
	}
	if (isset($options['users'])) {
		if (is_array($options['users'])) {
			$pts = array();
			foreach ($options['users'] as $user) {
				foreach ($points as $point) {
					if ($point->getUser() == $user) {
						array_push($pts, $point);
					}
				}
			}
			$points = $pts;
		} else {
			$pts = array();
			foreach ($points as $point) {
				if ($point->getUser() == $options['users']) {
					array_push($pts, $point);
				}
			}
			$points = $pts;
		}
	}
	if (isset($options['start'])) {
		//$start = new DateTime($options['start']);
		//function timestart($var){return $start < $var;}
		//$point = array_filter($points, 'timestart');
		//$start = new DateTime($options['start']);
		$pts = array();
		foreach ($points as $point) {
			//var_dump($end . ' ' . $point->getTime());
			var_dump(strtotime($options['start'])  .' '. $point->getTime());
			if (strtotime($options['start'])  < $point->getTime()) {
				array_push($pts, $point);
			}
		}
		$points = $pts;
	}
	if (isset($options['end'])) {
		//$end = new DateTime($options['end']);
		$pts = array();
		foreach ($points as $point) {
			//var_dump($end . ' ' . $point->getTime());
			if (strtotime($options['end']) > $point->getTime()) {
				array_push($pts, $point);
			}
		}
		$points = $pts;
	}
	if (isset($options['demo'])) {
		$points = $_SESSION['points'];
	}
	
	
	if (isset($points[0])) {
		$minLat = $points[0]->getLat();
		$maxLat = $points[0]->getLat();
		$minLng = $points[0]->getLng();
		$maxLng = $points[0]->getLng();
		$min = $points[0]->getValue();
		$max = $points[0]->getValue();
		foreach ($points as $point) {
			if ($point->getLat() < $minLat) $minLat = $point->getLat();
			if ($point->getLat() > $maxLat) $maxLat = $point->getLat();
			if ($point->getLng() < $minLng) $minLng = $point->getLng();
			if ($point->getLng() > $maxLng) $maxLng = $point->getLng();
			if ($point->getValue() < $min) $min = $point->getValue();
			if ($point->getValue() > $max) $max = $point->getValue();
		}
	} else {
		$minLat = $minLng = $maxLat = $maxLng = $max = $min = 0;
	}
	
	//uhh, different api keys per host
	switch ($_SERVER['HTTP_HOST']) {
		case 'ecomaplive.com': case 'www.ecomaplive.com':
			echo '<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAA5n2t78oxb_-eRFDjPSn8ARRLXWBrQmFTAU2DsiFqArp7zTGUmRQht9dFGDHkLb_EYeooYdgkB7qo7A" type="text/javascript"></script>' . "\n";
			break;
		case 'localhost': case 'localhost:8080':
			echo '<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAA5n2t78oxb_-eRFDjPSn8ART2yXp_ZAY8_ufC3CFXhHIE1NvwkxQDPIiQQLyyTPpXdtPYkVcuORV1jg" type="text/javascript"></script>' . "\n";
			break;
		case 'jchiu.no-ip.org':
			echo '<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAA5n2t78oxb_-eRFDjPSn8ART7CEX8X51e8wWa1QjNIyfbtUMqWRS3SXhtqwouROb1LhXQrdDMT-HRDw" type="text/javascript"></script>' . "\n";
			break;
}
	?>
	<script type='text/javascript' src='http://<?php echo $_SERVER['HTTP_HOST']; ?>/images/circles.js'></script>
	<!--<script type='text/javascript' src='http://www.bdcc.co.uk/Gmaps/BDCCCircle.js'></script>-->
	<script type="text/javascript">
	var locations = [<?php
		foreach ($points as $point) echo $point,",";
	?>]
	var map;
	
	<?php /*
	function drawCircle(map, center, numPoints, radius, value) {
        poly = []; 
        var lat = center.lat();
        var lng = center.lng();
        var d2r = Math.PI/180;                // degrees to radians
        var r2d = 180/Math.PI;                // radians to degrees
        var Clat = (radius/3963/1600) * r2d;      //  using 3963 as earth's radius
        var Clng = Clat/Math.cos(lat*d2r);
        
        //Add each point in the circle
        for (var i = 0 ; i < numPoints ; i++) {
            var theta = Math.PI * (i / (numPoints / 2));
            Cx = lng + (Clng * Math.cos(theta));
            Cy = lat + (Clat * Math.sin(theta));
            poly.push(new GLatLng(Cy,Cx));
        }

        
        //Add the first point to complete the circle
        poly.push(poly[0]);

        //Create a new circle
		// Using GPolygon(points,  strokeColor?,  strokeWeight?,  strokeOpacity?,  fillColor?,  fillOpacity?)
        circle = new GPolygon(poly,'#FF0000', 1, 0, '#FF0000', value);
        
        map.addOverlay(circle);
    }*/ ?>
	
	function d2h(d) {
		hex = d.toString(16);
		if (d < 10) hex = "0" + hex;
		return hex;
	}
	
	function initialize() {
		//Creates the map
		map = new GMap2(document.getElementById("map"),{mapTypes:[G_NORMAL_MAP,G_HYBRID_MAP, G_SATELLITE_MAP, G_PHYSICAL_MAP]});
		//Finds the zoom level to show all points
		<?php
		if ($minLat==0 || $minLng==0 || $maxLat==0 || $maxLng==0)
			echo 'var bounds = new GLatLngBounds(new GLatLng(42.358016,-71.093291), new GLatLng(42.362646,-71.086961));';
		else
			echo 'var bounds = new GLatLngBounds(new GLatLng('.$minLat.','.$minLng.'), new GLatLng('.$maxLat.','.$maxLng.'));';
		?>
		var zoom = map.getBoundsZoomLevel(bounds)-1;
		//Repositions to center of all points
		map.setCenter(bounds.getCenter(), zoom);
		map.enableContinuousZoom();
		map.enableScrollWheelZoom();
		//add gui stuff
		map.addControl(new GLargeMapControl());
		map.addControl(new GMapTypeControl());
		map.addControl(new GScaleControl());
		
		var max = <?php echo $max; ?>;
		//var min = <?php echo $min; ?>;
		var min = 0;
		var colors = "";
		//plot all the points
		for (i = 0;i < locations.length; i++) {
			//drawCircle(map, new GLatLng(locations[i][0],locations[i][1]), 360, locations[i][2], locations[i][3]);
			var value = parseInt((locations[i][3])/((max+1))*255);
			var color = "#" + d2h(value) + "00" + d2h(255-value);
			colors = colors + " " + color;
			map.addOverlay(new BDCCCircle(new GLatLng(locations[i][0],locations[i][1]), locations[i][2]/1600,color,0.00000001,0.0000001,true,color,new Array(0.001,value)));
		}
		//document.write(colors);
	}
	window.onload = initialize;
	</script>
	<div id="map" style="z-index: 0; width: <?php echo $width;?>px; height: <?php echo $height;?>px;"></div>
<?php 
}

function getProjectList() {
	//Gets all projects by id
	$database = new Database();
	$query = "SELECT `id` FROM `project`";
	$results = $database->query($query);
	$projID = array();
	
	while ($result = $results->fetch_array()) {
		array_push($projID, $result['id']);
	}
	return $projID;
}

function getAllProjects() {
	$ids = getProjectList();
	$projects = array();
	foreach ($ids as $id) {
		array_push($projects, $id);
	}
	return $projects;
}

function getOpenProjectList() {
	//Gets all projects by id
	$database = new Database();
	$query = "SELECT `id` FROM `project` AS a WHERE a.private=0";
	$results = $database->query($query);
	$projID = array();
	
	while ($result = $results->fetch_array()) {
		array_push($projID, $result['id']);
	}
	return $projID;
}

function getOpenProjects() {
	$ids = getOpenProjectList();
	$projects = array();
	foreach ($ids as $id) {
		array_push($projects, $id);
	}
	return $projects;
}

function deleteProject($pid) {
	$database = new Database();
	$query = "DELETE FROM `project` WHERE id=".$pid;
	$results = $database->query($query);
	$query = "DELETE FROM `projusers` WHERE project=".$pid;
	$results = $database->query($query);
}

function setPrivate($pid) {
	$database = new Database();
	$query = "UPDATE `project` SET private=1 WHERE id=".$pid;
	$results = $database->query($query);
}

function setPublic($pid) {
	$database = new Database();
	$query = "UPDATE `project` SET private=0 WHERE id=".$pid;
	$results = $database->query($query);
}

function getUserProjects($uid) {
	$ids = getUserProjectList($uid);
	$projects = array();
	foreach ($ids as $id) {
		array_push($projects, $id);
	}
	return $projects;
}

function getUserProjectList($uid) {
	//Gets all projects by id
	$database = new Database();
	$query = "SELECT a.id FROM `project` AS a INNER JOIN `projusers` AS b ON a.id = b.project WHERE b.user = ".$uid;
	$results = $database->query($query);
	$projID = array();
	
	while ($result = $results->fetch_array()) {
		array_push($projID, $result['id']);
	}
	return $projID;
}

function loggedIn() {
	return $_SESSION['user']->isLoggedIn();
}

function array_remove_empty($arr){
    $narr = array();
    while(list($key, $val) = each($arr)){
        if (is_array($val)){
            $val = array_remove_empty($val);
            // does the result array contain anything?
            if (count($val)!=0){
                // yes :-)
                $narr[$key] = $val;
            }
        }
        else {
            if (trim($val) != ""){
                $narr[$key] = $val;
            }
        }
    }
    unset($arr);
    return $narr;
}

function filterQuotes($str) {
	if (stripos($str,"'") !== false || stripos($str,'"') !== false) {
		die('Quotes are not allowed');
	}
	return $str;
}
?>