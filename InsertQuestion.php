<!DOCTYPE HTML>
<html>
  <head>
    <meta name="tipo_contenido" content="width=device-width, initial-scale=1" http-equiv="content-type" charset="utf-8">
	<title>Sartu</title>
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='stylesPWS/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='stylesPWS/smartphone.css' />
	<script type="text/javascript" language="JavaScript">
				function balidatu(){
			var errorea="";
			var betetzear ="";
			var frm=document.getElementById("gald");
			for(i=0;i<frm.elements.length;i++){
				if(frm.elements[i].name == "galdera" || frm.elements[i].name == "erantzuna"){
					if(frm.elements[i].value.trim()==""){
						errorea +=" | "+ frm.elements[i].name;
					}else{
						if(frm.elements[i].name == "galdera"){
							if(!checkQuestion(frm.elements[i].value.trim())){
								betetzear += " Galdera okerra: maiuskulaz hasten da eta hizkiak eta digituak onartzen dira galdera ikur batekin amaituz.\n" ;
							}
						}
						if(frm.elements[i].name == "erantzuna"){
							if(!checkAnswer(frm.elements[i].value.trim())){
								betetzear += "Erantzuna ez da egokia: hizki edota digituz osatua egon behar du.\n" ;
							}
						}
					}
				}
			}
			if(errorea!= "" || betetzear != ""){
				alert("Bete beharreko gakoak:\n\n   "  +errorea + " |\n\n Gaizki dauden elementuak:\n\n   "+betetzear+"\n");
			}else{
                ikusBalioak();
			}
		}
		
		function checkQuestion(balioa){
			expresioa = RegExp(/^([A-Z]+[a-z]*[ ]|[0-9]+)([A-z]|[a-z]+[ ]*|[-*+\/]?[0-9]+[ ]*)*\?$/);
			if(expresioa.test(balioa)){
				return true;
			}
			return false;
		}

		function checkAnswer(balioa){
			expresioa = RegExp(/^([A-Z]+[ ]*|[a-z]+[ ]*|[0-9]+[ ]*)+$/);
			if(expresioa.test(balioa)){
				return true;
			}
			return false;
		}
		
		function ikusBalioak(){
			var sAux="";
			var frm=document.getElementById("erregistro");
			for(i=0;i<frm.elements.length;i++){
				sAux +="IZENA: " + frm.elements[i].name+" ";
				sAux +="BALIOA: " + frm.elements[i].value+"\n";
			}
			alert(sAux);
		}
		
  </script>
</head>
<body>

    <h2>
      Sartu galdera:
    </h2>
    <form id="gald" name="gald" method="post" action="InsertQuestion.php" onSubmit="return balidatu()" enctype="multipart/form-data">
      Galdera(*):
	<div><textarea rows="10" cols="40" name="galdera" placeholder="Zein da hipertestuen transferentziarako protokoloa?" ></textarea><br/></div>
      Erantzuna(*):
	<div><textarea rows="10" cols="40" name="erantzuna" placeholder="HTTP" ></textarea><br/></div>
	  Zailtasuna:
	<div><select name="zailtasuna">
		<option value=" "> </option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
	</select><br/></div>
      <div><input type="submit" name="bidali" value="Bidali" />
	  <input type="reset" name="reset "value="Reset" class="btn"><br/></div>

<?php
	
	session_start();
	$niremysql = new mysqli("localhost","root","","quiz");
	//$niremysql = new mysqli("mysql.hostinger.es","u980005360_tol","joantol","u980005360_quiz");
	
	if ($niremysql->connect_error) {
		printf("Konexio errorea: " . $niremysql->connect_error);
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$galdera= $_POST["galdera"];
				$erantzuna= $_POST["erantzuna"];
				$zailtasun= $_POST["zailtasuna"];
				
	}
	
	
	$eposta=$_COOKIE["ErabiltzaileLog"];
	
	if (isset($_POST['bidali'])) {
		$balioa = "INSERT INTO galderak (eposta, galdera, erantzuna, zailtasuna) VALUES ('$eposta','$galdera','$erantzuna','$zailtasun')"; 
		if (!$niremysql -> query($balioa)){
			die("<p>Errorea gertatu da: ".$niremysql -> error ."</p>");
		}else{
			echo 'Galdera zuzen sartu da';
		}
	}else{
		echo 'Sartu datuak eta sakatu Bidali';
	}

?>

    </form>
	 <span><a href='layout.html'><img src="http://www.freeiconspng.com/uploads/icones-png-theme-home-19.png" alt="atzera" width="50" height="50" align="left"></a></span>

</body>

</html>