// JavaScript Document
var xmlHttp;

function fileExt(path) {
  return path.substr(path.lastIndexOf('.') + 1).toLowerCase();
}


function trim(sString)	{
	while (sString.substring(0,1) == ' ')
		{
		sString = sString.substring(1, sString.length);
		}

	while (sString.substring(sString.length-1, sString.length) == ' ')
		{
		sString = sString.substring(0,sString.length-1);
		}
	return sString;
	}



function animate(frm){
	sec = 3;
	delay = sec*1000;
	document.getElementById("animation").style.display='block';
	setTimeout("submitform("+frm+")",delay);
	
}


function submitform(frmname){
	document.frmname.submit();
}


function IsNumeric(sText)

{
	
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;

 
   for (i = 0; i < sText.length && IsNumber == true; i++) 
      { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         IsNumber = false;
         }
      }
   return IsNumber;
   
   }
   
   
function isEMail(str) {

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

function Check_UnCheck_All(id,chk)
{
	
	if(id.checked == true){
	for (i = 0; i < chk.length; i++)
		chk[i].checked = true ;
	if(!chk.length){chk.checked = true ;}
	}
	if(id.checked == false){
	for (i = 0; i < chk.length; i++)
		chk[i].checked = false ;
		if(!chk.length){chk.checked = false ;}
	}
}




//Ajax browser check function start
function GetXmlHttpObject(){
var xmlHttp=null;
	try
	 {
	 // Firefox, Opera 8.0+, Safari
	 xmlHttp=new XMLHttpRequest();
	 }
	catch (e)
	 {
	 //Internet Explorer
		 try
		  {
		  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		  }
		 catch (e)
		  {
		  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
	 }
return xmlHttp;
}

//Ajax browser check function end
