<html>
<!--
	filename: externalImage.php
	author: peter and ankit
	modified: 
	copyright: VillageTech Solutions, 2013
-->

<head>
<script type="text/javascript">
window.ondragstart = function() { return false; }
</script>
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
<?php
$filetogo=$_GET['fileloc'];
chdir($filetogo);
$fileloc=getcwd();
echo $fileloc;
$filename=$_GET['filename'];
$fileloc1 = $filetogo . "/" . $filename;
$fileloc = $fileloc1;
$val=copy($fileloc1,$fileloc);
if($val==1)
{
echo $fileloc;
echo "<form name='fullimage' action='http://localhost/Front_End/external.php' method='get'>";
echo "<table name='table_fullsize' border='0' cellpadding='1' cellspacing='0' width='100%'>";
echo "<td width='95%' align='center'><h4>" . $filename . "</h4>";
echo "<td width='5%' align='right'><button style='width:55;height:55;background-image:url(Resources/close_button.png); background-position:center; background-repeat:no-repeat;'type='submit' name='pd' value='" . $filetogo . "'></button><br>";
echo "</form></tr></table><hr>";
echo "<img src='Resources/Documents/Temp/close.png'>";
//echo $filetogo;
}
?>
</body>
</html>
