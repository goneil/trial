<?php
class Point {
	private $lat;
	private $lng;
	private $map;
	private $uid;
	private $range;
	private $value;
	private $time;
	
	function __construct($lat, $lng, $map, $uid, $range, $value, $time = "") {
		$this->lat = $lat;
		$this->lng = $lng;
		$this->map = $map;
		$this->uid = $uid;
		$this->range = $range;
		$this->value = $value;
		//$time = new DateTime($time);
		//$this->time = $time->format("Y-m-d H:i:s");
		$this->time = strtotime($time);
		if (!$this->time) {
			$this->time = time();
		}
	}
	
	function getJSCoords() {
		return "[$this->lat,$this->lng,$this->range,$this->value,$this->uid,$this->time]";
	}
	
	function getLat() {
		return $this->lat;
	}
	
	function getLng() {
		return $this->lng;
	}
	
	function __toString() {
		return $this->getJSCoords();
	}
	
	function getUser() {	
		return $this->uid;
	}
	
	function getMap() {
		return $this->map;
	}
	
	function getRange() {
		return $this->range;
	}
	
	function getValue() {
		return $this->value;
	}
	
	function getTime() {
		return $this->time;
	}
}
?>
