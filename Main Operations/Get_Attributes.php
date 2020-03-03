 <?php
	include "db.php";
	$db=$_GET["database"];
	$table=$_GET["table"];
	$query = "SHOW COLUMNS FROM $db.$table";
	$result=mysqli_query($con,$query);
	$ans="";
	while ($row = mysqli_fetch_row($result)) {
      $ans=$ans." ".$row[0];
	}
	echo $ans;
 ?>