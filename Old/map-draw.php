<?php
if (!isset($request[2])) { ?>
Please type the maps numbers you would like to see.  You can put multiple, separated by spaces.  You can also filter by users.  Leave fields blank if unnecessary. <br />
<form method="post">
Maps: <input name="maps" /><br />
User: <input name="users" /><br />
Start date: <input name="start" /><br />
End date: <input name="end" /><br />
<input type="submit" name="filters" /><br />
</form>
<?php } 
printMapScript($map,$options);

if (loggedIn() && $proj->isUser($_SESSION['user'])) {
	//admin stuffs
	//aka insert new points?>
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
<?php } ?>