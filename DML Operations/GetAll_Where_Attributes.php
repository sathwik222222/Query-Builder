<?php
	include "db.php";
	
	$databasename=$_GET["database"];
	$tables=explode(",",$_GET["tables"]);
	$ntables=sizeof($tables);
	for($i=0;$i<$ntables;$i++){
		$query = "SHOW COLUMNS FROM $databasename.$tables[$i]";
		$result=mysqli_query($con,$query);
		
		$ans="";
		while ($row = mysqli_fetch_row($result)) {
		  $ans=$ans."<option>".$tables[$i].".".$row[0]."</option>";
		}
		echo $ans;
	}
	
?>