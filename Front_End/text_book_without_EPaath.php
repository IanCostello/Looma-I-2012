  <html>
<head>
<!--
	Filename: text_book.php
	Author: dartmouth team
	Modified: Ankit 8/2012
	Modified: Skip 2013 01 08  added nepali and social studies textbooks

	Purpose: composes textbook/nepalitext/activities and [optionally] units button layout 
	for a class/course selection	See class.html to see how text_book.php is called
-->
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
$class=$_GET['sel_book'];
$course=$_GET['sel_course'];
echo "<h2>Section: " . $class . " " . $course . "</h2>";
$Location="Resources/Documents/TextBooks/" . $class . "/" . $course;

//echo "<h2>DEBUG: location is " . $Location  . "</h2>";

chdir($Location);
$Location=getcwd();
$book=$course . ".pdf";

//echo "DEBUG book is " . $book;

if ($handle = opendir($Location)) 
{
	while (false !== ($entry = readdir($handle))) 
	{
		if (/*$entry != "." && $entry != ".." && */ $entry == $book) 
		{
			$fullname=$Location . "/" . $entry;

//echo "<h2>DEBUG: fullname is " . $fullname . "</h2>";

echo "<table name='table_textdisplay' cellspacing='1' cellpadding='1'>";


if ($class=="Class2")
{
	if($course=="Nepali")
	{

//Class 2 Nepali

	echo "<tr><td align='center'>Text-Book<td align='center'></tr>";		
	echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' 		name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=000'\">
	Text Book</button>";
	}
	if($course=="SocialStudies")
	{

//Class 2 SocialStudies

	echo "<tr><td align='center'>Text-Book<td align='center'></tr>";		
	echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' 		name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=000'\">
	Text Book</button>";
	}
	if($course=="English")
	{

//Class 2 English

echo "<tr><td align='center'>Text-Book<td align='center'>Activities</tr>";		
echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=005'\">Unit 1</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='english21.html'\">Activity 1 </button></tr>";
		
echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=012'\">Unit 2</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='english22.html'\">Activity 2 </button></tr>";
		
echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=017'\">Unit 3</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='english23.html'\">Activity 3 </button></tr>";
		
echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=024'\">Unit 4</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='english24.html'\">Activity 4 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=030'\">Unit 5</button>";
//echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='english25.html'\">Activity 5 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=037'\">Unit 6</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='english26.html'\">Activity 6 </button></tr>";
	
echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=043'\">Unit 7</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='english27.html'\">Activity 7 </button></tr>";
	
echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=050'\">Unit 8</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='english28.html'\">Activity 8 </button></tr>";
	
echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=055'\">Unit 9</button>";
 
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/english.2.09.html'\">Activity 9 </button></tr>";
	
echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=060'\">Unit 10</button>";
 
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/english.2.10.html'\">Activity 10 </button></tr>";
	
echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=066'\">Unit 11</button>";
 
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/english.2.11.html'\">Activity 11 </button></tr>";
	
echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=071'\">Unit 12</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='english212.html'\">Activity 12 </button></tr>";
	}
	if($course=="Science")
	{

//Class 2 Science

$entryn="Science-Nepali.pdf";
$fullname1=$Location . "/" . $entryn;

echo "<tr><td align='center'>Text-Book English<td align='center'>Text-Book Nepali<td align='center'>Activities</tr>";		

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=008'\">S-Unit 1</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=008'\">N-Unit 1</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=010'\">S-Unit 2</button>";
//echo "DEBUG location=" . $fullname1 . "&page=010";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=010'\">N-Unit 2</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='science22.html'\">Activity 2 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=012'\">S-Unit 3</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=012'\">N-Unit 3</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='science23.html'\">Activity 3 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=014'\">S-Unit 4</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=014'\">N-Unit 4</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=016'\">S-Unit 5</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=016'\">N-Unit 5</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=018'\">S-Unit 6</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=018'\">N-Unit 6</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=020'\">S-Unit 7</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=020'\">N-Unit 7</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=022'\">S-Unit 8</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=022'\">N-Unit 8</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=024'\">S-Unit 9</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=024'\">N-Unit 9</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=026'\">S-Unit 10</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=026'\">N-Unit 10</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='science210.html'\">Activity 10 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=028'\">S-Unit 11</button>";;
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=028'\">N-Unit 11</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=030'\">S-Unit 12</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=030'\">N-Unit 12</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=032'\">S-Unit 13</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=032'\">N-Unit 13</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=034'\">S-Unit 14</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=034'\">N-Unit 14</button>";
 
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/science.2.14.html'\">Activity 14 </button></tr>";

echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=036'\">S-Unit 15</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=036'\">N-Unit 15</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/science.2.15.html'\">Activity 15 </button></tr>";

echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=038'\">S-Unit 16</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=038'\">N-Unit 16</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/science.2.16.html'\">Activity 16 </button></tr>";

echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=040'\">S-Unit 17</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=040'\">N-Unit 17</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/science.2.17.html'\">Activity 17 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=042'\">S-Unit 18</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=042'\">N-Unit 18</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/science.2.18.html'\">Activity 18 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=044'\">S-Unit 19</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=044'\">N-Unit 19</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/science.2.19.html'\">Activity 19 </button></tr>";


echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=046'\">S-Unit 20</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=046'\">N-Unit 20</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/science.2.20.html'\">Activity 20 </button></tr>";


echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=048'\">H-Unit 1</button>";
//empty button to position 'activity h1'
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS'</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='health21.html'\">Activity H-1</button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=050'\">H-Unit 2</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=052'\">H-Unit 3</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=054'\">H-Unit 4</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=056'\">H-Unit 5</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=058'\">H-Unit 6</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=060'\">H-Unit 7</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=062'\">H-Unit 8</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=064'\">H-Unit 9</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=066'\">P-Unit 1</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=068'\">P-Unit 2</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=070'\">P-Unit 3</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=072'\">P-Unit 4</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=074'\">P-Unit 5</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=076'\">P-Unit 6</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=078'\">P-Unit 7</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=079'\">P-Unit 8</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=080'\">P-Unit 9</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=083'\">P-Unit 10</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=084'\">P-Unit 11</button>";
//echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='http://www.pustakalaya.org/external-content/static/epaath/epaath/'\">Activity 11</button></tr>";
	}
	if($course=="Math")
	{
$entryn="Math-Nepali.pdf";
$fullname1=$Location . "/" . $entryn;

//Class 2 Math

//echo "<h2>DEBUG: fullname1 is " . $fullname1 . "</h2>";

echo "<tr><td align='center'>Text-Book English<td align='center'>Text-Book Nepali<td align='center'>Activities</tr>";		

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=007'\">E-Unit 1</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=007'\">N-Unit 1</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='math21.html'\">Activity 1</button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=010'\">E-Unit 2</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=010'\">N-Unit 2</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='math22.html'\">Activity 2</button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=013'\">E-Unit 3</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=013'\">N-Unit 3</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=017'\">E-Unit 4</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=017'\">N-Unit 4</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=020'\">E-Unit 5</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=020'\">N-Unit 5</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=022'\">E-Unit 6</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=022'\">N-Unit 6</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=026'\">E-Unit 7</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=026'\">N-Unit 7</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=028'\">E-Unit 8</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=028'\">N-Unit 8</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=033'\">E-Unit 9</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=033'\">N-Unit 9</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=036'\">E-Unit 10</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=036'\">N-Unit 10</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='math210.html'\">Activity 10</button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=043'\">E-Unit 11</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=043'\">N-Unit 11</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='math211.html'\">Activity 11</button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=047'\">E-Unit 12</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=047'\">N-Unit 12</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='math212.html'\">Activity 12</button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=049'\">E-Unit 13</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=049'\">N-Unit 13</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='math213.html'\">Activity 13</button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=057'\">E-Unit 14</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=057'\">N-Unit 14</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=060'\">E-Unit 15</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=060'\">N-Unit 15</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=062'\">E-Unit 16</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=062'\">N-Unit 16</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=063'\">E-Unit 17</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=063'\">N-Unit 17</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=066'\">E-Unit 18</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=066'\">N-Unit 18</button>";
 
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/math.2.18.html'\">Activity 18 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=078'\">E-Unit 19</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=078'\">N-Unit 19</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=082'\">E-Unit 20</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=082'\">N-Unit 20</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=089'\">E-Unit 21</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=089'\">N-Unit 21</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=091'\">E-Unit 22</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=091'\">N-Unit 22</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=094'\">E-Unit 23</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=094'\">N-Unit 23</button>";
 
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/math.2.23.html'\">Activity 23 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=096'\">E-Unit 24</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=096'\">N-Unit 24</button>";

	}
}

elseif ($class=="Class5")
{
	if($course=="Nepali")
	{

//Class 5 Nepali

	echo "<tr><td align='center'>Text-Book<td align='center'></tr>";		
	echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' 		name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=000'\">
	Text Book</button>";
	}
	if($course=="SocialStudies")
	{

//Class 5 SocialStudies

	echo "<tr><td align='center'>Text-Book<td align='center'></tr>";		
	echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' 		name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=000'\">
	Text Book</button>";
	}

	if($course=="English")
	{

//Class 5 English

echo "<tr><td align='center'>Text-Book<td align='center'>Activities</tr>";		
echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=004'\">Unit 1</button>";
		
echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=015'\">Unit 2</button>";
		
echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=024'\">Unit 3</button>";
		
echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=034'\">Unit 4</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=042'\">Unit 5</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=051'\">Unit 6</button>";
	
echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=061'\">Unit 7</button>";
 
	
echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=070'\">Unit 8</button>";
 
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/english.5.08.html'\">Activity 8 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=078'\">Unit 9</button>";
	
echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=086'\">Unit 10</button>";
 
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/english.5.10.html'\">Activity 10 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=095'\">Unit 11</button>";
	
echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=103'\">Unit 12</button>";
 
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/english.5.12.html'\">Activity 12 </button></tr>";

	}
	if($course=="Science")
	{

//Class 5 Science

$entryn="Science-Nepali.pdf";
$fullname1=$Location . "/" . $entryn;

echo "<tr><td align='center'>Text-Book English<td align='center'>Text-Book Nepali<td align='center'>Activities</tr>";		

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=009'\">S-Unit 1</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=009'\">N-Unit 1</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='science51.html'\">Activity 1 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=015'\">S-Unit 2</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=015'\">N-Unit 2</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='science22.html'\">Activity 2 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=018'\">S-Unit 3</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=018'\">N-Unit 3</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/science.5.03.html'\">Activity 3 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=020'\">S-Unit 4</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=020'\">N-Unit 4</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=025'\">S-Unit 5</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=025'\">N-Unit 5</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=029'\">S-Unit 6</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=029'\">N-Unit 6</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=035'\">S-Unit 7</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=035'\">N-Unit 7</button>";
 
echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=040'\">S-Unit 8</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=040'\">N-Unit 8</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=043'\">S-Unit 9</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=043'\">N-Unit 9</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=049'\">S-Unit 10</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=049'\">N-Unit 10</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='science210.html'\">Activity 10 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=054'\">S-Unit 11</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=054'\">N-Unit 11</button>"; 
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/science.5.11.html'\">Activity 11 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=056'\">S-Unit 12</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=056'\">N-Unit 12</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/science.5.12.html'\">Activity 12 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=063'\">S-Unit 13</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=063'\">N-Unit 13</button>"; 
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/science.5.13.html'\">Activity 13 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=068'\">S-Unit 14</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=068'\">N-Unit 14</button>"; 
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/science.5.14.html'\">Activity 14 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=073'\">S-Unit 15</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=073'\">N-Unit 15</button>"; 
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/science.5.15.html'\">Activity 15 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=081'\">H-Unit 1</button>";
//empty button to position 'activity h1'
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS'</button>";
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='health21.html'\">Activity H-1</button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=084'\">H-Unit 2</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=086'\">H-Unit 3</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=089'\">H-Unit 4</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=092'\">H-Unit 5</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=095'\">H-Unit 6</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=098'\">H-Unit 7</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=101'\">H-Unit 8</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=103'\">H-Unit 9</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=103'\">H-Unit 10</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=105'\">H-Unit 11</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=110'\">H-Unit 12</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=112'\">H-Unit 13</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=114'\">H-Unit 14</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=137'\">P-Unit 1</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=141'\">P-Unit 2</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=144'\">P-Unit 3</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=147'\">P-Unit 4</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=149'\">P-Unit 5</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=151'\">P-Unit 6</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=154'\">P-Unit 7</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=158'\">P-Unit 8</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=160'\">P-Unit 9</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=162'\">P-Unit 10</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=164'\">P-Unit 11</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=165'\">P-Unit 12</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=167'\">P-Unit 13</button>";

	}
	if($course=="Math")
	{

//Class 5 Math

$entryn="Math-Nepali.pdf";
$fullname1=$Location . "/" . $entryn;
echo "<tr><td align='center'>Text-Book English<td align='center'>Text-Book Nepali<td align='center'>Activities</tr>";		

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=005'\">E-Unit 1</button>";
echo "<td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=005'\">N-Unit 1</button>";
//echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='location='http://www.pustakalaya.org/external-content/static/epaath/epaath/'\">Activity 1</button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=022'\">E-Unit 2</button>";
echo "<td><button  type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=022'\">N-Unit 2</button>";
//echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='location='http://www.pustakalaya.org/external-content/static/epaath/epaath/'\">Activity 2</button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=038'\">E-Unit 3</button>";
echo "<td><button  type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=038'\">N-Unit 3</button>";
//echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='http://www.pustakalaya.org/external-content/static/epaath/epaath/'\">Activity 3</button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=042'\">E-Unit 4</button>";
echo "<td><button  type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=042'\">N-Unit 4</button>";
//echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='http://www.pustakalaya.org/external-content/static/epaath/epaath/'\">Activity 4</button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=047'\">E-Unit 5</button>";
echo "<td><button  type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=047'\">N-Unit 5</button>";
//echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='http://www.pustakalaya.org/external-content/static/epaath/epaath/'\">Activity 5</button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=053'\">E-Unit 6</button>";
echo "<td><button  type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=053'\">N-Unit 6</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=057'\">E-Unit 7</button>";
echo "<td><button  type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=057'\">N-Unit 7</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=060'\">E-Unit 8</button>";
echo "<td><button  type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=059'\">N-Unit 8</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=064'\">E-Unit 9</button>";
echo "<td><button  type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=064'\">N-Unit 9</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=067'\">E-Unit 10</button>";
echo "<td><button  type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=066'\">N-Unit 10</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=071'\">E-Unit 11</button>";
echo "<td><button  type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=071'\">N-Unit 11</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=075'\">E-Unit 12</button>";
echo "<td><button  type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=075'\">N-Unit 12</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=092'\">E-Unit 13</button>";
echo "<td><button  type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=092'\">N-Unit 13</button>";
 
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/math.5.13.html'\">Activity 13 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=097'\">E-Unit 14</button>";
echo "<td><button  type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=097'\">N-Unit 14</button>";
 
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/math.5.14.html'\">Activity 14 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=100'\">E-Unit 15</button>";
echo "<td><button  type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=099'\">N-Unit 15</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=103'\">E-Unit 16</button>";
echo "<td><button  type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=103'\">N-Unit 16</button>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=110'\">E-Unit 17</button>";
echo "<td><button  type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=110'\">N-Unit 17</button>";
 
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/math.5.17.html'\">Activity 17 </button></tr>";

echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=112'\">E-Unit 18</button>";
echo "<td><button  type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname1 . "&page=112'\">N-Unit 18</button>";
 
echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='activitiesHTML/math.5.18.html'\">Activity 18 </button></tr>";

	}
}
else
{

// Classes other than 2 and 5

echo "<tr><td align='center'>Text-Book<td align='center'></tr>";		
echo "<tr><td><button type='button' style='width:370;height:40;font: bold 15px Comic Sans MS' name='filedisplay' value='Unit1' onClick=\"location='" . $fullname . "&page=000'\">Text Book</button>";
//echo "<td><button type='button' name='activity' style='width:370;height:40;font: bold 15px Comic Sans MS' onClick=\"location='http://www.pustakalaya.org/external-content/static/epaath/epaath/'\">Activity</button></tr>";
}


echo "</table>";


        }
    }
    closedir($handle);
}

?>
</body></html>
