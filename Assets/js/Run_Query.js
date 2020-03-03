function run_query(){
	
	
	
	
	
	
	var query=document.getElementById("get_query").value;
	var databasename=document.getElementById("database_1").value;
	if(databasename=="Select"||document.getElementById("main_table").value=="Select"){
		document.getElementById("table_body").innerHTML= "Not selected Database / Table";
		document.getElementById("loading").innerHTML= "";
		return;
	}
	
	{
		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		} else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var res=this.responseText;
				
				document.getElementById("table_body").innerHTML= res;
				document.getElementById("loading").innerHTML= "";
			}
		};
		
		xmlhttp.open("GET","DML Operations/RunQuery.php?database="+databasename+"&query="+query,true);
		xmlhttp.send();
	}
	var query="";
	var r=document.getElementById("attributes_preview_textarea").value;
	console.log(r);
	//if(documen.getElementById("get_query").value.split(" ")[0]=="SELECT"){
		if(r.trim().length>0){
			var arr=r.split(",");
			
			query=query+"<tr>";
			for(var i=0;i<arr.length;i++){
				if(arr[i].includes("AS")){
					query=query+"<th>"+arr[i].split("AS")[1]+"</th>";
				}else{
					query=query+"<th>"+arr[i]+"</th>";
				}
			}
			query=query+"</tr>";
		}else{
			var hid=document.getElementById("hidden_attributes").value;
			var xy=hid.split("-");
			query=query+" <tr>";
			for(var i=0;i<xy.length;i++){
				query=query+"<th>"+xy[i].split(":")[0]+"</th>";
			}
			query=query+" </tr>";
			
		}
	//}
	
	console.log(query);
	document.getElementById("table_header").innerHTML= query;
	
}
/*
function getAttributesNamesForRunQuery(databasename,query){
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var res=this.responseText;
			//console.log(res);
			return res;
			document.getElementById("samplex").innerHTML= res;
		}
	};
	xmlhttp.open("GET","DML Operations/GetNames.php?database="+databasename+"&query="+query,true);
	xmlhttp.send();
	
}
*/


function Return_Query(){
	var query=document.getElementById("get_query").value;
	var linking=window.location.href;
	var from_page=linking.split("?")[1].split("&")[0].split("=")[1];
	var to_page=linking.split("?")[1].split("&")[1].split("=")[1];
	
	console.log(from_page);
	console.log(to_page);
	
	if(linking.includes("having")){
		if(document.getElementById("get_query").value.length>0){
			
			if (window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
			} else {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					window.close();
				}
			};
			xmlhttp.open("GET","Return_Query.php?having=1&query="+query+"&to1="+to_page+"&from1="+from_page,true);
			xmlhttp.send();
			
			
		}else{
			alert("Please Re-Check");
		}
	}else{
		if(document.getElementById("get_query").value.length>0){
			if (window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
			} else {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					window.close();
				}
			};
			xmlhttp.open("GET","Return_Query.php?query="+query+"&to1="+to_page+"&from1="+from_page,true);
			xmlhttp.send();
			
		}else{
			alert("Please Re-Check");
		}
	}
	
	
	
}




function Get_SubQuery(linking,type){
	console.log(linking);
	var from_page=0,to_page=0;
	if(linking.includes("to")){
		to_page=linking.split("?")[1].split("&")[0].split("=")[1]+1;
		from_page=linking.split("?")[1].split("&")[1].split("=")[1]+1;
		
	}else{
		from_page=2;
		to_page=1;
	}
	console.log(from_page,to_page,type);
	console.log("localhost/QB/Get_Query.php?username=user&to1="+to_page+"&from1="+from_page+"&type="+type);
	
	
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange = function() {
		
		if (this.readyState == 4 && this.status == 200) {
			var res=this.responseText;
			console.log(res);
			
			if(type=="having")
				document.getElementById("subquery_from_abroad_having").innerHTML=res;
			else
				document.getElementById("subquery_from_abroad").innerHTML=res;
		}
	};
	xmlhttp.open("GET","Get_Query.php?username=user&to1="+to_page+"&from1="+from_page+"&type="+type,true);
	xmlhttp.send();
	
}