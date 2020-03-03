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
  <script src="Assets/js/Join_Operations.js"></script>
  <script src="Assets/js/Where_Operations.js"></script>
  <script src="Assets/js/OrderBy_Operations.js"></script>
  <script src="Assets/js/GroupBy_Operations.js"></script>
  <script src="Assets/js/Get_Tables_Attributes.js"></script>
  <script src="Assets/js/Select_Attribute_Operations.js"></script>
  <script src="Assets/js/Generate_Query.js"></script>
  <script src="Assets/js/Run_Query.js"></script>
  <script src="Assets/js/Having_Operations.js"></script>
  <script src="Assets/js/Index2_Set_Missing.js"></script>
</head>
<?php 
	if(!isset($_GET["database"])){
		header("location: index.php");
	}
	$db=$_GET["database"];
	$s = "
	<script>
		window.onload=function(){Index2_setTables('".$db."');}
	</script>
	";
	echo $s;
?>
	<script>
	function resetEveryThing(){
		document.getElementById("number_of_joins").value="";
		document.getElementById("join_1").innerHTML="";
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
  </script>
<body>
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
            
          </ul>
          <br>
          <div class="tab-content mt-2">
            <div class="tab-pane fade show active" id="tabone" role="tabpanel">
              <div class="row">
                <div class="col-md-3">
                  <label class="form-label">Database</label>
                  <div class="input-group">
                    <select class="form-control" id="database_1" onchange="" <?php echo "disabled";?>>
                      <option disabled selected>Select</option>
                      <option <?php if($db=='Student') echo "selected";?>>Student</option>
                      <option <?php if($db=='Employee') echo "selected";?>>Employee</option>1
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Table</label>
                  <div class="input-group">
                    <select class="form-control" id="main_table" required="">
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
              </div>
            </div>
            <div class="tab-pane fade" id="tabtwo" role="tabpanel">
			  <div class="row" id="div_preview_select_attributes">
				<!--
                <textarea disabled="" id="join_preview_textarea" class="form-control" style="margin-left:20px;margin-right:20px;background-color:#FFFFFF;" rows="6" cols="20"></textarea>
				-->
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
              </div>
              <br>
              <div class="row" id="join_1">
                <div class="col-md-2">
                  <label class="form-label">Join Type</label>
                  <select class="form-control" id="type_of_join_1">
                    <option>LEFT JOIN</option>
                    <option>RIGHT JOIN</option>
                    <option>INNER JOIN</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <label class="form-label">Table 1</label>
                  <div class="input-group">
                    <select class="form-control" id="join_1_table_1" onchange="join_table_attributes(1,1)">
                      <option></option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <label class="form-label">Table 2</label>
                  <div class="input-group">
                    <select class="form-control" id="join_1_table_2" onchange="join_table_attributes(1,2)">
                      <option></option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <label class="form-label">Attribute 1</label>
                  <div class="input-group">
                    <select class="form-control" id="join_1_attribute_1">
                      <option></option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <label class="form-label">Attribute 2</label>
                  <div class="input-group">
                    <select class="form-control" id="join_1_attribute_2">
                      <option></option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <label class="form-label">&nbsp; </label>
                  <div class="input-group">
                    <button class="btn btn-primary" onclick="join_load_table1(1)">Load</button>
                  </div>
                </div>
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
                <textarea disabled="" id="attributes_preview_textarea" class="form-control" style="margin-left:20px;margin-right:20px;background-color:#FFFFFF;" rows="6" cols="20"></textarea>
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
                  <button class="btn btn-primary" onclick="Generate_Attributes()">GO</button>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="tabfour" role="tabpanel">
              <textarea disabled="" id="where_preview_textarea" class="form-control" style="margin-right:20px;background-color:#FFFFFF;" rows="6" cols="20"></textarea>
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
                <textarea disabled="" id="groupby_preview_textarea" class="form-control" style="margin-left:20px;margin-right:20px;background-color:#FFFFFF;" rows="6" cols="20"></textarea>
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
				
				<textarea disabled="" id="having_preview_textarea" class="form-control" style="margin-right:20px;background-color:#FFFFFF;" rows="6" cols="20"></textarea>
              <br>
              <button class="btn btn-primary" onclick="Having_setAttributes()">Load Attributes</button>
			  &nbsp&nbsp&nbsp
              <button class="btn btn-primary" onclick="document.getElementById('having_preview_textarea').innerHTML='';">Reset</button>
              <br>
              <br>
              <div class="row" id="where_1">
				<!--
                <div class="col-md-1">
                  <label class="form-label"> &nbsp; </label><br>
                  <input type="checkbox" id="having_no">&nbsp; NO 
				</div>
				-->
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
                <textarea disabled="" id="orderby_preview_textarea" class="form-control" style="margin-left:20px;margin-right:20px;background-color:#FFFFFF;" rows="6" cols="20"></textarea>
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
				<button href="#result" class="btn btn-primary" style="position: fixed; bottom:130px;" onclick="Generate_Query()">Generate Query</button>
				<a class="btn btn-primary" style="position: fixed; bottom:85px;width:135px;"  data-toggle="modal" data-target="#myModal" href="#result_tab" onclick="run_query();">Run Query</a>
				<a class="btn btn-primary" style="position: fixed; bottom:40px;width:135px;"  data-toggle="modal" data-target="#myModal" href="#result_tab" onclick="Return_Query();">Return Query</a>
				
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
	
	
  </div>
</body>

</html>