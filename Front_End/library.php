<html>
<!--
	filename:library.php
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
<body>
<?php
$course=$_GET['course'];
$currentDir = getcwd();

//echo "current directory is " . $currentDir . "<br> <br>";

if ($course == "")
{
}
else
{
for ($i=1; $i<9; $i++)

//NOTE: number of classes is hardwired to '9' in the above 'for' statement

{

$Location=$currentDir . "/Resources/Documents/TextBooks/Class" . $i . "/" . $course;

$btn=0;
if ($handle = opendir($Location)) 
{
	echo "<h2> Class " . $i . ":</h2>";
	echo "<table name='table_libdisplay' border='0' width='100%' cellspacing='0' cellpadding='0'>";
    while (false !== ($entry = readdir($handle))) 
	{
		if /*($entry != "." && $entry != "..")*/
		   (substr($entry, 0, 1) != "." && substr($entry,0,4) !="Icon") 
		{
			if($btn==3)
			{
				echo "<tr>";
				$btn=0;
			}
			$fullname=$Location . "/" . $entry;

			echo "<td width='33.33%'><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='" . $entry . "' onClick=\"location='" . $fullname . "&page=000'\">" . $entry . "</button></td>";
			$btn=$btn+1;
			if($btn==3)
			{
				echo "</tr>";
			}
      		  }
   	 }
	echo "</table>";
    closedir($handle);
} 
}
}
?>
</body>
</html>
