<html>
<!--
	filename: fullsizeVideo.php
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
$filename=$_GET['filename'];
$fileloc = $filetogo . "/" . $filename; 

//NOTE: other "fullsizeXXX.php" files dont concat filetogo and fileloc, rather they assume fileloc contains the full path when called

//echo "fileloc+filename" . $fileloc . $filename;
echo "<form name='fullimage' action='' method='get'>";
echo "<table name='table_fullsize' border='0' cellpadding='1' cellspacing='0' width='100%'>";
echo "<td width='95%' align='center'><h4>" . $filename . "</h4>";
//echo "<td width='5%' align='right'><button style='width:55;height:55;background-image:url(Resources/close_button.png); background-position:center; background-repeat:no-repeat;'type='submit' name='goto' value='close'></button><br>";
echo "</form></tr></table>";
echo "<hr><video height='500' width='1000' controls='controls'>";
echo "<source src='" . $fileloc . "' type='video/mp4' />";
echo "<source src='" . $fileloc . "' type='video/ogg' />";
echo "<source src='" . $fileloc . "' type='video/webm' />";
echo "</video>";
?>
</body>
</html>

