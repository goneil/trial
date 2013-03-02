<?php
if (isset($request[1])) {
	$project = new Project($request[1]);
	
	echo 'Name:',$project->getName(),'<br />';
	echo 'Description:',$project->getDescription(),'<br />';
	echo 'Blurb:',$project->getBlurb(),'<br />';
	if (loggedIn() && $project->isAdmin($userInfo['uid'])) {
		if (isset($request[2]) && $request[2] == 'admin') {
			if (isset($request[3]) && $request[3] == 'add') { ?>
				<form method="post">
				Name <input name='name' />
				Private <input type='checkbox' name='private' />
				<input type='submit' name='newMap' />
				</form>
				<?php	
			} else {
				echo '<a href="http://',$_SERVER['HTTP_HOST'],'/project/',$project->getId(),'/admin/add">Add New Map</a><br />';
			}
			if (isset($request[3]) && $request[3] == 'users') {
				if (!isset($request[4])) {
					echo 'Users: <br />';
					$users = $project->getUsers();
					foreach ($users as $user) {
						$u = new User($user);
						$info = $u->getInfo();
						echo '<a href="http://',$_SERVER['HTTP_HOST'],'/project/',$project->getId(),'/admin/users/',$u->getID(),'">',$info['name'],'</a><br />';
					}
				} else {
					$u = new User($request[4]);
					echo 'ID: ' . $u->getID() . '<br />';
					echo 'Name: ' . $u->getName() . '<br />';
					echo 'Email: ' . $u->getEmail() . '<br />';
					echo '<form method="post">';
					echo 'Is a member: <input type="checkbox" ';
					if ($project->isUser($u)) echo 'checked ';
					echo ' name="member" /><br />';
					echo 'Is an admin: <input type="checkbox" ';
					if ($project->isAdmin($u)) echo 'checked ';
					echo ' name="admin" /><br />';
					echo '<input type="submit" name="user" /></form>';
				}
			} else {
				echo '<a href="http://',$_SERVER['HTTP_HOST'],'/project/',$project->getId(),'/admin/users">Users</a><br />';
			}
			if (isset($request[3]) && $request[3] == 'edit') {
				echo '<form method="post">';
				echo 'Name <input name="name" value="',$project->getName(),'" /><br />';
				echo 'Description <input name="description" value="',$project->getDescription(),'" /><br />';
				echo 'Blurb <input name="blurb" value="',$project->getBlurb(),'" /><br />';
				echo '<input type="submit" name="edit" /></form>';
			} else {
				echo '<a href="http://',$_SERVER['HTTP_HOST'],'/project/',$project->getId(),'/admin/edit">Edit</a><br />';
			}
		} else {
			echo '<a href="http://',$_SERVER['HTTP_HOST'],'/project/',$project->getId(),'/admin">Admin Section</a>';
		}
	}
	echo 'Maps:<ul>';
	$maps = $project->getMaps();
	foreach ($maps as $map) {
		$m = new Map($map);
		echo '<li><a href="http://',$_SERVER['HTTP_HOST'],'/map/',$map,'">',$m->getName(),'</a></li>',"\n";
	}
	echo '</ul>';
} else {
	$projs = getAllProjects();
	echo '<ul>';
	foreach ($projs as $proj) {
		$p = new Project($proj);
		echo '<li><a href="http://',$_SERVER['HTTP_HOST'],'/project/',$p->getID(),'">',$p->getName(),'</a>',$p->getBlurb(),'</li>',"\n";
	}
	echo '</ul>';
	echo '<a href="http://',$_SERVER['HTTP_HOST'],'/project/add/">Add New Project</a>';
}
?>