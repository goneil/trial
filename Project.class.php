<?php
class Project {
	private $id;
	private $name;
	private $description;
	private $scaleType;
	private $scaleFactor;
	private $color;
	private $users;
	private $admins;
	private $maps;
	private static $database;
	
	function __construct($id = 0) {
		$this->construct($id);
	}
	
	function construct($id = 0) {
		if ($id) {
			$query = "SELECT * FROM `project` WHERE `id` = '$id'";
		} else {
			$this->database = new Database;
			$this->id = 0;
			$this->name = "";
			$this->description = "";
			$this->blurb = "";
			$this->private = "";
			$id = $this->id;
			$this->maps = array();
			return;
		}
		$this->database = new Database;
		$proj = $this->database->query($query);
		$info = $proj->fetch_array();
		$this->id = $info['id'];
		$this->name = $info['name'];
		$this->description = $info['description'];
		$this->blurb = $info['blurb'];
		$this->private = $info['private'];
		$id = $this->id;
		$users = array();
		$admins = array();
		$query = "SELECT * FROM `projusers` WHERE `project` = '$id'";
		$userQuery = $this->database->query($query);
		while ($info = $userQuery->fetch_array()) {
			array_push($users, $info['user']);
			if ($info['isAdmin']) {
				array_push($admins, $info['user']);
			}
		}
		$this->users = $users;
		$this->admins = $admins;
		
		$maps = array();
		$query = "SELECT * FROM `projmaps` WHERE `project` = '$id'";
		$mapQuery = $this->database->query($query);
		while ($info = $mapQuery->fetch_array()) {
			array_push($maps,$info['map']);
		}
		$this->maps = $maps;
	}
	
	//requires all these variables set or else it breaks
	function createNew($variableOverload) {
		if (isset($variableOverload['name'])) {
			$name = $variableOverload['name'];
		}  else {
			$name = "Unnamed";
		}
		if (isset($variableOverload['description'])) {
			$description = $variableOverload['description'];
		} else {
			$description = "";
		}
		if (isset($variableOverload['blurb'])) {
			$blurb = $variableOverload['blurb'];
		} else {
			$blurb = "";
		}
		if (isset($variableOverload['admin'])) {
			$admin = $variableOverload['admin'];
		} else {
			$admin = $_SESSION['user']->getID();
		}
		if (isset($variableOverload['private'])) {
			$private = $variableOverload['private'];
		} else {
			$private = "1";
		}
		$query = "INSERT INTO `project` VALUES('', '$name', '$description', '$blurb', '$private')";
		$this->database->query($query);
		$id = $this->database->getConnection()->insert_id;
		$query = "INSERT INTO `projusers` VALUES('$id', '$admin', '1')";
		$this->database->query($query);
		$this->construct($id);
		return $id;
	}
	
	function getName() {
		return $this->name;
	}
	
	function getId() {
		return $this->id;
	}
	
	function getPrivate() {
		if ($this->private == 1)
			return 'Private';
		else
			return 'Public';
	}
	
	function isAdmin($id) {
		if ($id instanceof User) {
			$id = $id->getID();
		}
		foreach($this->admins as $admin) {
			if ($admin == $id)
				return true;
		}
		return false;
	}
	
	function getUsers() {
		return $this->users;
	}
	
	function addUser($uid) {
		$id = $this->id;
		$query = "INSERT INTO `projusers` VALUES('$id', '$uid', '0')";
		$this->database->query($query);
		array_push($this->users,$uid);
	}
	
	function getDescription() {
		return $this->description;
	}
	
	function getBlurb() {
		return $this->blurb;
	}

	function getMaps() {
		return $this->maps;
	}
	
	function isUser(User $user) {
		$uid = $user->getID();
		foreach ($this->users as $u) {
			if ($u == $uid) {
				return true;
			}
		}
		return false;
	}
	
	function addMap(Map $map) {
		array_push($this->maps,$map->getID());
		$id = $this->id;
		$map = $map->getID();
		$query = "INSERT INTO `projmaps` VALUES('$id','$map','0')";
		$this->database->query($query);
	}
	
	function edit($name, $desc, $blurb) {
		$this->name = $name;
		$this->description = $desc;
		$this->blurb = $blurb;
		$query = 'UPDATE `project` SET `name` = "' . $name . '", `description` = "' . $desc . '", `blurb` = "' . $blurb . '" WHERE `id` = "' . $this->id . '"';
		$this->database->query($query);
	}
}
?>