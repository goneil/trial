<?php
if (!isset($request[1])) { 
?>
<div>
	<h2>Maps</h2>
	Please type the maps numbers you would like to see.  You can put multiple, separated by spaces.  You can also filter by users.  Leave fields blank if unnecessary. <br />
	<br />
	<form method="post" style="z-index: 1;">
		Maps: <input name="maps" /><br />
		User: <input name="users" /><br />
		Start date: <input name="start" /><br />
		End date: <input name="end" /><br />
		<br />
		<input type="submit" value="Submit" name="filters" /><br />
	</form>
</div>
<?php 
} else {
	echo '<h2>'.$map->getName().' Map</h2>';
}
printMapScript($map,$options);
echo '<div style="margin: 15px auto;"><br></div>';
if (isset($request[2])) {
	if (loggedIn() && $proj->isUser($_SESSION['user'])) {
		//admin stuffs
		//aka insert new points ?>
		<form method="post">
			Latitude: <input name='lat[]' /> Longitude: <input name='lng[]' /> Radius: <input name='radius[]' /> Value: <input name='value[]' /><br />
			Latitude: <input name='lat[]' /> Longitude: <input name='lng[]' /> Radius: <input name='radius[]' /> Value: <input name='value[]' /><br />
			Latitude: <input name='lat[]' /> Longitude: <input name='lng[]' /> Radius: <input name='radius[]' /> Value: <input name='value[]' /><br />
			Latitude: <input name='lat[]' /> Longitude: <input name='lng[]' /> Radius: <input name='radius[]' /> Value: <input name='value[]' /><br />
			Latitude: <input name='lat[]' /> Longitude: <input name='lng[]' /> Radius: <input name='radius[]' /> Value: <input name='value[]' /><br />
			Latitude: <input name='lat[]' /> Longitude: <input name='lng[]' /> Radius: <input name='radius[]' /> Value: <input name='value[]' /><br />
			Latitude: <input name='lat[]' /> Longitude: <input name='lng[]' /> Radius: <input name='radius[]' /> Value: <input name='value[]' /><br />
			Latitude: <input name='lat[]' /> Longitude: <input name='lng[]' /> Radius: <input name='radius[]' /> Value: <input name='value[]' /><br />
			Latitude: <input name='lat[]' /> Longitude: <input name='lng[]' /> Radius: <input name='radius[]' /> Value: <input name='value[]' /><br />
			Latitude: <input name='lat[]' /> Longitude: <input name='lng[]' /> Radius: <input name='radius[]' /> Value: <input name='value[]' /><br />
			<input name='insert' type="submit" />
		</form>
<?php }
} ?>