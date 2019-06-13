function clock() {
   var now = new Date();
   var outStr = ("0" + now.getHours()).slice(-2)+' : '+("0" + now.getMinutes()).slice(-2);
   var outStrday = ("0" + now.getDay()).slice(-2);
   var outStrdate = ("0" + now.getDate()).slice(-2);
   var outStrmounth = ("0" + (now.getMonth()+1)).slice(-2);
   var outStryear = now.getFullYear();
   
   if(outStrday == 01){outStrday = "Monday";}
   if(outStrday == 02){outStrday = "Tuesday";}
   if(outStrday == 03){outStrday = "Wednesday";}
   if(outStrday == 04){outStrday = "Thursday";}
   if(outStrday == 05){outStrday = "Friday";}
   if(outStrday == 06){outStrday = "Saturday";}
   if(outStrday == 07){outStrday = "Sunday";}
   
   if(outStrmounth == 01){outStrmounth = "January";}
   if(outStrmounth == 02){outStrmounth = "February";}
   if(outStrmounth == 03){outStrmounth = "March";}
   if(outStrmounth == 04){outStrmounth = "April";}
   if(outStrmounth == 05){outStrmounth = "May";}
   if(outStrmounth == 06){outStrmounth = "June";}
   if(outStrmounth == 07){outStrmounth = "July";}
   if(outStrmounth == 08){outStrmounth = "August";}
   if(outStrmounth == 09){outStrmounth = "September";}
   if(outStrmounth == 10){outStrmounth = "October.";}
   if(outStrmounth == 11){outStrmounth = "November";}
   if(outStrmounth == 12){outStrmounth = "December";}
      
   document.getElementById('clockDiv').innerHTML=outStr;
   document.getElementById('dateDiv').innerHTML=outStrday +" "+ outStrdate;
   document.getElementById('yearDiv').innerHTML=outStrmounth +" "+ outStryear;
   setTimeout('clock()',1000);
}