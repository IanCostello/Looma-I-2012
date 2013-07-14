<html>
<!--
	filename: externalVideo.php
	author: peter and ankit
	modified: skip 2013 01 13
	copyright: VillageTech Solutions, 2013
-->

<head>
<style type="text/css">
<!--
body,td,th {
	font-family: Comic Sans MS;
	color: #FCC110;
	font-size: 24px;
}
body {
	background-color: #091F48;
}
-->
</style>
</head>
<body>
<tr>
<?php
$filetogo=$_GET['fileloc'];
chdir($filetogo);
$filename=$_GET['filename'];
$fileloc = $filetogo . "\\" . $filename;
//echo $fileloc;
echo "<form name='fullimage' action='http://localhost/Front_End/external.php' method='get'>";
echo "<table name='table_fullsize' border='0' cellpadding='1' cellspacing='0' width='100%'>";
echo "<td width='95%' align='center'><h4>" . $filename . "</h4><br>";
echo "<td width='5%' align='right'><button style='width:55;height:55;background-image:url(Resources/close_button.png); background-position:center; background-repeat:no-repeat;'type='submit' name='pd' value='" . $filetogo . "'></button><br>";
echo "</form></tr></table><hr>";
/*
echo "<video height='480' width='640' controls='controls' autoplay='autoplay'>";
echo "<source src='" . $fileloc . "' type='video/mp4' />";
echo "<source src='" . $fileloc . "' type='video/ogg' />";
echo "<source src='" . $fileloc . "' type='video/webm' />";
echo "</video>";
*/
echo "You can not view a video from USB....<br>";
echo "To view this Video you have to move it to Looma.";
?>
</body>
</html>

