<html>
<head>
<script type="text/javascript">
window.ondragstart = function() { return false; }
</script>
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
$filename=$_GET['wbddisplay'];
if($filename!="" && $filetogo!="")
{
$filetogo = $filetogo . "/" . $filename;
echo "<img src='" . $filetogo ."' height='200' width='350'><hr>";
echo "<form name='fullsizeimage' action='http://localhost/Front_End/fullsizeImage.php' target='_blank' method='get'>";
echo "<input type='hidden' name='fileloc' value='" . $filetogo ."'>";
echo "<input type='hidden' name='filename' value='" . $filename ."'>";
echo "<h4>Image-Name: " . $filename . "</h4>";
echo "<button type='submit' name='goto' value='newtab'>Click to view full size image</button>";
echo "</form>";
}
?>
</body>
</html>
