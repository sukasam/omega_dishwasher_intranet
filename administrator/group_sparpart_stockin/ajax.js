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

function get_pro(pval,param1,param2,param3,param4){
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=getpro&pid='+pval;
   if (xmlHttp==null){
      alert ("Browser does not support HTTP Request");
      return;
   }
    xmlHttp.onreadystatechange=function (){
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){   
			var ds = xmlHttp.responseText.split("|");
            /*document.getElementById(param1).innerHTML=ds[0];
			document.getElementById(param2).innerHTML=ds[1];*/
			document.getElementById(param3).innerHTML=ds[2];
        } else{
          //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
   };
   xmlHttp.open("GET",URL,true);
   xmlHttp.send(null);
}

function calprice(prval,pid,param1){
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=getprice&pid='+pid+'&prid='+prval;
   if (xmlHttp==null){
      alert ("Browser does not support HTTP Request");
      return;
   }
    xmlHttp.onreadystatechange=function (){
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){   
		   document.getElementById(param1).innerHTML = xmlHttp.responseText;
			/*var ds = xmlHttp.responseText.split("|");
            document.getElementById(param1).innerHTML=ds[0];
			document.getElementById(param2).innerHTML=ds[1];
			document.getElementById(param3).innerHTML=ds[2];*/
        } else{
          //document.getElementById(ElementId).innerHTML="<div class='loading'> Loading..</div>" ;
        }
   };
   xmlHttp.open("GET",URL,true);
   xmlHttp.send(null);
}

function get_cus(pval,keys){
	//alert(keys);
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=getcus&pval='+pval+'&keys='+keys;
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

function get_project(pval,keys){
	//alert(keys);
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=getprojectL&pval='+pval+'&keys='+keys;
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

function get_podkey(pval,keys){
	//alert(keys);
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=getpodkey&pval='+pval+'&keys='+keys;
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


function get_sparkey(pval,keys,ccode){
	//alert(keys);
	var xmlHttp;
   xmlHttp=GetXmlHttpObject(); //Check Support Brownser
   URL = pathLocal+'ajax_return.php?action=getsparkey&pval='+pval+'&keys='+keys+'&ccode='+ccode;
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