<html>
<!--
	filename: external.php
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
	font-weight: bold;
	font-size: 16px;
}
body {
	background-color: #091F48;
}
-->
</style>
<script type="text/javascript">
function picpreview()
{
	form_files.action="http://localhost/Front_End/externalImage.php";
}
function videopreview()
{
	form_files.action="http://localhost/Front_End/externalVideo.php";
}
function goback()
{
	form_options.action="http://localhost/Front_End/external.php";
}
function gotoedit()
{
	form_options.action="http://localhost/Front_End/edit.php";
}


</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body topmargin="0px">
<?php
chdir("/media");
$connect=$_GET['pd'];
$Location=getcwd();  
echo "called external.php: ";
echo "location = " . $Location . ", connect = " . $connect;
$count=0;
$btn=0;
$fcount=0;
if ($handle = opendir($Location)) 
{
	echo "<center><h2>USB Devices</h2></center>";
	echo "<form name='form_pd' action='http://localhost/Front_End/external.php' target='_self' method='get'>";
	echo "<table name='table_filedisplay' border='0' width='100%' cellspacing='0' cellpadding='0'>";
	while (false !== ($entry = readdir($handle))) 
	{
		if ($entry != "." && $entry != "..") 
		{
			if($btn==4)
			{
				echo "<tr>";
				$btn=0;
			}
			$fullname=$Location . "/" . $entry;
			//echo $fullname . "<br>";
			echo "<td width='25%'>
			<button type='submit' style='width:100%;height:40;font: bold 15px Comic Sans MS' name='pd' value='" . $fullname . "'>" . $entry . "</button></td>";
			$count=1;
			$btn=$btn+1;
			if($btn==4)
			{
				echo "</tr>";
				
			}
        }
	}
		if ($btn != 4)
		{ 
			if ($btn==1)
			{
				echo"<td><td><td></tr>";
				$btn=0;
			}
			elseif ($btn==2)
			{
				echo"<td><td></tr>";
				$btn=0;
			}
			elseif ($btn==3)
			{
				echo"<td></tr>";
				$btn=0;
			}
    	}
	
	echo "</table>";
	echo "</form><hr>";
    closedir($handle);
}
if ($connect != "")
{
chdir($connect);
$Location=getcwd();
$btn=0;
echo "<form name='form_options' action='' target='_blank' method='get'>";
echo "<table name='table_options' width='100%' cellspacing='0' cellpadding='0' border='0'>";
//echo "<tr><td width='50%'><button type='submit' style='width:100%;height:40;font: bold 15px Comic Sans MS' name='pd' value='" . $Location . "' onClick='goback()'><<< Back</button>";
echo "<tr><td width='50%'><button type='submit' style='width:100%;height:40;font: bold 15px Comic Sans MS' name='edit' value='" . $Location . "' onClick='gotoedit()'>Edit</button></tr>";
echo "</table></form>";
echo "<table name='table_usbinside' width='100%' cellspcaing='0' cellpadding='0' border='0'>";
echo "<tr><td width='25%' align='center'>Folders<td width='75%' align='center'>Files</tr>";
echo "<tr><td width='25%' align='top'>";
if ($handle = opendir($Location)) 
{
	echo "<form name='form_folders' method='get' action='http://localhost/Front_End/external.php' target='_self'>";
	echo "<table name='table_folderdisplay' border='0' width='100%' cellspacing='0' cellpadding='0'>";
	while (false !== ($entry = readdir($handle))) 
	{
		if ($entry != "." && $entry != "..") 
		{
			$fullname=$Location . "/" . $entry;
			if(is_dir($entry))
			{
			echo "<tr><td width='33.33%'><button type='submit' style='width:100%;height:40;font: bold 15px Comic Sans MS' name='pd' value='" . $fullname . "'>" . $entry . "</button></td></tr>";
			$fcount=$fcount+1;
			}
	    }
	}
	echo "</table></form>";
    closedir($handle);	
}
echo "<td width='75%' align='top'>";

if ($handle = opendir($Location)) 
{
	echo "<form name='form_files' method='get' action='' target='_self'>";
	echo "<input type='hidden' name='fileloc' value='" . $Location . "'>";
	echo "<table name='table_filedisplay' border='0' width='100%' cellspacing='0' cellpadding='0'>";
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
			if(! is_dir($entry))
			{
				$ext=substr(strrchr($entry,'.'),1);
				if($ext == "pdf")
				{
					echo "<td width='33.33%'><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='" . $entry . "' onClick=\"location='" . $fullname . "'\">" . $entry . "</button></td>";
				}
				elseif($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif" || $ext == "tiff" || $ext == "bmp")
				{
					echo "<td width='33.33%'><button type='submit' name='filename' value='" . $entry . "' style='width:100%;height:40;font: bold 15px Comic Sans MS' onClick='picpreview()'>" . $entry . "</button></td>";
				}
				elseif($ext == "mp4" || $ext == "webm" || $ext == "ogg")
				{
					echo "<td width='33.33%'><button type='submit' name='filename' value='" . $entry . "' style='width:100%;height:40;font: bold 15px Comic Sans MS' onClick='videopreview()'>" . $entry . "</button></td>";
				}

			$btn=$btn+1;
			}
			if($btn==3)
			{
				echo "</tr>";
				$fcount=$fcount-1;
			}
        }
	}
		if ($btn != 3)
		{ 
			if ($btn==1)
			{
				echo"<td><td></tr>";
				$btn=0;
				$fcount=$fcount-1;
			}
			elseif ($btn==2)
			{
				echo"<td></tr>";
				$btn=0;
				$fcount=$fcount-1;
			}
    	}
		if ($fcount != 0)
		{
			while($fcount >= 0)
			{
				echo"<tr><td height='40'><td height='40'><td height='40'></tr>";
				$fcount=$fcount-1;
			}
		}
	
	echo "</table></form>";
    closedir($handle);	
}
echo"</tr></table>";
echo "</table>";
}
if ($count == 0)
	{
		echo "<H1>There is no Device connected to LOOMA.</H1>";
	}

?>
</body>
</html>
