
function emailValidation_v1(vareamil){
	var s = new String(vareamil);
	if (s.length < 9) { return false; }
	if (s.indexOf("@") <1 ) { return false; } 
	if (s.indexOf(".") < 5 ) { return false; } 
	if ((s.indexOf(".") - s.indexOf("@")) < 3){ return false; }
	return true;
}

function emailcheck(str) {

		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		   return false
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   return false
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    return false
		}

		 if (str.indexOf(at,(lat+1))!=-1){
		    return false
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    return false
		 }

		 if (str.indexOf(dot,(lat+2))==-1){
		    return false
		 }
		
		 if (str.indexOf(" ")!=-1){
		    return false
		 }

 		 return true					
	}

   function trimIt(str) 
   { 
      return str.replace(/^\s+|\s+$/, '');
   }
   function validate(idToCheck)
   {
      if ( trimIt(document.getElementById(idToCheck).value) == "") {
         document.getElementById(idToCheck).focus();
         return false;
      }   
      return true;
   }
   
   function checkForValidNumber(idToCheck){
   		//alert(isNaN(trimIt(document.getElementById(idToCheck).value)));
	  	if(isNaN(trimIt(document.getElementById(idToCheck).value))){
			return false;
		}
		return true;
   
   }
   
  