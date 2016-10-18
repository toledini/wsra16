<!DOCTYPE HTML>
<html>
  <head>
    <meta name="tipo_contenido" content="width=device-width, initial-scale=1" http-equiv="content-type" charset="utf-8">
	<title>ShowQuestions</title>
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='stylesPWS/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='stylesPWS/smartphone.css' />
</head>
</html>
<?php 
	
	//$niremysql = new mysqli("localhost","root","","quiz");
	$niremysql = new mysqli("mysql.hostinger.es","u980005360_tol","joantol","u980005360_quiz");
		
	if($niremysql->connect_errno) {
		die( "Konexioan errorea gertatu da: (". 
		$niremysql->connect_errno() . ") " . 
		$niremysql->connect_error()	);
	}
		
	$hautatu = "SELECT * FROM galderak";
	$balioak = $niremysql -> query ($hautatu);
	
	$eposta=$_COOKIE["ErabiltzaileLog"];
	$mota="galdera ikusi";
	$ordua= Date('Y-m-d H:i:s');
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	
	//if($eposta!=""){
		if(!$ident= $niremysql-> query("SELECT identifikazioa FROM konexioak WHERE eposta='$eposta' ORDER BY identifikazioa DESC LIMIT 1")){
						die("<p>Errore bat gertatu da: ".$niremysql -> error."</p>");
				}
				$row = mysqli_fetch_array($ident);
				$ident=intval($row['identifikazioa']);
				
				$balioa= "INSERT INTO ekintzak (konexioa, eposta, mota, ordua, ip) values ('$ident', '$eposta', '$mota','$ordua','$ip')";
				if (!$niremysql -> query($balioa)){
					die("<p>Errore bat gertatu da: ".$niremysql -> error."</p>");
				}
		
	/*}else{
		$balioa= "INSERT INTO ekintzak (konexioa, eposta, mota, ordua, ip) values ('NULL', 'NULL', '$mota','$ordua','$ip')";
		if (!$niremysql -> query($balioa)){
			die("<p>Errore bat gertatu da: ".$niremysql -> error."</p>");
		}
	}*/
	
	/*if(!$ident= $niremysql-> query("SELECT identifikazioa FROM konexioak WHERE eposta='$eposta'")){
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
				}*/
		
	echo "<h1> Galderen zerrenda </h1>";
	echo '<table border=1>
	<tr>
	<th> Galdera </th>
	<th> Zailtasuna </th>
	</tr>';	
	
	while($ilara = mysqli_fetch_assoc($balioak)){
		if($ilara['eposta'] != "web000@ehu.es"){
			echo '<tr><td>'.$ilara['galdera'].'</td> <td>'. $ilara['zailtasuna']. '</td></tr>';
		}
	}
		
	echo "
			<p><a href = 'InsertQuestion.php'>Atzera</a></p>
			<p><a href = 'layout.html'>Goazen hasierako orrira.</a></p>";
			
	mysqli_close($niremysql);
	
?>