function Generate_Query(){
	
	
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
	
	var query="SELECT ";
	var top_limit=document.getElementById("limit_count").value;
	var select_preview=document.getElementById("attributes_preview_textarea").value;
	
	if(select_preview.length==0){
		select_preview="*";
	}
	query=query+select_preview+" ";
	if(document.getElementById("create_table")==undefined){
		
	}else{
		var create_table=document.getElementById("create_table").value;
		
		if(create_table.length!=0){
			query="CREATE TABLE "+create_table+" AS "+query;
		}
	}
	if(main_table.length!=0){
		query=query+" FROM "+main_table;
	}
	
	
	var njoins=document.getElementById("number_of_joins").value;
	if(njoins>=1){
		for(var i=1;i<=njoins;i++){
			var jtype=document.getElementById("type_of_join_"+i).value;
			var jtable1=document.getElementById("join_"+i+"_table_1").value;
			var jtable2=document.getElementById("join_"+i+"_table_2").value;
			var jtable1attr=document.getElementById("join_"+i+"_attribute_1").value;
			var jtable2attr=document.getElementById("join_"+i+"_attribute_2").value;
			
			if(func1(jtable1)||func1(jtable2)||func1(jtable1attr)||func1(jtable2attr)){
				alert("Please fill the joins");
				return;
			}
			
			query= query +" "+jtype+" "+jtable2+" ON "+jtable1+"."+jtable1attr+" = "+jtable2+"."+jtable2attr+" ";
			console.log(query);
		}
	}
	var where_preview=document.getElementById("where_preview_textarea").value;
	if(where_preview.length>0){
		where_preview=func(where_preview);
		query =query+" WHERE "+where_preview;
	}
	
	
	var groupby=document.getElementById("groupby_preview_textarea").value;
	if(groupby.length!=0){
		query=query+" GROUP BY "+groupby+" ";
	}
	
	var having=document.getElementById("having_preview_textarea").value;
	
	if(having.length!=0){
		having=func(having);
		query=query+" HAVING "+having+" ";
	}
	
	
	
	
	var orderby=document.getElementById("orderby_preview_textarea").value;
	if(orderby.length!=0){
		query=query+" ORDER BY "+orderby+" ";
	}
	
	if(top_limit.length!=0){
		query=query+" LIMIT "+top_limit+" ";
	}
	
	document.getElementById("get_query").innerHTML=query;
	
	
	
}

function func1(s){
	if(s=="Select"||s.trim().length==0){
		return true;
	}
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