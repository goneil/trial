<?php
if (!isset($_SESSION['points'])) $_SESSION['points'] = array();
if (isset($_POST['delete'])) {
	$_SESSION['points'] = array();
}
if (isset($_POST['demo'])) {
	//for documentation look in map-calc
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
	for ($i = 0; $i < count($lat); $i++) {
		if ($value[$i] > 1) $value[$i] = 1;
		if ($value[$i] < 0) $value[$i] = 0;
		$point = new Point($lat[$i], $lng[$i], 0, $userInfo['uid'], $radius[$i], $value[$i]);
		array_push($_SESSION['points'], $point);
	}
}
?>