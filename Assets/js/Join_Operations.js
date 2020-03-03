function join_load_table1(n){
	var databasename=document.getElementById("database_1").value;
	var main_table=document.getElementById("main_table").value;
	var njoins=document.getElementById("number_of_joins").value;
	if(databasename=="Select"||main_table=="Select"){
		alert("Not Selected Database / Table");
		return;
	}
	a=[];
	if(n>=1){
		a.push(document.getElementById("main_table").value);
	}
	if(n>1){
		for(var i=1;i<n;i++){
			if(!a.includes(document.getElementById("join_"+i+"_table_1").value))
				if(document.getElementById("join_"+i+"_table_1").value!="Select")
					a.push(document.getElementById("join_"+i+"_table_1").value);
			if(!a.includes(document.getElementById("join_"+i+"_table_2").value))
				if(document.getElementById("join_"+i+"_table_2").value!="Select")
					a.push(document.getElementById("join_"+i+"_table_2").value);
		}
	}
	var l=a.length;
	var s="<option selected disabled>Select</option>";
	for(var x=0;x<l;x++){
		if(a[x]=="") continue;
		console.log(a[x]);
		s=s+"<option>"+a[x]+"</option>";
	}
	var change_on_id="join_"+n+"_table_1";
	document.getElementById(change_on_id).innerHTML=s;
}
function reset_all_joins(){
	for(var i=1;i<=8;i++){
		if(document.getElementById("join_"+i+"_table_1")!=undefined){
			document.getElementById("join_"+i).innerHTML="";
		}
	}
}
function generate_join_tables(){
	reset_all_joins();
	var njoins=document.getElementById("number_of_joins").value;
	var databasename=document.getElementById("database_1").value;
	console.log(databasename,document.getElementById("main_table").value);
	if(databasename=="Select"||document.getElementById("main_table").value=="Select"){
		alert("Not Selected Database / Table");
		return;
	}
	console.log("Main Operations/Get_Tables.php?database="+databasename);
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			
			var a = this.responseText.split(" ");
			var len=a.length;
			var s="<option selected disabled>Select</option>";
			for(var i=0;i<len;i++){
				if(a[i].length==0) continue;
				s=s+"<option>"+a[i]+"</option>";
			}
			for(var i=1;i<=njoins;i++){
				document.getElementById("join_"+i).innerHTML="\
				<div class='col-md-2'>\
					<label class='form-label'>&nbsp;</label><br>\
					<select class='form-control' id='type_of_join_"+i+"'>\
						<option>LEFT JOIN</option>\
						<option>RIGHT JOIN</option>\
						<option>INNER JOIN</option>\
						<option>CROSS JOIN</option>\
					</select>\
				</div>\
				<div class='col-md-2'>\
				  <label class='form-label'>&nbsp;</label><br>\
				  <div class='input-group'>\
					<select class='form-control' id='join_"+i+"_table_1' onchange='function f1(){join_table_attributes("+i+",1);Load_All_Attributes();}f1();'>\
					</select>\
				  </div>\
				</div>\
				<div class='col-md-2'>\
				  <label class='form-label'>&nbsp;</label><br>\
				  <div class='input-group'>\
					<select class='form-control'  id='join_"+i+"_table_2'  onchange='function f1(){join_table_attributes("+i+",2);Load_All_Attributes();}f1();'>\
					  "+s+"\
					</select>\
				  </div>\
				</div>\
				<div class='col-md-2'>\
				  <label class='form-label'>&nbsp;</label><br>\
				  <div class='input-group'>\
					<select class='form-control' id='join_"+i+"_attribute_1'>\
					  <option></option>\
					</select>\
				  </div>\
				</div>\
				<div class='col-md-2'>\
				  <label class='form-label'>&nbsp;</label><br>\
				  <div class='input-group'>\
					<select class='form-control' id='join_"+i+"_attribute_2'>\
					  <option></option>\
					</select>\
				  </div>\
				</div>\
				<div class='col-md-2'>\
					<label class='form-label'>&nbsp; </label>\
					<div class='input-group'>\
						<button class='btn btn-primary' onclick='join_load_table1("+i+")'>Load</button>\
					</div>\
				</div>\
				";
			}
			
		}
	};
	
	xmlhttp.open("GET","Main Operations/Get_Tables.php?database="+databasename,true);
	xmlhttp.send();
	
}
function join_table_attributes(i,j){
	var databasename=document.getElementById("database_1").value;
	var table=document.getElementById("join_"+i+"_table_"+j).value;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			
			var a = this.responseText.split(" ");
			var len=a.length;
			var s="<option selected disabled>Select</option>";
			for(var x=0;x<len;x++){
				if(a[x].length==0) continue;
				s=s+"<option>"+a[x]+"</option>";
			}
			document.getElementById("join_"+i+"_attribute_"+j).innerHTML=s;
		}
	};
	
	xmlhttp.open("GET","Main Operations/Get_Attributes.php?database="+databasename+"&&table="+table,true);
	xmlhttp.send();
}