<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.3.1.css">
  <script src="Assets/js/Join_Operations.js"></script>
  <script src="Assets/js/Where_Operations.js"></script>
  <script src="Assets/js/OrderBy_Operations.js"></script>
  <script src="Assets/js/GroupBy_Operations.js"></script>
  <script src="Assets/js/Get_Tables_Attributes.js"></script>
  <script src="Assets/js/Select_Attribute_Operations.js"></script>
  <script src="Assets/js/Generate_Query.js"></script>
  <script src="Assets/js/Run_Query.js"></script>
  <script src="Assets/js/Having_Operations.js"></script>
</head>
<script>
	
</script>



<body>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand text-primary" href="#"> Query Builder </a>
      <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar5">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar5">
		
        <ul class="navbar-nav ml-auto">
		
          <li class="nav-item"> <a class="nav-link" href="index.php">Select</a> </li>
          <li class="nav-item"> <a class="nav-link" href="insert.php">Insert</a> </li>
          <li class="nav-item"> <a class="nav-link" href="update.php">Update</a> </li>
          <li class="nav-item"> <a class="nav-link" href="delete.php">Delete</a> </li>
          
        </ul>
		
		
      </div>
    </div>
  </nav>
  <div class="py-2">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<label class="form-label">Database</label>
				<div class="input-group">
					<select class="form-control" id="database_1" onchange="DataBaseSelectOnChange()" required="">
						<option disabled="" selected="">Select</option>
						<option>World</option>
						<option>UserDB</option>
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<label class="form-label">Table</label>
				<div class="input-group">
					<select class="form-control" id="main_table" onchange="TableSelectOnChange()" required="">
						<option></option>
					</select>
				</div>
			</div>
			<div class="col-md-3">
				
				<script>
				
					function Generate_Insert_Query(){
						var databasename=document.getElementById("database_1").value;
						var tablename=document.getElementById("main_table").value;
						console.log(databasename,tablename);
						if(databasename=="Select"||tablename=="Select"){
							alert("Not selected Database / Table");
							return;
						}
						
						if(document.getElementById("insert_type_value").checked){
							var n=parseInt(document.getElementById("nattributes").value);
							
							var query="INSERT INTO "+tablename+" VALUES ( ";
							for(var i=1;i<n;i++){
								var req="";
								
								
								//whether it contains quotes or not :: pending
								
								$x="";
								
								var type=document.getElementById("insert_value_datatype_"+i).value;
								/*
								if(type.includes("int")||type.includes("decimal")||type.includes("float")){
									
								}
								*/
								if(type.includes("char")||type.includes("text")){
									$x="'";
								}
								
								if(i!=n-1) 
									req=" , ";
								query=query+$x+document.getElementById("insert_value_"+i).value+$x+req;
							}
							query=query+" ) ";
							console.log(query);
							document.getElementById("get_query").innerHTML=query;
							
						}
						else if(document.getElementById("insert_type_select").checked){
							
						}else{
							alert("Please Fill Value fields");
							return;
						}
					}
				
					function DataBaseSelectOnChange(){
						document.getElementById("insert_type_value").checked=false;
						document.getElementById("insert_type_select").checked=false;
						document.getElementById("div_insert").innerHTML="";
						getAttributes();
					}
					function TableSelectOnChange(){
						document.getElementById("insert_type_value").checked=false;
						document.getElementById("insert_type_select").checked=false;
						document.getElementById("div_insert").innerHTML="";
					}
					
					function Insert_Value(){
						
						var databasename=document.getElementById("database_1").value;
						var tablename=document.getElementById("main_table").value;
						console.log(databasename,tablename);
						if(databasename=="Select"||tablename=="Select"){
							alert("Not selected Database / Table");
							return;
						}
						if (window.XMLHttpRequest) {
							xmlhttp = new XMLHttpRequest();
						} else {
							xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								var res=this.responseText;
								document.getElementById("div_insert").innerHTML= res;
								console.log(res);
								
							}
						};
						xmlhttp.open("GET","DML Operations/Insert_Set_Value.php?database="+databasename+"&&table="+tablename,true);
						xmlhttp.send();
					}
					function Insert_Select(){
						var databasename=document.getElementById("database_1").value;
						var tablename=document.getElementById("main_table").value;
						if(databasename=="Select"||tablename=="Select"){
							alert("Not selected Database / Table");
							return;
						}
						
						var s=window.location.href;
						var db=document.getElementById("database_1").value;
						if(s.split("?")[1]==undefined){
							window.open("index2.php?from=1&to=2&database="+db,"", "width=1300,height=650");
						}else{
							var from1=s.split("?")[1].split("&")[0].split("=")[1];
							var to=s.split("?")[1].split("&")[1].split("=")[1];
							var link1="index2.php?from="+(parseInt(from1)+1)+"&to="+(parseInt(to)+1)+"&database="+db;
							window.open(link1,"","width=1300,height=650");
						}
						
						document.getElementById("div_insert").innerHTML="\
							<div class='col-md-10'>\
								<label class='form-label'>Attributes</label>\
								<textarea class='form-control' rows='5' cols='20' id='subquery_from_abroad'></textarea>\
							</div>\
							<div class='col-md-2'>\
								<label class='form-label'>&nbsp;</label><br>\
								<button class='btn btn-primary' onclick=\"Get_SubQuery(window.location.href,'insert');\" >Get Query</button>\
							</div><br><br><br><br><br><br>\
						";
						
						console.log(databasename,tablename);
						
						
					}
				</script>
				<label class="form-label">Type</label>
				<div class="input-group" style="margin-top:3px;">
					<div class="radio">
					  <label><input type="radio" id="insert_type_value" onchange="Insert_Value()" class="radio" name="optradio"> &nbsp Value</label>
					</div>
					&nbsp&nbsp&nbsp&nbsp
					<!--
					<div class="radio">
					  <label><input type="radio" id="insert_type_select" onchange="Insert_Select()" class="radio" name="optradio"> &nbsp Select</label>
					</div>
					-->
				</div>
				
			</div>
		</div>
		<br><br>
		<div class="row" id="div_insert" style="padding:10px;">
			
		</div>
		
		
		<center>
			<div class="row">
				<div class="col-md-10"> 
					<textarea disabled="" id="get_query" class="form-control" style="position: fixed;width: 62%;bottom:10px;margin-left:20px; margin-right:20px; background-color:#FFFFFF;" rows="6" cols="20"></textarea>
				</div>
				
				<div class="col-md-1"> 
					<button href="#result" class="btn btn-primary" style="position: fixed; bottom:100px;" onclick="Generate_Insert_Query()">Generate Query</button>
					<a class="btn btn-primary" style="position: fixed; bottom:40px;width:135px;"  data-toggle="modal" data-target="#myModal" href="#result_tab" onclick="run_query();">Run Query</a>
					
				</div>
			</div>
		</center>
    </div>
	
	
	
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog modal-lg">
		
		  <div class="modal-content"  style="overflow:scroll;">
			<div class="modal-header">
			  
			  <h4 class="modal-title">Result</h4>
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<p id="loading">Loading..</p>
			  <table class="table table-striped table-borderless" style="overflow:scroll;">
					
				  <thead id="table_header">
					
				  </thead>
				  
				  <tbody id="table_body">
					
						
						
				  </tbody>
				
			  </table>
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		  </div>
		  
		</div>
	</div>
	
	
    <!--
	<div style="position: fixed;bottom: 20px;right: 100px;">
      <button href="#result" class="btn btn-primary" style="color: white;padding: 10px 20px;border-radius: 4px;border-color: #46b8da;" onclick="Generate_Query()" data-toggle="modal" data-target="#myModal">Generate Query</button>
    </div>
	-->
	<br><br><br><br><br><br><br><br>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </div>
</body>

</html>