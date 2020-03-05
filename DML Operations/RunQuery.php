<?php
	$db=$_GET["database"];
	$query=$_GET["query"];
	$con=mysqli_connect("localhost","root","",$db);
	$s=preg_split("[ ]", $query);
	$q1=$query;
	if($s[0]=="SELECT"){
		
		
		
		
	
		
		/*
		if($s[count($s)-2]!="LIMIT"){
			$query=$query." LIMIT 1";
		}else{
			$s[count($s)-1]="1";
			$query=join(" ",$s);
		}
	
		$table="usertabdelete";
		$query="CREATE TABLE $table AS ".$query;
		

		$result=mysqli_query($con,$query);
		
		
		$query="SHOW COLUMNS FROM $table";
		//echo $query;
		$result1=mysqli_query($con,$query);
		if($result==FALSE){
			//echo "Error";
		}else{
			while($row1 = mysqli_fetch_array($result1))
				echo "<th>".$row1["Field"]."</th>";
			$result=mysqli_query($con," DROP TABLE ".$table);
		}
		
		*/
		
		
		
		$result=mysqli_query($con,$q1);
		
		
		while($row = mysqli_fetch_row($result))
		{
			echo "<tr>";
			foreach($row as $cell)
				echo "<td>$cell</td>";
			echo "</tr>\n";
		}
		mysqli_close($con);
		
	}else if($s[0]=="CREATE"){
		
		
		$result=mysqli_query($con,$q1);
		
		if($s[0]=="CREATE"){
			if($result==FALSE){
				echo "Check whether the table is created / Duplicate Columns ";
			}else{
				echo "Successfully Created";
			}
		}
		/*
		if($s[0]=="SELECT"){
			while($row = mysqli_fetch_row($result))
			{
				echo "<tr>";
				foreach($row as $cell)
					echo "<td>$cell</td>";
				echo "</tr>\n";
			}
			mysqli_close($con);
		}
		*/
	}
	else if($s[0]=="INSERT"||$s[0]=="DELETE"||$s[0]=="UPDATE"){
		if(mysqli_query($con,$q1)){
			echo "Successfully Executed";
		}else{
			echo "Problem in user specifications";
		}
		
	}
?>