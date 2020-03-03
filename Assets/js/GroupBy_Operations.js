function GroupBy_Add_To_Preview(){
	var query=document.getElementById("groupby_attribute").value;
	
	var linebreak="&#13;&#10;";
	if(document.getElementById("groupby_preview_textarea").innerHTML=="")
		document.getElementById("groupby_preview_textarea").innerHTML=query;
	else
		document.getElementById("groupby_preview_textarea").innerHTML=document.getElementById("groupby_preview_textarea").innerHTML+" ,"+linebreak+query;
}


function GroupBy_setAttributes(){
	var databasename=document.getElementById("database_1").value;
	var a=[];
	if(document.getElementById("main_table").value.length!=0)
		a.push(document.getElementById("main_table").value);
	var njoins=document.getElementById("number_of_joins").value;
	for(var i=1;i<=njoins;i++){
		if(!(document.getElementById("join_"+i+"_table_1")&&document.getElementById("join_"+i+"_table_2")))
			console.log("Not pojible");
		if(!a.includes(document.getElementById("join_"+i+"_table_1").value))
			a.push(document.getElementById("join_"+i+"_table_1").value);
		if(!a.includes(document.getElementById("join_"+i+"_table_2").value))
			a.push(document.getElementById("join_"+i+"_table_2").value);
	}
	var s=a.join(",");
	for(var j=1;j<=8;j++){
		if(document.getElementById("where_"+j+"_attribute")){
			document.getElementById("where_"+j+"_attribute").innerHTML="";
		}else{
			break;
		}
	}
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var res=this.responseText;
			console.log(res);
			document.getElementById("groupby_attribute").innerHTML= res;
			
		}
	};
	xmlhttp.open("GET","DML Operations/GetAll_Where_Attributes.php?database="+databasename+"&&tables="+s,true);
	xmlhttp.send();
}

function addGroupBy(ct){
	
	document.getElementById("groupby_"+ct).innerHTML="\
	<div class='col-md-3'>\
		<label class='form-label'>&nbsp;</label><br>\
		<select class='form-control' id='groupby_"+ct+"_attribute'></select>\
	</div>\
	<div class='col-md-1'>\
		<label class='form-label'>&nbsp; </label><br>\
		<button class='btn btn-primary' onclick='addGroupBy("+(ct+1)+")'>+</button>\
	</div>";
}