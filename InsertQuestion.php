<!DOCTYPE HTML>
<html>
  <head>
    <meta name="tipo_contenido" content="width=device-width, initial-scale=1" http-equiv="content-type" charset="utf-8">
	<title>InsertQuestion</title>
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
    <form id="gald" name="gald" method="post" action="InsertQuestion.php" onSubmit="return ikusBalioak()" enctype="multipart/form-data">
      Galdera(*):
	<div><textarea rows="10" cols="40" name="galdera" placeholder="Zein da hipertestuen transferentziarako protokoloa?" ></textarea><br/></div>
      Erantzuna(*):
	<div><textarea rows="10" cols="40" name="erantzuna" placeholder="HTTP" ></textarea><br/></div>
	  Gaia(*):
	<div><input type="text" title="gaia" name="gaia" placeholder="Web Sistemak" /><br/></div>
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
	  <div><span><a href='ShowQuestions.php'>Ikusi galderak</a></span><br/></div>
	  

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
				$gaia= $_POST["gaia"];
								
	}
	
	$eposta=$_COOKIE["ErabiltzaileLog"];
	
	if (isset($_POST['bidali'])) {
		if($galdera==""){
			echo("Galdera hutsa dago. <br/>");
		}else if($erantzuna==""){
			echo("Erantzuna hutsa dago. <br/>");
		}else if($gaia==""){
			echo("Gaia hutsa dago. <br/>");
		}else{
			$balioa = "INSERT INTO galderak (eposta, galdera, erantzuna,gaia ,zailtasuna) VALUES ('$eposta','$galdera','$erantzuna','$gaia','$zailtasun')"; 
			if (!$niremysql -> query($balioa)){
				die("<p>Errorea gertatu da: ".$niremysql -> error ."</p>");
			}else{
				echo 'Galdera zuzen sartu da ';
				echo "<br>";
			}
			if(!$ident= $niremysql-> query("SELECT identifikazioa FROM konexioak WHERE eposta='$eposta' ORDER BY identifikazioa DESC LIMIT 1")){
				die("<p>Errore bat gertatu da: ".$niremysql -> error."</p>");
			}
			$row = mysqli_fetch_array($ident);
			$ident=intval($row['identifikazioa']);
			$mota="galdera txertatu";
			$ordua= Date('Y-m-d H:i:s');
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			$balioa= "INSERT INTO ekintzak (konexioa, eposta, mota, ordua, ip) values ('$ident', '$eposta', '$mota','$ordua','$ip')";
			if (!$niremysql -> query($balioa)){
				die("<p>Errore bat gertatu da: ".$niremysql -> error."</p>");
			}else{
			
				$fitxategi= simplexml_load_file('galderak.xml');
				$item= $fitxategi->addChild('assessmentItem');
				$item->addAttribute('complexity', $zailtasun);
				$item->addAttribute('subject', $gaia);
				$body=$item->addChild('itemBody');
				$body->addChild('p', $galdera);
				$response=$item->addChild('correctResponse');
				$response->addChild('value', $erantzuna);
				if($fitxategi->asXML('galderak.xml') == 1){
					echo "Ondo txertatu da XML fitxategian.";
				}else{
					echo "Gaizki txertatu da XML fitxategian.";
				}
				
		    }
		}
	}	


?>

    </form>
	 <span><a href='layout.html'><img src="http://www.freeiconspng.com/uploads/icones-png-theme-home-19.png" alt="atzera" width="50" height="50" align="left"></a></span>

</body>

</html>