function Index2_setTables(s){
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
			document.getElementById("main_table").innerHTML=s;
			
		}
	};
	xmlhttp.open("GET","Main Operations/Get_Tables.php?database="+s,true);
	xmlhttp.send();
}