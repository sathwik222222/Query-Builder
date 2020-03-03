<?php
	$username=$_GET["username"];
	$to1=$_GET["to1"];
	$from1=$_GET["from1"];
	$type=$_GET["type"];
	
	$con=mysqli_connect("localhost","root","","qbusers");
	
	$query="SELECT subquery FROM user_subquery WHERE to_page=$to1 && from_page=$from1 && type='$type' && username='$username'";
	
	$result= mysqli_query($con,$query);
	
	
	while($row = mysqli_fetch_array($result))
	{
		
		echo $row[0];
		break;
	}
	
	$query="DELETE  FROM user_subquery WHERE to_page=$to1 && from_page=$from1 && type='$type' && username='$username'";
	
	$result= mysqli_query($con,$query);
	
	
?>