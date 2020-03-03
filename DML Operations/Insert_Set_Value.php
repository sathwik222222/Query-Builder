<?php
	if(isset($_GET["x"])){
		$db=$_GET["database"];
		$table=$_GET["table"];
		
		include "db.php";
		$query = "SHOW COLUMNS FROM $db.$table";
		$result=mysqli_query($con,$query);
		$ans="";
		
		while ($row = mysqli_fetch_array($result)) {
			if(strlen(trim($row[0]))==0){
				continue;
			}
			$ans=$ans."<option>";
			$ans=$ans.$row[0]."  :  ".$row[1];
			$ans=$ans."</option>";
		}
		echo $ans;
		
	}else{
		$db=$_GET["database"];
		$table=$_GET["table"];
		
		include "db.php";
		$query = "SHOW COLUMNS FROM $db.$table";
		$result=mysqli_query($con,$query);
		$ans="<div class='row'>";
		$x=1;
		
		while ($row = mysqli_fetch_row($result)) {
			
			$ans=$ans."
			<div class='col-md-4'>
				<label class='form-label'>$row[0] : $row[1]</label>
				<input type='text' id='insert_value_".($x)."' class='form-control'>
				<input id='insert_value_datatype_".($x++)."' type='text' value='$row[1]' hidden>
			</div>";
			
		}
		$ans=$ans."<input type='text' id='nattributes' value='$x' hidden>";
		$ans=$ans."</div>";
		echo $ans;
	}
?>