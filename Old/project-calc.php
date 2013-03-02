<?php
if (isset($request[1])) {
	$project = new Project($request[1]);
	if (isset($request[2]) && $request[2] == 'admin') {
		//plethora of admin options
		if (isset($request[3]) && $request[3] == 'add') {
			if (isset($_POST['newMap'])) {
				$map = new Map();
				filterQuotes($_POST['name']);
				filterQuotes($_POST['private']);
				$map->createNew($project->getID(),$_POST['name'],$_POST['private']);
				$project->addMap($map);
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
	}
}
?>