// JavaScript Document
var pathLocal = "";
function GetXmlHttpObject(){
   var xmlHttp=null;
   try{
 // Firefox, Opera 8.0+, Safari
   xmlHttp=new XMLHttpRequest();
   }catch (e) {
 //Internet Explorer
      try{
         xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e){
         xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
   }
   return xmlHttp;
}

function checkfirstorder(pval,param1,param2,param3,param4,param5,param6,param7,param8,param9,param10,param11,param12,param13){
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=getcusfirsh&pid='+pval;
   if (xmlHttp==null){
      alert ("Browser does not support HTTP Request");
      return;
   }
    xmlHttp.onreadystatechange=function (){
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){   
			var ds = xmlHttp.responseText.split("|");
            document.getElementById(param1).innerHTML=ds[0];
			document.getElementById(param2).innerHTML=ds[1];
			document.getElementById(param3).innerHTML=ds[2];
			document.getElementById(param4).innerHTML=ds[3];
			document.getElementById(param5).innerHTML=ds[4];
			//document.getElementById(param6).innerHTML=ds[5];
			document.getElementById(param7).innerHTML=ds[6];
			document.getElementById(param8).innerHTML=ds[7];
			document.getElementById(param9).innerHTML=ds[8];
			document.getElementById(param10).innerHTML=ds[9];
			document.getElementById(param11).innerHTML=ds[10];
			document.getElementById(param12).innerHTML=ds[11];
			document.getElementById(param13).innerHTML=ds[12];
        } else{
          //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
   };
   xmlHttp.open("GET",URL,true);
   xmlHttp.send(null);
}

function get_podsn(pval,param1,param2,param3,fid){
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=getprodetail&pid='+pval+'&fid='+fid;
   if (xmlHttp==null){
      alert ("Browser does not support HTTP Request");
      return;
   }
    xmlHttp.onreadystatechange=function (){
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){   
			var ds = xmlHttp.responseText.split("|");
            document.getElementById(param1).innerHTML=ds[0];
			document.getElementById(param2).innerHTML=ds[1];
			document.getElementById(param3).innerHTML=ds[2];
        } else{
          //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
   };
   xmlHttp.open("GET",URL,true);
   xmlHttp.send(null);
}

function get_cus(pval){
	/*alert(pval);*/
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=getcus&pval='+pval;
   if (xmlHttp==null){
      alert ("Browser does not support HTTP Request");
      return;
   }
    xmlHttp.onreadystatechange=function (){
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){   
            document.getElementById('rscus').innerHTML = xmlHttp.responseText;
        } else{
          //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
   };
   xmlHttp.open("GET",URL,true);
   xmlHttp.send(null);
}