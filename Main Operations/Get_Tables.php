 <?php
	include "db.php";
	if($_GET["database"]!="Select"){
		
		$db=$_GET["database"];
		
		$query="SHOW TABLES FROM $db";
		$result=mysqli_query($con,$query);
		$ans="";
		while ($row = mysqli_fetch_row($result)) {
		  $ans=$ans." ".$row[0];
		}
		echo $ans;
	}
 ?>