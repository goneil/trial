<h2>Demo map</h2>
<p style="margin: 0px 0px 15px 0px;">On this page, you can enter a short list of data points and create a map. To access more advanced mapping functions and upload larger data sets, please <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/login/">login</a> or <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/register/">create an account</a>.</p>
<div style="padding: 0px 0px 25px 10px;">
<?php
printMapScript(0,array('demo'=>true, 'width'=>500));
?>
<form method="post">
	Latitude: <input name='lat[]' /> Longitude: <input name='lng[]' /><br />
	Radius: <input name='radius[]' /> Value: <input name='value[]' /><br /><br />
	Latitude: <input name='lat[]' /> Longitude: <input name='lng[]' /><br />
	Radius: <input name='radius[]' /> Value: <input name='value[]' /><br /><br />
	Latitude: <input name='lat[]' /> Longitude: <input name='lng[]' /><br />
	Radius: <input name='radius[]' /> Value: <input name='value[]' /><br /><br />
	<input name='demo' value="Add points" type="submit" />
	<input name='delete' value="Delete all points" type="submit"/>
</form>
</div>