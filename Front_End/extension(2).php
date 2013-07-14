<?php
chdir("Resources/Documents/Videos");
$Location=getcwd();
$count=0;
$btn=0;
if ($handle = opendir($Location)) 
{
	echo "<table name='table_videodisplay' border='0'>";
    while (false !== ($entry = readdir($handle))) 
	{
		if ($entry != "." && $entry != "..") 
		{
			if($btn==3)
			{
				echo "<tr>";
				$btn=0;
			}
			$fullname=$Location . "/" . $entry;
			//echo $fullname . "<br>";
			echo "<td><button type='submit' style='width:370;height:40;font: bold 15px Comic Sans MS' name='videodisplay' value='" . $fullname . ">" . $entry . "</button></td>";
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