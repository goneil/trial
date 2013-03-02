<h2>Upload data points</h2>
<p>You can upload data point files here. Please follow the format of our <a href="http://dl.dropbox.com/u/7615/datapoints.dat">example</a> data file. Each row should contain longitude, latitude, value, and alpha.</p><br />
<?php
	if (!isset($_POST['upload'])) { ?>
		<form enctype="multipart/form-data" method="POST"> 
	<?php if (!loggedIn()) { ?>
		Username <input name="user" /><br />
		Password <input name="pass" /><br />
	<?php } 
	if(isset($request[1])) {
		if($request[1] == 'error' && isset($request[2])) {
			$showWarning = true;
		} else {
			$map = new Map($request[1]);
			echo 'Upload to <b>'.$map->getName().'</b> Map<br />';
		}
	} else {
		echo '<b>No Map Selected</b>';
	}
	?>
	<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
	<input type="hidden" name="map" value="<?php echo $request[1];?>" />
	<?php
		if($showWarning) {
			echo '<b>You have attempted to upload beyond the 250 data points limit.</b><br>';
			echo 'Your data file currently has <i>'.$request[2].'</i> data points. Please consider revising.<br><br>';
		}
	?>
	Choose a file to upload: <input name="file" type="file" /><br />
	<br />
	<input type="submit" value="Upload" name="upload" />
	</form>
<?php } ?>