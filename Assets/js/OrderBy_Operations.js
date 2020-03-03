function OrderBy_Add_To_Preview(){
	
	var attributes=document.getElementById("orderby_attributes").value;
	var type=document.getElementById("orderby_type").value;
	var query=attributes+" "+type;
	
	var linebreak="&#13;&#10;";
	if(document.getElementById("orderby_preview_textarea").innerHTML=="")
		document.getElementById("orderby_preview_textarea").innerHTML=query;
	else
		document.getElementById("orderby_preview_textarea").innerHTML=document.getElementById("orderby_preview_textarea").innerHTML+" ,"+linebreak+query;
}

function OrderBy_setAttributes(){
	var databasename=document.getElementById("database_1").value;
	var a=[];
	if(document.getElementById("main_table").value.length!=0)
		a.push(document.getElementById("main_table").value);
	var njoins=document.getElementById("number_of_joins").value;
	for(var i=1;i<=njoins;i++){
		if(!a.includes(document.getElementById("join_"+i+"_table_1").value))
			a.push(document.getElementById("join_"+i+"_table_1").value);
		if(!a.includes(document.getElementById("join_"+i+"_table_2").value))
			a.push(document.getElementById("join_"+i+"_table_2").value);
	}
	var s=a.join(",");
	
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var res=this.responseText;
			console.log(res);
			document.getElementById("orderby_attributes").innerHTML= res;
			
		}
	};
	xmlhttp.open("GET","DML Operations/GetAll_Where_Attributes.php?database="+databasename+"&&tables="+s,true);
	xmlhttp.send();
}
function addOrderBy(ct){
	
	document.getElementById("orderby_"+ct).innerHTML="\
	<div class='col-md-3'>\
		<label class='form-label'> &nbsp; </label><br>\
		<div class='input-group'>\
			<select class='form-control' id='orderby_"+ct+"_attributes'>\
				<option></option>\
			</select>\
		</div>\
	</div>\
	<div class='col-md-2'>\
		<label class='form-label'> &nbsp; </label><br>\
		<div class='input-group'>\
			<select class='form-control' id='orderby_"+ct+"_type'>\
				<option>ASC</option>\
				<option>DESC</option>\
			</select>\
		</div>\
	</div>\
	<div class='col-md-1'>\
	  <label class='form-label'> &nbsp; </label><br>\
	  <button class='btn btn-primary' href='#' onclick='addOrderBy("+(ct+1)+")'> +</button>\
	</div>";
	
}