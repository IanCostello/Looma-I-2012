<html>
<!--
	filename: location.php
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
	background-color:#4B4B4B;
}
-->
</style>
</head>
<body leftmargin='0' topmargin='0'>
<?php
$command=$_GET['goto'];
$prev_loc=$_GET['prev'];
if ($command=="")
{
	$location="Home";
}
elseif ($command=="home")
{
	$location="Home";
}
elseif ($command=="whiteboard")
{
	$location="White-Board";
}
elseif ($command=="internet")
{
	$location="Web Browser";
}
elseif ($command=="media")
{
	$location="Documents";
}
elseif ($command=="keyboard")
{
	$location=$prev_loc;
}
elseif ($command=="settings")
{
	$location=$prev_loc;
}

if ($command=="internet" || $command=="whiteboard")
{
	echo "<form name='form_location' action='http://localhost/Front_End/location.php' method='get'>";
	echo "<table name='table_location' width='100%'cellspacing='1' cellpading='2' border='0'>";
	echo "<input type='hidden' name='prev' value='" . $location . "'>";
	echo "<tr><td width='15%'><button type='submit' name='goto' value='keyboard' style='width:100%;height:70;background-image:url(Resources/PanelImages/keyboard.png); background-position:center; background-repeat:no-repeat;'></button>";
	echo "<input type='hidden' name='location' value=''>";
	echo "<td><center><font face='Comic Sans MS' size='7'>" . $location . "</font></center></tr>";
	echo "</table></form>";
}
elseif($command=="keyboard")
{
	echo "<form name='form_location' action='http://localhost/Front_End/location.php' method='get'>";
	echo "<table name='table_location' width='100%'cellspacing='1' cellpading='2' border='0'>";
	echo "<input type='hidden' name='prev' value='" . $location . "'>";
	echo "<tr><td width='15%'><button type='submit' name='goto' value='keyboard' style='width:100%;height:70;background-image:url(Resources/PanelImages/keyboard.png); background-position:center; background-repeat:no-repeat;'></button>";
	echo "<input type='hidden' name='location' value=''>";
	echo "<td><center><font face='Comic Sans MS' size='7'>" . $location . "</font></center></tr>";
	echo "</table></form>";
}

else 
{
	echo "<form name='form_location' action='http://localhost/Front_End/location.php' method='get'>";
	echo "<table name='table_location' width='100%' cellspacing='1' cellpading='2' border='0'>";
	echo "<tr><td width='10%'><button type='submit' name='goto' value='keyboardon' style='width:100%;height:100%;visibility:hidden' disabled><img src='Resources/PanelImages/keyboard.png'></button>";
	echo "<td><center><font face='Comic Sans MS' size='7'>" . $location . "</font></center></tr>";
	echo "</table></form>";
}
?>
</body></html>
