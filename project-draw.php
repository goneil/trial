<?php
if (isset($request[1])) {
	$project = new Project($request[1]);
	if ($request[1] == 'add') {
		echo '<h2>Add a project</h2>';
		echo '<form method="post">';
		echo 'Name: <input name="name" /><br />';
		echo 'Description: <input name="desc" /><br />';
		echo 'Blurb: <input name="blurb" /><br />';
		echo '<input type="radio" name="group1" value="private" CHECKED>Private ';
		echo '<input type="radio" name="group1" value="public">Public<br /><br />';
		echo '<input name="add" value="Submit" type="submit" />';
	} else {
		echo '<div class="projectContainer">';
		echo '<a class="projectLink" href="http://',$_SERVER['HTTP_HOST'],'/project/',$project->getID(),'">'.$project->getName().'</a><br>';
		echo '<p style="margin: 0px 10px 0px 20px;">';
		echo 'Description: ',$project->getDescription(),'<br />';
		echo 'Blurb: ',$project->getBlurb(),'<br />';
		echo 'This project is ',$project->getPrivate(),'<br />';
		if (loggedIn() && $project->isAdmin($userInfo['uid'])) {
			if (isset($request[2]) && $request[2] == 'admin') {
				if (isset($request[3]) && $request[3] == 'add') { ?>
					<form method="post">
					Name <input name='name' />
					<input type="radio" name="group1" value="private" CHECKED>Private 
					<input type="radio" name="group1" value="public">Public<br /> <br />
					<input type='submit' value="Submit" name='newMap' />
					</form><br />
					<?php	
				} else {
					echo '<h3>Administrative Functions</h3>';
					echo '> <a href="http://',$_SERVER['HTTP_HOST'],'/project/',$project->getId(),'/admin/add">Add New Map</a><br />';
					echo '> <a href="http://',$_SERVER['HTTP_HOST'],'/project/',$project->getId(),'/admin/delete">Delete Project</a><br />';
					if ($project->getPrivate() == 'Private')
						echo '> <a href="http://',$_SERVER['HTTP_HOST'],'/project/',$project->getId(),'/admin/setPublic">Set as Public</a><br />';
					else
						echo '> <a href="http://',$_SERVER['HTTP_HOST'],'/project/',$project->getId(),'/admin/setPrivate">Set as Private</a><br />';
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
						echo '<input type="submit" value="Submit" name="user" /></form>';
					}
				} else {
					echo '> <a href="http://',$_SERVER['HTTP_HOST'],'/project/',$project->getId(),'/admin/users">Users</a><br />';
				}
				if (isset($request[3]) && $request[3] == 'edit') {
					echo '<form method="post">';
					echo 'Name <input name="name" value="',$project->getName(),'" /><br />';
					echo 'Description <input name="description" value="',$project->getDescription(),'" /><br />';
					echo 'Blurb <input name="blurb" value="',$project->getBlurb(),'" /><br />';
					echo '<input type="submit" value="Submit" name="edit" /></form>';
				} else {
					echo '> <a href="http://',$_SERVER['HTTP_HOST'],'/project/',$project->getId(),'/admin/edit">Edit</a><br />';
				}
			} else {
				echo '<a href="http://',$_SERVER['HTTP_HOST'],'/project/',$project->getId(),'/admin">Admin Section</a><br /><br />';
			}
		}
		echo '</p>';
		echo '</div>';
		
		echo '<div class="projectContainer">';
		echo '<h4>',$project->getName(),' Maps</h4>';
		echo '<p style="margin: 0px 20px 20px 20px;">';
		$maps = $project->getMaps();
		foreach ($maps as $map) {
			$m = new Map($map);
			if ($m->isPrivate()) {
				if ($project->isUser(new User($userInfo['uid']))) 
					echo '[<span style="color: gray; margin: 0px auto;"> Upload Points </span>]<span style="margin: 0px 0px 0px 10px;"></span><a class="mapLink" href="http://',$_SERVER['HTTP_HOST'],'/map/',$map,'">',$m->getName(),'</a><br>';
			} else {
				echo '[ <a style="color: black;" class="Link" href="http://',$_SERVER['HTTP_HOST'],'/upload/',$map,'">Upload Points</a> ]<a style="margin: 0px 0px 0px 10px;" class="mapLink" href="http://',$_SERVER['HTTP_HOST'],'/map/',$map,'">',$m->getName(),'</a><br>';
			}
		}
		echo '</p>';
		echo '</div>';
	}
} else {
	echo '<div>';
	echo '<h2>Your EcoMap Projects</h2>';
	if (loggedIn()){
		$projs = getUserProjects($userInfo['uid']);
		foreach ($projs as $proj) {
			$p = new Project($proj);
			echo '<div class="projectContainer">';
				echo '<a class="projectLink" href="http://',$_SERVER['HTTP_HOST'],'/project/',$p->getID(),'">'.$p->getName().'</a><br>';
				echo '<p style="margin: 0px 10px 0px 10px;">';
				echo 'Blurb: '.$p->getBlurb().'<br>';
				echo 'Description: '.$p->getDescription();
				echo '</p>';
			echo '</div>';
		}
		echo '<h2>Add new Project</h2>';
		echo '<p style="margin: 0px 10px 15px 10px;"><a href="http://',$_SERVER['HTTP_HOST'],'/project/add/">Add project to your account</a></p>';
	} else {
		echo 'Register an account and create your own projects now!';
	}
	echo '</div>';
}
?>