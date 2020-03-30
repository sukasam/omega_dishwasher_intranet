// JavaScript Document
var doc = null;
function ajax() {
	// Make a new XMLHttp object

    if (window.XMLHttpRequest) {
        try {
            doc = new XMLHttpRequest();
        } catch(e)  {}
    } else if (window.ActiveXObject) {
        try {
            doc = new ActiveXObject('Msxml2.XMLHTTP');
        } catch(e)  {
          try {
              doc = new ActiveXObject('Microsoft.XMLHTTP');
          } catch(e)  {}
        }
    }
}

function submit_upd_sequence(id_sequence,id){

		ajax();
		// Load the result from the response page
		// ** As far a I know firefox will only load a document on the SAME domain!!	
	    if (doc){
	       doc.open("GET", "./ajax_return.php?action=album_sorts&id_sequence=" + id_sequence + "&id=" + id, false);
	       doc.send(null);
	}	
}	
function submit_upd_sequence2(id_sequence,id){

		ajax();
		// Load the result from the response page
		// ** As far a I know firefox will only load a document on the SAME domain!!	
	    if (doc){
	       doc.open("GET", "./ajax_return.php?action=galary_sorts&id_sequence=" + id_sequence + "&id=" + id, false);
	       doc.send(null);
	}	
}	

