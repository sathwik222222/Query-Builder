<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="Assets/OutSource/cdnjs_cloudflare.css" type="text/css">
  <link rel="stylesheet" href="Assets/OutSource/static_pingendo.css">
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
	function resetEveryThing(){
		document.getElementById("number_of_joins").value="";
		document.getElementById("join_1").innerHTML="";
		try{
			for(var i=1;i<=8;i++){
					document.getElementById("join_"+i+"_table_1").innerHTML="";
					document.getElementById("join_"+i+"_table_2").innerHTML="";
			}
		}catch(e){}
		document.getElementById("attributes_preview_textarea").innerHTML="";
		document.getElementById("attrbutes_invisible").innerHTML="";
		if(document.getElementById("select_attribute_name")!=undefined)
			document.getElementById("select_attribute_name").innerHTML="";
		document.getElementById("attribute_1_set_2").innerHTML="";
		document.getElementById("attribute_1_set_3").innerHTML="";
		document.getElementById("attribute_1_set_4").innerHTML="";
		document.getElementById("where_attribute").innerHTML="";
		document.getElementById("where_type").value="Select";
		if(document.getElementById("where_attribute_2")!=undefined){
			document.getElementById("where_attribute_2").innerHTML="";
		}
		
		if(document.getElementById("where_additional")!=undefined){
			document.getElementById("where_additional").innerHTML="";
		}
		document.getElementById("where_preview_textarea").innerHTML="";
		document.getElementById("groupby_preview_textarea").innerHTML="";
		document.getElementById("groupby_attribute").innerHTML="";
		document.getElementById("having_preview_textarea").innerHTML="";
		document.getElementById("having_attribute").innerHTML="";
		if(document.getElementById("having_attribute_2")!=undefined){
			document.getElementById("having_attribute_2").innerHTML="";
		}
		document.getElementById("div_having_select_type").innerHTML="<label class='form-label'>&nbsp;</label><select class='form-control'></select>";
		document.getElementById("having_additional").innerHTML="";
		document.getElementById("orderby_preview_textarea").innerHTML="";
		document.getElementById("orderby_attributes").innerHTML="";
		
		
	}
	
	function Load_All_Attributes(){
		var databasename=document.getElementById("database_1").value;
		var main_table=document.getElementById("main_table").value;
		var njoins=document.getElementById("number_of_joins").value;
		if(databasename=="Select"||main_table=="Select"){
			alert("Not Selected Database / Table");
			return;
		}
		a=[];
		a.push(document.getElementById("main_table").value);
		
		for(var i=1;i<=njoins;i++){
			
			var j1=document.getElementById("join_"+i+"_table_1").value;
			var j2=document.getElementById("join_"+i+"_table_2").value;
			
			if((j1=="Select"||j1.length==0)||(j2=="Select"||j2.length==0)){
				continue;
			}
			
			if(!a.includes(document.getElementById("join_"+i+"_table_1").value))
				if(document.getElementById("join_"+i+"_table_1").value!="Select")
					a.push(document.getElementById("join_"+i+"_table_1").value);
			if(!a.includes(document.getElementById("join_"+i+"_table_2").value))
				if(document.getElementById("join_"+i+"_table_2").value!="Select")
					a.push(document.getElementById("join_"+i+"_table_2").value);
		}
		console.log(a);
		
		
		
		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		} else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var s=this.responseText;
				document.getElementById("select_attribute_name").innerHTML=s;
				document.getElementById("where_attribute").innerHTML=s;
				
				if(document.getElementById("where_attribute_2")!=undefined)
					document.getElementById("where_attribute_2").innerHTML=s;
				
				document.getElementById("groupby_attribute").innerHTML=s;
				document.getElementById("having_attribute").innerHTML=s;
				if(document.getElementById("having_attribute_2")!=undefined)
					document.getElementById("having_attribute_2").innerHTML=s;
				document.getElementById("orderby_attributes").innerHTML=s;
				
			}
		};
		xmlhttp.open("GET","DML Operations/GetAll_Where_Attributes.php?database="+databasename+"&&tables="+a.join(","),true);
		xmlhttp.send();
		
		Load_Attributes_Datatypes(a);
		
	}
	function Load_Attributes_Datatypes(a){
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

<body style="font-weight: bold;">
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand text-primary" href="#"> Query Builder </a>
      <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar5">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar5">
		<ul class="navbar-nav ml-auto">
          
          <li class="nav-item"> <a class="nav-link" href="index.php" style="font-size:18px;"><b>Select</b></a> </li>
          <li class="nav-item"> <a class="nav-link" href="update.php">Update</a> </li>
          <li class="nav-item"> <a class="nav-link" href="delete.php">Delete</a> </li>
		  <li class="nav-item"> <a class="nav-link" href="insert.php">Insert</a> </li>
        </ul>
		
      </div>
    </div>
  </nav>
  <div class="py-2">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="nav nav-tabs">
            <li class="nav-item"> <a id="main_tab" href="" class="active nav-link" data-toggle="tab" data-target="#tabone">Main</a> </li>
            <li class="nav-item"> <a class="nav-link" href="" data-toggle="tab" data-target="#tabtwo">Join</a> </li>
            <li class="nav-item"> <a href="" class="nav-link" data-toggle="tab" data-target="#tabthree">Select</a> </li>
            <li class="nav-item"> <a href="" class="nav-link" data-toggle="tab" data-target="#tabfour">Where</a> </li>
            <li class="nav-item"> <a href="" class="nav-link" data-toggle="tab" data-target="#tabfive">Group By</a> </li>
            <li class="nav-item"> <a href="" class="nav-link" data-toggle="tab" data-target="#tabsix">Having</a> </li>
            <li class="nav-item"> <a href="" class="nav-link" data-toggle="tab" data-target="#tabseven">Order By</a> </li>
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
            <li class="nav-item"> <a href="#" class="nav-link dd">
			<span>Datatypes</span>
			  <div class="ddc">
				<table border="1" id="table_id_datatype">
					
				</table>
			  </div>
			</a> </li>
          </ul>
          <br>
		  
		  
          <div class="tab-content mt-2">
            <div class="tab-pane fade show active" id="tabone" role="tabpanel">
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
                    <select class="form-control" id="main_table" required=""  onchange="function f(){resetEveryThing();Load_All_Attributes();}f();">
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
                  <label class="form-label">Create Table</label>
                  <div class="input-group">
                    <input type="text" class="form-control" onkeydown="" pattern="[_a-zA-Z][_a-zA-Z0-9]{0,30}" placeholder="Table Name" id="create_table">
					<script>						
						function identifier_func(event) {
							
						  /*
						  var x = event.which || event.keyCode;
						  if(!((x>=48&&x<=57)||(x>=97&&x<=122)||(x>=65&&x<=90))){
							  return false;
						  }
						  */
						}
					</script>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="tabtwo" role="tabpanel">
			  <div class="row" id="div_preview_select_attributes">
				
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label class="form-label">&nbsp;</label>
                  <div class="input-group">
                    <input type="number" class="form-control" id="number_of_joins" placeholder="Number of Joins">
                  </div>
                </div>
                <div class="col-md-1">
                  <label class="form-label"> &nbsp; </label><br>
                  <button class="btn btn-primary" href="#" onclick="generate_join_tables()"> GO </button>
                </div>
				<div class="col-md-1">
                  <label class="form-label"> &nbsp; </label><br>
                  <button class="btn btn-primary" onclick="document.getElementById('number_of_joins').value='';reset_all_joins();">Reset</button>
                </div>
				<div class="col-md-7">
					<label class="form-label"> &nbsp; </label><br>
					<p style="color:red;">*  Please use load button while selecting its own join</p>
                </div>
              </div>
              <br>
			  
              <div class="row">
				<div class="col-md-2">
					Type of Join
				</div>
				<div class="col-md-2">
					Table 1
				</div>
				<div class="col-md-2">
					Table 2
				</div>
				<div class="col-md-2">
					Table 1 Attributes
				</div>
				<div class="col-md-2">
					Table 2 Attributes
				</div>
              </div>
              <div class="row" id="join_1">
               
              </div>
              <div class="row" id="join_2"></div>
              <div class="row" id="join_3"></div>
              <div class="row" id="join_4"></div>
              <div class="row" id="join_5"></div>
              <div class="row" id="join_6"></div>
              <div class="row" id="join_7"></div>
              <div class="row" id="join_8"></div>
            </div>
            <div class="tab-pane fade" id="tabthree" role="tabpanel">
              <div class="row" id="div_preview_select_attributes">
                <textarea disabled="" id="attributes_preview_textarea" class="form-control" style="margin-left:20px;margin-right:20px;background-color:#FFFFFF;" rows="4" cols="20"></textarea>
              </div>
              <br>
              <button class="btn btn-primary" onclick="Load_Select_Attributes()">Load Attributes</button>
			  
			  &nbsp&nbsp&nbsp
              <button class="btn btn-primary" onclick="document.getElementById('attributes_preview_textarea').innerHTML='';">Reset</button>
			  
              <select id="attrbutes_invisible" style="visibility:hidden;">
              </select>
              <br><br>
              <div class="row" id="attribute_1">
                <div class="col-md-2">
                  <label class="form-label">Aggregate</label>
                  <select class="form-control" id="attribute_1_function" onchange="SetUp_Attributes()">
                    <option selected="">Select</option>
                    <option>DISTINCT</option>
                    <option>LENGTH</option>
                    <option>SUM</option>
                    <option>COUNT</option>
                    <option>UPPER</option>
                    <option>LOWER</option>
                    <option>MAX</option>
                    <option>MIN</option>
                    <option>AVG</option>
					<option>CONCAT</option>
                    <option>SUBSTRING</option>
                    
                  </select>
                </div>
                <div class="col-md-2" id="attribute_1_set_1">
                  <label class="form-label">Attributes</label>
                  <select class="form-control" id="select_attribute_name">
                    <option></option>
                  </select>
                </div>
                <div class="col-md-2" id="attribute_1_set_2"></div>
                <div class="col-md-2" id="attribute_1_set_3"></div>
                <div class="col-md-2" id="attribute_1_set_4"></div>
                <div class="col-md-2">
                  <label class="form-label"> &nbsp; </label><br>
                  <button class="btn btn-primary" onclick="function f2(){Generate_Attributes();document.getElementById('attribute_1_function').selectedIndex=0;Load_Select_Attributes();}f2();">GO</button>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="tabfour" role="tabpanel">
              <textarea disabled="" id="where_preview_textarea" class="form-control" style="margin-right:20px;background-color:#FFFFFF;" rows="4" cols="20"></textarea>
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
                  <button class="btn btn-primary" href="#" onclick="Add_To_Preview()">GO</button>
                </div>
                <div class="col-md-12" id="where_1_query_type"></div>
              </div>
              <br>
              <div class="row" id="where_additional">
              </div>
            </div>
            <div class="tab-pane fade" id="tabfive" role="tabpanel">
              <div class="row" id="div_preview_groupby">
                <textarea disabled="" id="groupby_preview_textarea" class="form-control" style="margin-left:20px;margin-right:20px;background-color:#FFFFFF;" rows="4" cols="20"></textarea>
              </div>
              <br>
              <button class="btn btn-primary" onclick="GroupBy_setAttributes()">Load Attributes</button>
			  &nbsp;&nbsp;
              <button class="btn btn-primary" onclick="document.getElementById('groupby_preview_textarea').value='';">Reset</button>
              <br><br>
              <div class="row" id="groupby_1">
                <div class="col-md-3">
                  <label class="form-label">Attribute</label>
                  <select class="form-control" id="groupby_attribute">
                  </select>
                </div>
                <div class="col-md-1">
                  <label class="form-label">&nbsp; </label><br>
                  <button class="btn btn-primary" onclick="GroupBy_Add_To_Preview()">GO</button>
                </div>
              </div>
            </div>
            
			<div class="tab-pane fade" id="tabsix" role="tabpanel">
				
				<textarea disabled="" id="having_preview_textarea" class="form-control" style="margin-right:20px;background-color:#FFFFFF;" rows="4" cols="20"></textarea>
              <br>
              <button class="btn btn-primary" onclick="Having_setAttributes()">Load Attributes</button>
			  &nbsp&nbsp&nbsp
              <button class="btn btn-primary" onclick="document.getElementById('having_preview_textarea').innerHTML='';">Reset</button>
              <br>
              <br>
              <div class="row" id="where_1">
				
                <div class="col-md-2">
                  <label class="form-label">Attributes</label>
                  <div class="input-group">
                    <select class="form-control" id="having_attribute">
                      <option></option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <label class="form-label">Arithmetic operators</label>
                  <div class="input-group">
                    <select class="form-control" id="having_arithmetic">
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
                    <select class="form-control" id="having_type" onchange="Having_Type_Change(this.value)">
                      <option disabled="" selected="">Select</option>
                      <option>Custom Input</option>
                      <option>Sub Query</option>
                      <option>Attribute</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2" id="div_having_select_type">
                  <label class="form-label">&nbsp;</label>
                  <select class="form-control"></select>
                </div>
                <div class="col-md-2">
                  <label class="form-label">Logical operators</label>
                  <div class="input-group">
                    <select class="form-control" id="having_logical">
                      <option selected>Select</option>
                      <option>AND</option>
                      <option>OR</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-1" id="having_1_add_button">
                  <label class="form-label"> &nbsp; </label><br>
                  <button class="btn btn-primary" href="#" onclick="Having_Add_To_Preview()">GO</button>
                </div>
                <div class="col-md-12" id="having_1_query_type"></div>
              </div>
              <br>
              <div class="row" id="having_additional">
              </div>
            </div>
			
			
            <div class="tab-pane fade" id="tabseven" role="tabpanel">
              <div class="row" id="div_preview_orderby">
                <textarea disabled="" id="orderby_preview_textarea" class="form-control" style="margin-left:20px;margin-right:20px;background-color:#FFFFFF;" rows="4" cols="20"></textarea>
              </div>
              <br>
              <button class="btn btn-primary" onclick="OrderBy_setAttributes()">Load Attributes</button>
			  &nbsp;&nbsp;
              <button class="btn btn-primary" onclick="document.getElementById('orderby_preview_textarea').value='';">Reset</button>
              <br><br>
              <div class="row" id="orderby_1">
                <div class="col-md-3">
                  <label class="form-label">Attributes</label>
                  <div class="input-group">
                    <select class="form-control" id="orderby_attributes">
                      <option></option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <label class="form-label">Order Type</label>
                  <div class="input-group">
                    <select class="form-control" id="orderby_type">
                      <option>ASC</option>
                      <option>DESC</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-1">
                  <label class="form-label"> &nbsp; </label><br>
                  <button class="btn btn-primary" href="#" onclick="OrderBy_Add_To_Preview()"> GO</button>
                </div>
              </div>
            </div>
			
          </div>
        </div>
      </div>
	<center>
		<div class="row">
			<div class="col-md-10"> 
				<textarea disabled="" id="get_query" class="form-control" style="position: fixed;width: 62%;bottom:10px;margin-left:20px; margin-right:20px; background-color:#FFFFFF;" rows="6" cols="20"></textarea>
			</div>
			
			<div class="col-md-1"> 
				<button href="#result" class="btn btn-primary" style="position: fixed; bottom:100px;" onclick="Generate_Query()">Generate Query</button>
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
	
    
	
	<br><br><br><br><br><br><br><br>
    <script src="Assets/OutSource/code_jquery.js"></script>
    <script src="Assets/OutSource/cdnjs_cloudflare_popper.js"></script>
    <script src="Assets/OutSource/stackpath_bootstrapcdn.js"></script>
	
  </div>
</body>

</html>