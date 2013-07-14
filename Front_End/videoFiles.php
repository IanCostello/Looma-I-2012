<html>
<!--
	filename: videoFiles.php
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
$filetogo="Resources/Documents/Videos";
chdir("Resources/Documents/Videos");
$Location=getcwd();
$count=0;
$btn=0;
echo "<center><h2>Videos</h2></center>";
if ($handle = opendir($Location)) 
{
	echo "<form name='videoform' action='http://localhost/Front_End/videoPreview.php' target='videopreview' method='get'>";
	echo "<table name='table_videodisplay' cellspacing='1' cellpadding='1' border='0' width='100%'>";
    while (false !== ($entry = readdir($handle))) 
	{
		if /* ($entry != "." && $entry != "..") */
			(substr($entry, 0, 1) != "." && substr($entry,0,4) !="Icon")

		{
			if($btn==3)
			{
				echo "<tr>";
				$btn=0;
			}
			echo "<td width='33.33%'><button type='submit' style='width:100%;height:40;font: bold 15px Comic Sans MS' name='videodisplay' value='" . $entry . "'>" . $entry . "</button></td>";
			$count=1;
			$btn=$btn+1;
			if($btn==3)
			{
				echo "</tr>";
			}
        }
    }
	if ($count == 0)
	{
		echo "<H1>This folder is empty.</H1>";
	}
	echo "<input type='hidden' name='fileloc' value='" . $filetogo . "'>";
	echo "</table></form>";
    closedir($handle);
}
?>
</body>
</html>
