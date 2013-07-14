<html>
<!--
	filename: edit.php
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
function goback()
{
	form_options.action="http://localhost/Front_End/external.php";
}
function moveto()
{
	form_options.action="http://localhost/Front_End/edit.php";
}
function renameto()
{
	form_options.action="http://localhost/Front_End/edit.php";
}
function delfile()
{
	form_options.action="http://localhost/Front_End/edit.php";
}


</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body topmargin="0px">
<?php
$src=$_GET['edit'];
$opt=$_GET['opt'];
$todo=$_GET['todo'];
if ($todo=="")
{
chdir($src);
$Location=getcwd();
$btn=0;
echo "<form name='form_options' action='' target='_self' method='get'>";
echo "<input type='hidden' name='edit' value='" . $Location . "'>";
echo "<table name='table_options' width='100%' cellspcaing='0' cellpadding='0' border='0'>";
echo "<tr><td width='25%'><button type='submit' style='width:100%;height:40;font: bold 15px Comic Sans MS' name='opt' value='move' onClick='moveto()'>Move</button>";
echo "<td width='25%'><button type='submit' style='width:100%;height:40;font: bold 15px Comic Sans MS' name='opt' value='rename' onClick='renameto()'>Rename</button>";
echo "<td width='25%'><button type='submit' style='width:100%;height:40;font: bold 15px Comic Sans MS' name='opt' value='delete' onClick='delfile()'>Delete</button>";
echo "<td width='25%'><button type='submit' style='width:100%;height:40;font: bold 15px Comic Sans MS' name='pd' value='" . $Location . "' onClick='goback()'>Exit</button></tr>";
echo "</table></form>";
if ($opt != "")
{
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
			if(! is_dir($entry))
			{
				if ($opt=="move" || $opt=="delete")
				{
					echo "<td width='33.33%' align='left'><input type='checkbox' name='file[]' value='" . $entry . "'>" . $entry . "</td>";
				}
				elseif ($opt=="rename")
				{
					echo "<td width='33.33%' align='left'><input type='radio' name='chfile' value='" . $entry . "'>" . $entry . "</td>";
				}

			$btn=$btn+1;
			}
			if($btn==3)
			{
				echo "</tr>";
			}
        }
	}
		if ($btn != 3)
		{ 
			if ($btn==1)
			{
				echo"<td><td></tr>";
				$btn=0;
			}
			elseif ($btn==2)
			{
				echo"<td></tr>";
				$btn=0;
			}
		}
	
	echo "</table><hr><br>";
	if ($opt=="move")
	{
		echo "<button type='submit' style='width:25%;height:40;font: bold 15px Comic Sans MS' name='todo' value='move'>Move</button>";
	}
	elseif ($opt=="delete")
	{
		echo "<button type='submit' style='width:25%;height:40;font: bold 15px Comic Sans MS' name='todo' value='delete'>Delete</button>";
	}
	elseif ($opt=="rename")
	{
		echo "<input type='text' style='width:25%;height:40;font: bold 15px Comic Sans MS'name='saveas' value='New-File'>	";
		echo "<button type='submit' name='todo' style='width:25%;height:40;font: bold 15px Comic Sans MS' value='rename'>Save</button>";
	}
	echo "<input type='hidden' name='edit' value='" . $Location . "'>";
	echo "</form>";
    closedir($handle);	
}
}
}
else
{
echo "<form name='form_done' action='http://localhost/Front_End/edit.php' method='get' target='_self'>";
echo "<input type='hidden' name='edit' value='" . $src . "'>";
if ($todo == "move")
{
$filename=$_GET['file'];
if ($filename=="")
{
echo "Blank" . "<br>";
}
else
{
for($i=0;$i<count($filename);$i++)
{
$fullname=$src . "/" . $filename[$i];
//echo $filename[$i] . "<br>" . $fullname . "<br>";
$ext=substr(strrchr($filename[$i],'.'),1);
	if($ext == "pdf")
	{
		$newsrc="/var/www/Front_End/Resources/Documents/Others";
		$newfile=$filename[$i];
	}
	elseif($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif" || $ext == "tiff" || $ext == "bmp")
	{
		$newsrc="/var/www/Front_End/Resources/Documents/Pictures";
		$newfile=$filename[$i];
	}
	elseif($ext == "mp4" || $ext == "webm" || $ext == "ogg")
	{
		$newsrc="/var/www/Front_End/Resources/Documents/Videos";
		$newfile=$filename[$i];
	}
$newfullname=$newsrc . "/" . $newfile;
$val=copy($fullname,$newfullname);
}
}
}
elseif($todo == "delete")
{
$filename=$_GET['file'];
if ($filename=="")
{
echo "Blank" . "<br>";
}
else
{
for($i=0;$i<count($filename);$i++)
{
	$fullname=$src . "/" . $filename[$i];
	$val=unlink($fullname);
}
}
}
elseif($todo == "rename")
{
$filename=$_GET['chfile'];
$saveas=$_GET['saveas'];
if ($filename=="" || $saveas=="")
{
echo "Blank";
}
else
{
$fullname=$src . "/" . $filename;
$ext=substr(strrchr($filename,'.'),1);
$newfile=$src . "/" . $saveas . "." . $ext;
$val=rename($fullname,$newfile);
if($val=="True")
{
echo "Saved as " . $saveas . "." . $ext . "<br>";
}
else
{
echo "Could Not Rename " . $filename . "<br>";
}
//echo $fullname . "<br>" . $newfile;
}
}
echo "<button type='submit' style='width:25%;height:40;font: bold 15px Comic Sans MS' name='Complete'>OK</button>";
}
?>
</body>
</html>
