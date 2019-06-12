var EsAJaxhttp = false;
function EsAJax(url) {
      var today=new Date();
      var getdate=today.getTime();
      url=String(url)+String(String(url).indexOf('?')>0 ? "&" : "?")+'ranid='+ String(Math.ceil(Math.random()*getdate));
      var result;
      if (!EsAJaxhttp) {
          if (window.XMLHttpRequest)
              EsAJaxhttp = new XMLHttpRequest();
         else if (window.ActiveXObject)
             EsAJaxhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      EsAJaxhttp.open("GET", url, false);
      EsAJaxhttp.send(null);
      while (EsAJaxhttp.readyState != 4);
      result = EsAJaxhttp.responseText;
      return(result);
}

// Check Number When Keypress onkeypres
function Chk_Number() {
    e_k=event.keyCode;
    if ((e_k < 48) || (e_k > 57)){
        event.returnValue = false;
        return false;
    }
} 



