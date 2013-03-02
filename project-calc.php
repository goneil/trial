<?php
if (isset($request[1])) {
	$project = new Project($request[1]);
	if (isset($request[2]) && $request[2] == 'admin') {
		//plethora of admin options
		if (isset($request[3]) && $request[3] == 'add') {
			if (isset($_POST['newMap'])) {
				$map = new Map();
				filterQuotes($_POST['name']);
				$private = $_POST['group1'];
				if ($private == 'private') {
					$private = true;
				} else {
					$private = false;
				}
				$map->createNew($project->getID(),$_POST['name'],$private);
				$project->addMap($map);
			}
		}
		if (isset($request[3]) && $request[3] == 'delete') {
			if (loggedIn() && $project->isAdmin($userInfo['uid'])) {
				deleteProject($project->getID());
				header('Location: http://'.$_SERVER['HTTP_HOST'].'/project') ;
			} else {
				echo 'Not logged-in or user is not an admin of project';
			}
		}
		if (isset($request[3]) && $request[3] == 'setPublic') {
			if (loggedIn() && $project->isAdmin($userInfo['uid'])) {
				setPublic($project->getID());
				header('Location: http://'.$_SERVER['HTTP_HOST'].'/project') ;
			} else {
				echo 'Not logged-in or user is not an admin of project';
			}
		}
		if (isset($request[3]) && $request[3] == 'setPrivate') {
			if (loggedIn() && $project->isAdmin($userInfo['uid'])) {
				setPrivate($project->getID());
				header('Location: http://'.$_SERVER['HTTP_HOST'].'/project') ;
			} else {
				echo 'Not logged-in or user is not an admin of project';
			}
		}
		if (isset($request[3]) && $request[3] == 'users') {
			if (isset($request[4]) && isset($_POST['user'])) {
				if (!isset($_POST['member'])) {
					$d = new Database();
					$query = 'DELETE FROM `projusers` WHERE `project` = "' . $project->getId() . '" AND `user` = "' . $request[4] . '"';
					$d->query($query);
				} else {
					if (!$project->isUser(new User($request[4]))) {
						$project->addUser($request[4]);
					}
					if (isset($_POST['admin'])) {
						$d = new Database();
						$pid = $project->getId();
						$uid = $request[4];
						$query = "UPDATE `projusers` SET `isAdmin` = '1' WHERE `project` =$pid AND `user` =$uid";
						$d->query($query);
					} else {
						$d = new Database();
						$pid = $project->getId();
						$uid = $request[4];
						$query = "UPDATE `projusers` SET `isAdmin` = '0' WHERE `project` =$pid AND `user` =$uid";
						$d->query($query);
					}
				}
			}
		}
		if (isset($request[3]) && $request[3] == 'edit') {
			if (isset($_POST['edit'])) {
				$name = filterQuotes($_POST['name']);
				$desc = filterQuotes($_POST['description']);
				$blurb = filterQuotes($_POST['blurb']);
				$project->edit($name, $desc, $blurb);
			}
		}
	} else if ($request[1] == 'add') {
		if (isset($_POST['add'])) {
			$name = $_POST['name'];
			$desc = $_POST['desc'];
			$blurb = $_POST['blurb'];
			$private = $_POST['group1'];
			if ($private == 'private') {
				$private = '1';
			} else {
				$private = '0';
			}
			$project->createNew(array('name'=>$name, 'description'=>$desc, 'blurb'=>$blurb, 'admin'=>$userInfo['uid'], 'private'=>$private));
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/project') ;
		}
	}
}
?>