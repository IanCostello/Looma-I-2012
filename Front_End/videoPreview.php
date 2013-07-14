<html>
<!--
	filename: videoPreview.php
	author: peter and ankit
	modified: 
	copyright: VillageTech Solutions, 2013
-->

<head>
<style type="text/css">
<!--
body,td,th {
	font-family: Comic Sans MS;
	color: #FCC110;
}
body {
	background-color: #091F48;
}
-->
</style>
</head>
<body>
<?php
$filetogo=$_GET['fileloc'];
$filename=$_GET['videodisplay'];
//echo $filetogo . "<br>";
//echo $filename;
if($filename!="" && $filetogo!="")
{
$fileloc = $filetogo . "/" . $filename;
//echo $fileloc;
echo "<video tag='preview' height='200' width='300' controls='controls'>";
echo "<source src='" . $fileloc . "' type='video/mp4' />";
echo "<source src='" . $fileloc . "' type='video/ogg' />";
echo "<source src='" . $fileloc . "' type='video/webm' />";
echo "no Support";
echo "</video><hr>";
//echo "<h4>" . $filename . "</h4><br>";
echo "<form name='fullsizeimage' action='http://localhost/Front_End/fullsizeVideo.php' target='_blank' method='get'>";
echo "<input type='hidden' name='fileloc' value='" . $filetogo ."'>";
echo "<input type='hidden' name='filename' value='" . $filename ."'>";
echo "<h4>Video-Name: " . $filename . "</h4>";
echo "<button type='submit' name='goto' value='' onClick='vdpause()'>Click to view full size Video</button>";
echo "</form>";
}
?>
</body>
</html>

