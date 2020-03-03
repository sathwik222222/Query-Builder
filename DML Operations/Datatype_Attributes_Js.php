<?php
	$db=$_GET["database"];
	$table=explode(",",$_GET["tables"]);
	$ntables=count($table);
	
	include "db.php";
	$ans="";
	for($i=0;$i<$ntables;$i++){
		$query = "SHOW COLUMNS FROM $db.$table[$i]";
		$result=mysqli_query($con,$query);
		
		$x=0;
		while ($row = mysqli_fetch_array($result)) {
			
			if(strlen(trim($row[0]))==0){
				continue;
			}
			if($x==1)
				$ans=$ans."-";
			$ans=$ans.$table[$i].".".$row[0]."  :  ".$row[1];
			$x=1;
			
		}
		if($i!=$ntables-1)
			$ans=$ans."-";	
	}
	echo $ans;
	
?>