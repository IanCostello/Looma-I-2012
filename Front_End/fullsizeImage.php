<html>
<!--
	filename: fullsizeImage.php
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
$filename=$_GET['filename'];

//echo $filetogo;

echo "<form name='fullimage' action='' method='get'>";
echo "<table name='table_fullsize' border='0' cellpadding='1' cellspacing='0' width='100%'>";

//[skip, 1/8/2013] commented next line to give more space to display picture
//echo "<td width='95%' align='center'><h4>" . $filename . "</h4>";

//[skip, 1/6/2013] commented next line to eliminate "close" button - just "back' arrow
//echo "<td width='5%' align='right'><button style='width:55;height:55;background-image:url(Resources/close_button.png); background-position:center; background-repeat:no-repeat;'type='submit' name='goto' value='close'></button><br>";
echo "</form></tr></table><hr>";
echo "<img src='" . $filetogo ."'>";
//echo $filetogo;
?>
</body>
</html>
