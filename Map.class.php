<?php
class Map {
	private $points;
	private $name;
	private $isPrivate;
	private $id;
	private $project;
	private static $database;
	
	function __construct($id = 0) {
		$this->construct($id);
	}
	
	function construct($id) {
		$this->database = new Database();
		if ($id == 0) {
			$this->points = array();
			$this->name = "";
			$this->isPrivate = false;
			$this->id = 0;
			$this->project = 0;
			return;
		}
		$query = "SELECT * FROM `projmaps` WHERE `map` = '$id'";
		$info = $this->database->query($query)->fetch_array();
		if (!$info) { $this->construct(0); }
		$this->isPrivate = $info['private'];
		$this->id = $id;
		$this->name = $info['name'];
		$this->project = $info['project'];
		$query = "SELECT * FROM `data` WHERE `map` = '$id'";
		$data = $this->database->query($query);
		$points = array();
		while ($point = $data->fetch_array()) {
			array_push($points, new Point($point['lat'],$point['lng'],$point['map'],$point['uid'],$point['range'],$point['val'],$point['time']));
		}
		$this->points = $points;
	}
	
	function createNew($project, $name, $isPrivate) {
		$query = "INSERT INTO `projmaps` VALUES('$project', '', '$isPrivate', '$name')";
		$this->database->query($query);
		$id = $this->database->getConnection()->insert_id;
		$this->construct($id);
	}
	
	function addPoint(Point $point) {
		array_push($this->points, $point);
		$lat = $point->getLat();
		$lng = $point->getLng();
		$map = $this->getID();
		$uid = $point->getUser();
		$range = $point->getRange();
		$val = $point->getValue();
		$time = $point->getTime();
		$query = "INSERT INTO `data` VALUES('$lat', '$lng', '$map', '$uid', '$range', '$val', '$time')";
		$this->database->query($query);
	}
	
	function getPoints() {
		return $this->points;
	}
	
	function getID() {
		return $this->id;
	}
	
	function isPrivate() {
		return $this->isPrivate;
	}
	
	function getProject() {
		return $this->project;
	}
	
	function getName() {
		return $this->name;
	}
}
?>