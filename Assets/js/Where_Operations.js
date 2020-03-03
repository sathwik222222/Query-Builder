function Add_To_Preview(){
	
	var query=" ";
	var no=document.getElementById("where_no").checked;
	var attribute=document.getElementById("where_attribute").value;
	var arith=document.getElementById("where_arithmetic").value;
	var type=document.getElementById("where_type").value;
	
	var logical=document.getElementById("where_logical").value;
	var prev_total=document.getElementById("where_preview_textarea").value;
	
	
	if(prev_total.length!=0){
		var l=prev_total.length;
		if(!(prev_total.substring(l-4,l).includes("AND") ||prev_total.substring(l-4,l).includes("OR"))){
			alert("Error has occured\nPlease Reset and start");
			return;
		}
	}
	
	
	if(no) query=" NOT ";
	if(attribute.length==0||type=="Select"){
		return;
	}
	
	
	if(type=="Custom Input"){
		var custom_input=document.getElementById("custom_input").value;
		if(custom_input.trim().length<1){
			alert("Please check the Custom Input");
			return;
		}
		query=query+" "+attribute+" "+arith;
		
			var hid;
			if(document.getElementById("hidden_attributes")!=undefined)
				hid=document.getElementById("hidden_attributes").value;
			console.log(hid);
			var h=hid.split("-");
			var len=h.length;
			
			for(var i=0;i<len;i++){
				//console.log(h[i],h[i].split(":")[0].trim(),attribute);
				if(h[i].split(":")[0].trim()==attribute){
					console.log(h[i]);
					var l=h[i].split(":")[1];
					if(l.includes("char")||l.includes("text")){
						custom_input="'"+custom_input+"'";
					}
				}
			}
		
		
		
		
		query=query+" "+custom_input+" ";
	}
	
	if(type=="Sub Query"){
		query=query+" "+attribute+" "+arith;
		var subquery=document.getElementById("subquery_from_abroad").value;
		console.log(subquery.length,subquery.length<10?1:0);
		if(subquery.length<10){
			alert("Please check the Sub Query");
			return;
		}
		query=query+" ("+subquery+") ";
	}
	if(type=="Attribute"){
		query=query+" "+attribute+" "+arith;
		var attribute2=document.getElementById("where_attribute_2").value;
		query=query+" "+attribute2.split(":")[0].trim()+" ";
	}
	
	if(logical!="Select"){
		query=query+" "+logical+" ";
	}
	
	var total=prev_total+query;
	document.getElementById("where_preview_textarea").innerHTML=total;
	console.log(total);
	
}

function Where_Type_Change(s){
	if(s=="Custom Input"){
		document.getElementById("div_where_select_type").innerHTML="\
		<label class='form-label'>Custom Input</label>\
		<input type='text' class='form-control' id='custom_input'>\
		";
		document.getElementById("where_additional").innerHTML="";
	}
	else if(s=="Attribute"){
		document.getElementById("div_where_select_type").innerHTML="\
		<label class='form-label'>Attributes</label>\
		<select class='form-control' id='where_attribute_2'>\
			"+document.getElementById('where_attribute').innerHTML+"\
		</select>\
		";
		document.getElementById("where_additional").innerHTML="";
	}
	else if(s=="Sub Query"){
		if(document.getElementById("database_1").value=="Select"||document.getElementById("main_table").value=="Select"||document.getElementById("where_attribute").value.length==0){
			alert("Please Select the DB/Table/Attribute");
			return;
		}
		
		document.getElementById("where_additional").innerHTML="\
			<div class='col-md-10'>\
				<label class='form-label'>Attributes</label>\
				<textarea class='form-control' rows='3' disabled cols='20' style='background-color:#FFFFFF;' id='subquery_from_abroad'></textarea>\
			</div>\
			<div class='col-md-2'>\
				<label class='form-label'>&nbsp;</label><br>\
				<button class='btn btn-primary' onclick=\"Get_SubQuery(window.location.href,'where');\">Get Query</button>\
			</div><br><br><br><br><br><br>\
		";
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
		
		
	}
}



function Where_setAttributes(){
	var databasename=document.getElementById("database_1").value;
	var a=[];
	if(document.getElementById("main_table").value.length!=0)
		a.push(document.getElementById("main_table").value);
	
	var njoins;
	if(document.getElementById("number_of_joins")!=undefined){
		njoins=document.getElementById("number_of_joins").value;
		for(var i=1;i<=njoins;i++){
			if(!a.includes(document.getElementById("join_"+i+"_table_1").value))
				a.push(document.getElementById("join_"+i+"_table_1").value);
			if(!a.includes(document.getElementById("join_"+i+"_table_2").value))
				a.push(document.getElementById("join_"+i+"_table_2").value);
		}
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
			document.getElementById("where_attribute").innerHTML= res;
			document.getElementById("where_attribute_2").innerHTML= res;
			console.log(res);
			
		}
	};
	xmlhttp.open("GET","DML Operations/GetAll_Where_Attributes.php?database="+databasename+"&&tables="+s,true);
	xmlhttp.send();
	
}
