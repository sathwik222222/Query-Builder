<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.3.1.css">
  <script src="Assets/js/Where_Operations.js"></script>
  <script src="Assets/js/Get_Tables_Attributes.js"></script>
  <script src="Assets/js/Select_Attribute_Operations.js"></script>
  <script src="Assets/js/Run_Query.js"></script>
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
          <li class="nav-item"> <a class="nav-link" href="index.php">Select</a> </li>
          <!--<li class="nav-item"> <a class="nav-link" href="insert.php">Insert</a> </li>-->
          <li class="nav-item"> <a class="nav-link" href="update.php">Update</a> </li>
          <li class="nav-item"> <a class="nav-link" href="delete.php">Delete</a> </li>
        </ul>
		
		<!--
        <ul class="navbar-nav ml-auto">
		  <li class="nav-item"> <a class="nav-link btn btn-outline-primary navbar-btn ml-md-2" style="width:80px;" href="#">DCL</a> </li>
          <li class="nav-item"> <a class="nav-link btn btn-outline-primary navbar-btn ml-md-2" style="width:80px;" href="#">DDL</a> </li>
		  <li class="nav-item"> <a class="nav-link btn btn-outline-primary navbar-btn ml-md-2" style="width:80px;" href="#">DML</a> </li>
          <li class="nav-item"> <a class="nav-link btn btn-outline-primary navbar-btn ml-md-2" style="width:80px;" href="#">TCL</a> </li>
        </ul> <a class="btn btn-outline-primary navbar-btn ml-md-2">Contact us</a>
		-->
      </div>
    </div>
  </nav>
  <script>
	function resetEveryThing(){
		document.getElementById("where_attribute").innerHTML="";
		document.getElementById("where_type").value="Select";
		if(document.getElementById("where_attribute_2")!=undefined){
			document.getElementById("where_attribute_2").innerHTML="";
		}
		
		if(document.getElementById("where_additional")!=undefined){
			document.getElementById("where_additional").innerHTML="";
		}
		document.getElementById("where_preview_textarea").innerHTML="";
	}
	
	function Load_Attributes_Datatypes(){
		
		var a=[];
		a.push(document.getElementById("main_table").value);
		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		} else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var s=this.responseText;
				document.getElementById("hidden_attributes").value=s;
				var s1=s.split("-");
				var q="";
				for(var i=0;i<s1.length;i++){
					q=q+"<tr>";
					q=q+"<td>"+s1[i].split(":")[0].trim()+"</td>";
					q=q+"<td>"+s1[i].split(":")[1].trim()+"</td>";
					q=q+"</tr>";
				}
				document.getElementById("table_id_datatype").innerHTML=q;
			}
		};
		xmlhttp.open("GET","DML Operations/Datatype_Attributes_Js.php?database="+document.getElementById("database_1").value+"&&tables="+a.join(","),true);
		xmlhttp.send();
	}
  </script>
  <div class="py-0">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
			
          <br>
          <div class="tab-content mt-2">
            
              <div class="row">
                <div class="col-md-3">
                  <label class="form-label">Database</label>
                  <div class="input-group">
                    <select class="form-control" id="database_1" onchange="function f(){getAttributes();resetEveryThing();}f();" required="">
                      <option disabled="" selected="">Select</option>
                      <option>Student</option>
                      <option>Employee</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Table</label>
                  <div class="input-group">
                    <select class="form-control" id="main_table" required="" onchange="function f1(){resetEveryThing();Load_Attributes_Datatypes();}f1();">
                      <option></option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Display Count</label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Limit 10" id="limit_count">
                  </div>
                </div>
				<div class="col-md-3">
					<label class="form-label">&nbsp; </label><br>
					<style>
			.dd{
			  position: relative;
			  display: inline-block;
			}

			.ddc {
			  display: none;
			  position: absolute;
			  background-color: #f9f9f9;
			  min-width: 160px;
			  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			  padding: 12px 16px;
			  z-index: 1;
			}

			.dd:hover .ddc {
			  display: block;
			}
			</style>
            <a href="#" class="nav-link dd">
			<span>Datatypes</span>
			  <div class="ddc">
				<table border="1" id="table_id_datatype">
					
				</table>
			  </div>
			</a>
				</div>
              </div>
			  <br>
			
			
            
            
              <textarea disabled="" id="where_preview_textarea" class="form-control" style="margin-right:20px;background-color:#FFFFFF;" rows="3" cols="20"></textarea>
              <br>
              <button class="btn btn-primary" onclick="Where_setAttributes()">Load Attributes</button>
			  &nbsp&nbsp&nbsp
              <button class="btn btn-primary" onclick="document.getElementById('where_preview_textarea').innerHTML='';">Reset</button>
              <br>
              <br>
			  
              <div class="row" id="where_1">
                <div class="col-md-1">
                  <label class="form-label"> &nbsp; </label><br>
                  <input type="checkbox" id="where_no">&nbsp; NO </div>
                <div class="col-md-2">
                  <label class="form-label">Attributes</label>
                  <div class="input-group">
                    <select class="form-control" id="where_attribute">
                      <option></option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <label class="form-label">Arithmetic operators</label>
                  <div class="input-group">
                    <select class="form-control" id="where_arithmetic">
                      <option>&gt;</option>
                      <option>&lt;</option>
                      <option>&gt;=</option>
                      <option>&lt;=</option>
                      <option>!=</option>
                      <option>=</option>
                      <option>IN</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <label class="form-label">Type</label>
                  <div class="input-group">
                    <select class="form-control" id="where_type" onchange="Where_Type_Change(this.value)">
                      <option disabled="" selected="">Select</option>
                      <option>Custom Input</option>
                      <option>Sub Query</option>
                      <option>Attribute</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2" id="div_where_select_type">
                  <label class="form-label">&nbsp;</label>
                  <select class="form-control"></select>
                </div>
                <div class="col-md-2">
                  <label class="form-label">Logical operators</label>
                  <div class="input-group">
                    <select class="form-control" id="where_logical">
                      <option selected>Select</option>
                      <option>AND</option>
                      <option>OR</option>
                    </select>
                  </div>
                </div>
                <!--
                <div class="col-md-1" id="where_1_add_button">
                  <label class="form-label"> &nbsp; </label><br>
                  <button class="btn btn-primary" href="#" onclick="addNewWhere(2)"> +</button>
				</div>
				-->
                <div class="col-md-1" id="where_1_add_button">
                  <label class="form-label"> &nbsp; </label><br>
                  <button class="btn btn-primary" href="#" onclick="Add_To_Preview();document.getElementById('where_logical').value='Select';">GO</button>
                </div>
                <div class="col-md-12" id="where_1_query_type"></div>
              </div>
              <br>
              <div class="row" id="where_additional">
              </div>
            </div>
			
            
			
          </div>
        </div>
      </div>
	  
			
	<center>
		<div class="row" style="margin-left:180px;margin-right:180px;">
			<div class="col-md-10"> 
				<center>
					<textarea disabled="" id="get_query" class="form-control" style="position: fixed;width: 62%;bottom:10px;margin-right:20px; background-color:#FFFFFF;" rows="6" cols="20"></textarea>
				</center>
			</div>
			
			
			<div class="col-md-1"> 
				<button href="#result" class="btn btn-primary" style="position: fixed; bottom:100px;" onclick="Generate_Delete_Query()">Generate Query</button>
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
	
	<input type="text" id="hidden_attributes" hidden>
	
    <script>
		function Generate_Delete_Query(){
			document.getElementById("table_body").innerHTML="";
			var db=document.getElementById("database_1").value;
			var main_table=document.getElementById("main_table").value;
			
			if(db=="Select"){
				alert("Select Database");
				return;
			}
			if(main_table=="Select"||main_table.length==0){
				alert("Select Table");
				return;
			}
			
			var query="DELETE FROM ";
			var top_limit=document.getElementById("limit_count").value;
			
			query=query+main_table+" ";
			var where_preview=document.getElementById("where_preview_textarea").value;
			
			if(where_preview.length>0){
				where_preview=func(where_preview);
				query =query+" WHERE "+where_preview;
			}
			
			if(top_limit.length!=0){
				query=query+" LIMIT "+top_limit+" ";
			}
			
			document.getElementById("get_query").innerHTML=query;
			
		}
		
		function func(s){
			//s="WHERE city.ID>100 OR NOT city.country='IND' AND    "
			var s=s.trimEnd();
			var spl=s.split(" ");
			var len=spl.length;
			if(spl[len-1]=="AND"||spl[len-1]=="OR"){
				len--;
			}
			var x="";
			for(var i=0;i<len;i++) 
				x=x+spl[i]+" ";
			return x;
		}
	</script>
	<br><br><br><br><br><br><br><br>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </div>
</body>

</html>