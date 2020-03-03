<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="Assets/OutSource/cdnjs_cloudflare.css" type="text/css">
  <link rel="stylesheet" href="Assets/OutSource/static_pingendo.css">
  <script src="Assets/OutSource/code_jquery.js"></script>
  <script src="Assets/OutSource/cdnjs_cloudflare_popper.js"></script>
  <script src="Assets/OutSource/stackpath_bootstrapcdn.js"></script>
</head>
<?php

	if(isset($_POST["loginsubmit"])){
		session_start();
		$_SESSION["userid"]="";
		$uid=$_POST["userid"];
		$password=$_POST["password"];
		$con=mysqli_connect("localhost","root","","QBUsers");
		$sql = "SELECT * FROM login WHERE userid = '$uid' and password = '$password'";
		//echo $sql;
		$result = mysqli_query($con,$sql);
		$count = mysqli_num_rows($result);
		if($count==1){
			$_SESSION['userid'] = $uid;
			header("Location: homeAdmin.php");
		}else{
			echo "<script>alert('Invalid Credentials');</script>";
		}
	}
?>
<body>
	<br><br><br><br><br>
    <div class="container">
      <div class="row">
		
        <div class="mx-auto col-md-6 col-10 bg-white p-5">
          <center><h1 class="mb-4">Log in</h1></center>
          <form method="post" action="">
            <div class="form-group"> <input name="userid" type="text" class="form-control" placeholder="Enter ID" id="form9"> </div>
            <div class="form-group mb-3"> <input name="password" type="password" class="form-control" placeholder="Password" id="form10"> <small class="form-text text-muted text-right">
                
              </small> </div> <center><button type="submit" name="loginsubmit" class="btn btn-primary">Submit</button></center>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>