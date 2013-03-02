<?php
class User {
	private $user;
	private $isLoggedIn = 0;
	private static $database;
	
	function __construct($username = "", $password = "") {
		$isLoggedIn = 0;
		$user = array();
		$this->database = new Database();
		if (!empty($password)) {
			$this->login($username, $password);
		} elseif (!empty($username)) {
			//To create user objects without needing user to login, to do admin stuff....
			//Takes in UID of user, is unique
			$query = "SELECT * FROM `users` WHERE `uid` = '$username'";
			$user = $this->database->query($query)->fetch_array();
			$this->user = $user;
		}
	}
	
	function createUser($username, $password, $name, $email) {
		//if user exists, return false
		$query = "SELECT * FROM `users` WHERE `username` = '$username'";
		$user = $this->database->query($query)->fetch_array();
		if (!empty($user))
			return false;
			
		//insert user
		$query = "INSERT INTO `users` VALUES('$username', '" . md5($password) . "', '$name', '$email', '".md5(microtime())."','')";
		if (!$this->database->query($query)) {
			return false;
		}
		if (isset($this->database->error)) {
			echo $this->database->error;
		}
		$this->login($username, $password);
		return true;
	}
	
	function login($username, $password) {
		//check username and password and generate new hash
		//parse uname and pass for things

		
		$query = "SELECT * FROM `users` WHERE `username` = '$username'";
		$user = $this->database->query($query);
		$user = $user->fetch_array();
		if (empty($user)) 
			return false;
		$this->user = $user;
		//check password
		if (md5($password) != $this->user['password']) {
			$this->logout();
			return false;
		}
		//generate hash from microtime
		$hash = md5(microtime());
		$id = $this->user['uid'];
		$query = "UPDATE `user` SET `hash` = '$hash' WHERE `uid` = '$id'";
		$this->database->query($query);
		$this->isLoggedIn = true;
		return true;
	}
	
	function changePassword($oldPass, $newPass) {
		if (!$this->isLoggedIn()) {
			return false;
		}
		//Check the old password
		if (md5($oldPass) != $this->user['password']) {
			return false;
		}
		//Set the new password
		$newPass = md5($newPass);
		$id = $this->user['uid'];
		$query = "UPDATE `users` SET `password` = '$newPass' WHERE `uid` = '$id'";
		$this->database->query($query);
		return true;
	}
	
	function isLoggedIn() {
		if ($this->isLoggedIn) {
			return true;
		}
		if (!isset($this->user['hash'])) {
			$this->isLoggedIn = 0;
			return false;
		}
		//Checks the hash
		$query = "SELECT `hash` FROM `users` WHERE `id` = '$this->user['id']'";
		$hash = $this->database->query($query);
		$hash = $hash['hash'];
		if ($hash == $this->user['hash']) 
			$this->isLoggedIn = true;
		else 
			$this->isLoggedIn = 0;
		return $this->isLoggedIn;
	}
	
	function logout() {
		$this->isLoggedIn = false;
		$this->user = array();
	}
	
	function getInfo() {
		return $this->user;
	}
	
	function getID() {
		return $this->user['uid'];
	}
	
	function getName() {
		if (isset($this->user['name'])) {
			return $this->user['name'];
		} else {
			return '';
		}
	}
	
	function getEmail() {
		if (isset($this->user['email'])) {
			return $this->user['email'];
		} else {
			return '';
		}
	}
	
	function __sleep() {
		return array('user', 'isLoggedIn', 'database');
	} 
	
	function __wakeup() {
		$this->isLoggedIn();
	}
}
?>