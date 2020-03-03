<?php
	$query=$_GET["query"];
	$to_page=$_GET["to1"];
	$from_page=$_GET["from1"];
	$type="";
	$con=mysqli_connect("localhost","root","","qbusers");
	if(isset($_GET["having"])){
		$type="having";
	}else{
		$type="where";
	}
	$user="user";
	$q="SELECT * FROM user_subquery WHERE to_page=$from_page && from_page=$to_page&&username='$user'&&type='$type'";
	echo $q;
	$num=mysqli_num_rows(mysqli_query($con,$q));
	echo $num;
	if($num>0){
		mysqli_query($con,"DELETE FROM user_subquery WHERE to_page=$from_page && from_page=$to_page&&username='$user'&&type='$type'");
	}
	$q="INSERT INTO user_subquery VALUES('$user',$to_page,$from_page,'$query','$type')";
	$r=mysqli_query($con,$q);
	//echo $q;
?>