function Having_Add_To_Preview(){
	
	var query=" ";
	//var no=document.getElementById("having_no").checked;
	var attribute=document.getElementById("having_attribute").value;
	var arith=document.getElementById("having_arithmetic").value;
	var type=document.getElementById("having_type").value;
	
	var logical=document.getElementById("having_logical").value;
	var prev_total=document.getElementById("having_preview_textarea").value;
	
	
	if(prev_total.length!=0){
		var l=prev_total.length;
		if(!(prev_total.substring(l-4,l).includes("AND") ||prev_total.substring(l-4,l).includes("OR"))){
			alert("Error has occured\nPlease Reset and start");
			return;
		}
	}
	
	/*
	if(no) query=" NOT ";
	if(attribute.length==0||type=="Select"){
		return;
	}
	*/
	query=query+" "+attribute+" "+arith;
	console.log(query);
	if(type=="Custom Input"){
		var custom_input=document.getElementById("having_custom_input").value;
		if(custom_input.trim().length==0){
			alert("Please check Custom Input");
			return;
		}
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
		var subquery=document.getElementById("subquery_from_abroad_having").value;
		query=query+" ("+subquery+") ";
	}
	console.log(query);
	if(type=="Attribute"){
		var attribute2=document.getElementById("having_attribute_2").value;
		query=query+" "+attribute2+" ";
	}
	
	if(logical!="Select"){
		query=query+" "+logical+" ";
	}
	
	var total=prev_total+query;
	document.getElementById("having_preview_textarea").innerHTML=total;
	console.log(total);
	
}

function Having_setAttributes(){
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
			document.getElementById("having_attribute").innerHTML= res;
			document.getElementById("having_attribute_2").innerHTML= res;
			console.log(res);
			
		}
	};
	xmlhttp.open("GET","DML Operations/GetAll_Where_Attributes.php?database="+databasename+"&&tables="+s,true);
	xmlhttp.send();
}

function Having_Type_Change(s){
	if(s=="Custom Input"){
		document.getElementById("div_having_select_type").innerHTML="\
		<label class='form-label'>Custom Input</label>\
		<input type='text' class='form-control' id='having_custom_input'>\
		";
		document.getElementById("having_additional").innerHTML="";
	}
	else if(s=="Attribute"){
		document.getElementById("div_having_select_type").innerHTML="\
		<label class='form-label'>Attributes</label>\
		<select class='form-control' id='having_attribute_2'>\
			"+document.getElementById('having_attribute').innerHTML+"\
		</select>\
		";
		document.getElementById("having_additional").innerHTML="";
	}
	else if(s=="Sub Query"){
		document.getElementById("having_additional").innerHTML="\
			<div class='col-md-10'>\
				<label class='form-label'>Attributes</label>\
				<textarea class='form-control' rows='5' cols='20' id='subquery_from_abroad_having'></textarea>\
			</div>\
			<div class='col-md-2'>\
				<label class='form-label'>&nbsp;</label><br>\
				<button class='btn btn-primary' onclick=\"Get_SubQuery(window.location.href,'having');\">Get Query</button>\
			</div>\
		";
		var s=window.location.href;
		var db=document.getElementById("database_1").value;
		if(s.split("?")[1]==undefined){
			window.open("index2.php?from=1&to=2&having=1&database="+db,"", "width=1300,height=650");
		}else{
			var from1=s.split("?")[1].split("&")[0].split("=")[1];
			var to=s.split("?")[1].split("&")[1].split("=")[1];
			var link1="index2.php?from="+(parseInt(from1)+1)+"&to="+(parseInt(to)+1)+"&having=1&database="+db;
			window.open(link1,"","width=1300,height=650");
		}		
		
	}
}