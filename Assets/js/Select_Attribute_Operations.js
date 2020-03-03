function Load_Select_Attributes(){
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
			document.getElementById("attrbutes_invisible").innerHTML=res;
			document.getElementById("attribute_1_set_1").innerHTML="\
			<label class='form-label'>Attribute;</label>\
			<select class='form-control' id='select_attribute_name'>\
				"+document.getElementById("attrbutes_invisible").innerHTML+"\
			</select>";
			
		}
	};
	xmlhttp.open("GET","DML Operations/GetAll_Where_Attributes.php?database="+databasename+"&&tables="+s,true);
	xmlhttp.send();
}

function Generate_Attributes(){
	var query="";
	var attribute_function=document.getElementById("attribute_1_function").value;
	if(attribute_function=="Select"){
		query=query+document.getElementById("select_attribute_name").value;
	}
	else if(attribute_function=="DISTINCT"||attribute_function=="SUM"||attribute_function=="MAX"||attribute_function=="MIN"||attribute_function=="AVG"||attribute_function=="COUNT"||attribute_function=="UPPER"||attribute_function=="LOWER"||attribute_function=="LENGTH"){
		query=query+attribute_function+"("+document.getElementById("select_attribute_name").value+")";
		if(document.getElementById("select_attribute_alias")!=undefined){
			if(document.getElementById("select_attribute_alias").value!=""){
				query=query+" AS "+document.getElementById("select_attribute_alias").value;
			}
		}
	}
	else if(attribute_function=="CONCAT"){
		var func=document.getElementById("attribute_1_function").value;
		var attr1=document.getElementById("select_attribute_name1").value;
		var attr2=document.getElementById("select_attribute_name2").value;
		if(document.getElementById("select_attribute_alias").value!=""){
			var alias=document.getElementById("select_attribute_alias").value;
			query=query+func+"("+attr1+","+attr2+") AS "+alias;
		}else{
			query=query+func+"("+attr1+","+attr2+")";
		}
		
	}
	else if(attribute_function=="SUBSTRING"){
		var func=document.getElementById("attribute_1_function").value;
		var attr=document.getElementById("select_attribute_name").value;
		var c_from=document.getElementById("select_attribute_from").value;
		var c_to=document.getElementById("select_attribute_to").value;
		if(c_from==""||c_to==""){
			return;
		}
		if(document.getElementById("select_attribute_alias").value!=""){
			var alias=document.getElementById("select_attribute_alias").value;
			query=query+func+"("+attr+","+c_from+","+c_to+") AS "+alias;
		}else{
			query=query+func+"("+attr+","+c_from+","+c_to+")";
		}
	}
		
	if(document.getElementById("attributes_preview_textarea").innerHTML=="")
		document.getElementById("attributes_preview_textarea").innerHTML=query;
	else
		document.getElementById("attributes_preview_textarea").innerHTML=document.getElementById("attributes_preview_textarea").value+", &#13;&#10;"+query;
	
	document.getElementById("attribute_1_set_1").innerHTML="";
	document.getElementById("attribute_1_set_2").innerHTML="";
	document.getElementById("attribute_1_set_3").innerHTML="";
	document.getElementById("attribute_1_set_4").innerHTML="";
}
function SetUp_Attributes(){
	
	var attribute_function=document.getElementById("attribute_1_function").value;
	
	if(attribute_function=="DISTINCT"||attribute_function=="SUM"||attribute_function=="MAX"||attribute_function=="MIN"||attribute_function=="AVG"||attribute_function=="COUNT"||attribute_function=="UPPER"||attribute_function=="LOWER"||attribute_function=="LENGTH"||attribute_function=="Select"){
		document.getElementById("attribute_1_set_1").innerHTML="\
			<label class='form-label'>Attributes</label>\
			<select class='form-control' id='select_attribute_name'>\
				"+document.getElementById("attrbutes_invisible").innerHTML+"\
			</select>";
		document.getElementById("attribute_1_set_2").innerHTML="\
			<label class='form-label'>Alias</label>\
			<input type='text' class='form-control' id='select_attribute_alias'>\
		";
		document.getElementById("attribute_1_set_3").innerHTML="";
		document.getElementById("attribute_1_set_4").innerHTML="";
	}
	else if(attribute_function=="SUBSTRING"){
		document.getElementById("attribute_1_set_1").innerHTML="\
			<label class='form-label'>Attributes</label>\
			<select class='form-control' id='select_attribute_name'>\
				"+document.getElementById("attrbutes_invisible").innerHTML+"\
			</select>";
		document.getElementById("attribute_1_set_2").innerHTML="\
			<label class='form-label'>From</label>\
			<input type='number' class='form-control' id='select_attribute_from'>\
		";
		document.getElementById("attribute_1_set_3").innerHTML="\
			<label class='form-label'>To</label>\
			<input type='number' class='form-control' id='select_attribute_to'>\
		";
		document.getElementById("attribute_1_set_4").innerHTML="\
			<label class='form-label'>Alias</label>\
			<input type='text' class='form-control' id='select_attribute_alias'>\
		";
		
	}
	else if(attribute_function=="CONCAT"){
		document.getElementById("attribute_1_set_1").innerHTML="\
			<label class='form-label'>Attributes</label>\
			<select class='form-control' id='select_attribute_name1'>\
				"+document.getElementById("attrbutes_invisible").innerHTML+"\
			</select>";
		document.getElementById("attribute_1_set_2").innerHTML="\
			<label class='form-label'>Attributes</label>\
			<select class='form-control' id='select_attribute_name2'>\
			"+document.getElementById("attrbutes_invisible").innerHTML+"\
			</select>\
		";
		document.getElementById("attribute_1_set_3").innerHTML="\
			<label class='form-label'>Alias</label>\
			<input type='text' class='form-control' id='select_attribute_alias'>\
		";
		document.getElementById("attribute_1_set_4").innerHTML="";
	}
}

function tables_list_menu(str){
	
  if (str == "") {
        document.getElementById("").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				
                document.getElementById(" ").innerHTML = this.responseText;
				
            }
        };
        xmlhttp.open("GET","GetTables.php?database="+str,true);
        xmlhttp.send();
    }
}