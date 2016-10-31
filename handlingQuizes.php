<?php
	session_start();
?>

<!DOCTYPE HTML>

<html>
  <head>
    <meta name="tipo_contenido" content="width=device-width, initial-scale=1" http-equiv="content-type" charset="utf-8">
	<title>Handling Quizes</title>
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='stylesPWS/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='stylesPWS/smartphone.css' />
	
  <script type="text/javascript" language="Javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script type="text/javascript" language="Javascript">
  //Galderak ikusteko
	$(document).ready(function(){
		$("#ikusi").click(function(){
        $("#Ikus").load("datuakIkusi.php");
		document.getElementById('Ikus').style.visibility="visible";
		});
	});
	//Galderak txertatzeko
	$(document).ready(function(){
		$("#txertatu").click(function(){
		var gald = document.getElementById('galdera').value; 
		var eran = document.getElementById('erantzuna').value;
		var gai = document.getElementById('gaia').value;
		var zail = document.getElementById('zailtasuna').value; 
		$("#Txerta").load("galderaGehitu.php",{galdera:gald, erantzuna:eran, gaia:gai, zailtasuna:zail} );
		});
	});
	
	Objektua = new XMLHttpRequest();
	
	function galderaKop(){
		Objektua.open("POST","galderaKop.php",true);
		Objektua.onreadystatechange = function(){
			if((Objektua.readystate==4)&&(Objektua.status==200)){
				document.getElementById('kopurua').innerHTML=Objektua.responseText;
			}
		}
		Objektua.send();
	}
	setInterval(galderaKop,5000);
	
  </script>
  
</head>
<body onload="galderaKop()">

    <h2>
      QUIZen kudeaketa:
    </h2>
	
	<form>
    
      Galdera(*):
	<div><textarea rows="10" cols="40" name="galdera" id="galdera" placeholder="Zein da hipertestuen transferentziarako protokoloa?" required></textarea><br/></div>
      Erantzuna(*):
	<div><textarea rows="10" cols="40" name="erantzuna" id="erantzuna" placeholder="HTTP" required></textarea><br/></div>
	  Gaia(*):
	<div><input type="text" title="gaia" name="gaia" id="gaia" placeholder="Web Sistemak" required/><br/></div>
	  Zailtasuna:
	<div><select name="zailtasuna" id="zailtasuna">
		<option value=" "> </option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
	</select><br/></div> 
	</form>
      <div><input type="button" name="txertatu" id="txertatu" value="Galdera Txertatu" />
	  <input type="button" name="ikusi" id="ikusi" value="Galderak Ikusi" /><br/></div>
	  
	  
	  <div id="Txerta" name="Txerta">
	  </div>
	  
	  <div id="Ikus" name="Ikus" style="visibility:hidden">
	  </div>
	  
	  <div id="kopurua">
	  </div>
	  
	  <div><span><a href='ShowQuestions.php'>Galdera guztiak ikusi nahi?</a></span><br/></div>
	
	 <span><a href='layout.html'><img src="http://www.freeiconspng.com/uploads/icones-png-theme-home-19.png" alt="atzera" width="50" height="50" align="left"></a></span>

</body>

</html>