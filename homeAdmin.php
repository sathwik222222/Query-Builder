<?php
	session_start();
	//echo $_SESSION['userid'];
	if(!isset($_SESSION['userid'])){
		header("Location: login101QB.php");
	}else{
		echo "<p></p>";
	}
	
?>
<script>
	function adminResetDB(){
		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		} else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				
				var a = this.responseText.split(" ");
				if(a.includes("error")){
					alert("Error Occured");
				}else{
					window.location.reload();

				}
			}
		};
		
		xmlhttp.open("GET","adminResetDB.php",true);
		xmlhttp.send();
	}
</script>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="Assets/OutSource/cdnjs_cloudflare.css" type="text/css">
  <link rel="stylesheet" href="Assets/OutSource/static_pingendo.css">
</head>


<body>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand text-primary" href="#"> Query Builder </a>
      <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar5">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar5">
		<ul class="navbar-nav ml-auto">
          
          <li class="nav-item"><a class="nav-link"><b>Hello Admin</b></a> </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <li class="nav-item"> <a class="nav-link" href="logout101.php">LogOut</a> </li>
        </ul>
		
      </div>
    </div>
  </nav>
  <br><br><br>
  <p style="align:center;">
  <div class="row">
	<div class="col-md-8">
		<center>
		<table class="table table-striped table-borderless" style="overflow:scroll;width:500px;">
			
			<thead id="table_header">
				<tr>
					<th>Database</th>
					<th>Table</th>
					<th>Number of Rows</th>
				</tr>
			</thead>

			<tbody id="table_body">
				<?php
					$db=array("Student","Employee");
					for($i=0;$i<2;$i++){
						$con=mysqli_connect("localhost","root","",$db[$i]);
						$query = "SHOW TABLES FROM $db[$i]";
						$result=mysqli_query($con,$query);
						
						while ($row = mysqli_fetch_row($result)) {
							$ans="<tr>";
							$ans=$ans."<td>".$db[$i]."</td>";
							$ans=$ans."<td>".$row[0]."</td>";
							$query = "SELECT COUNT(*) FROM $row[0]";
							$result2=mysqli_query($con,$query);
							$ans=$ans."<td>";
							while ($r = mysqli_fetch_row($result2)) {
								$ans=$ans.$r[0];
							}
							$ans=$ans."</td>";
							$ans=$ans."</tr>";
							echo $ans;
							
						}
					}
				?>
			</tbody>

		</table>
		</center>
	</div>
	
	<div class="col-md-4">
		<br>
		<br>
		<br>
		<br>
		<button class="btn btn-primary" onclick="adminResetDB();">Reset DB</button>
	</div>
	
  </div>
  
  </p>
    <script src="Assets/OutSource/code_jquery.js"></script>
    <script src="Assets/OutSource/cdnjs_cloudflare_popper.js"></script>
    <script src="Assets/OutSource/stackpath_bootstrapcdn.js"></script>
	
</body>

</html>