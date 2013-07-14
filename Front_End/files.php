<html>
<!--
	filename: files.php
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
}
body {
	background-color: #091F48;
}
-->
</style>
</head>
<body topmargin='0' leftmargin='0'>
<?php
chdir("Resources/Documents/Others");
$Location=getcwd();
echo "<center><h2>Other Files</h2></center>";
$count=0;
$btn=0;
if ($handle = opendir($Location)) 
{
	echo "<table name='table_filedisplay' border='0' width='100%' cellspacing='0' cellpadding='0'>";
    while (false !== ($entry = readdir($handle))) 
	{
		if /*($entry != "." && $entry != "..") */
			(substr($entry, 0, 1) != "." && substr($entry,0,4) !="Icon")
		{
			if($btn==3)
			{
				echo "<tr>";
				$btn=0;
			}
			$fullname=$Location . "/" . $entry;
			//echo $fullname . "<br>";
		//
		//NOTE: 2013 01 13: for now, "Other" files only supports .PDF files. this should be fixed to look at filetype and display accordingly
		//
			echo "<td width='33.33%'><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='" . $entry . "' onClick=\"location='" . $fullname . "&page=000'\">" . $entry . "</button></td>";
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
	echo "</table>";
    	closedir($handle);
}
?>
</body>
</html>
