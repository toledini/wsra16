<?php

	//$niremysql = new mysqli("localhost","root","","quiz");
	$niremysql = new mysqli("mysql.hostinger.es","u980005360_tol","pmUuYUX8TL","u980005360_quiz");
	
	if ($niremysql->connect_error) {
		printf("Konexio errorea: " . $niremysql->connect_error);
	}
	
	//besterik espezialitatea aukeratzean
	$espezialitate = $_POST['espezialitatea'];
	if ($espezialitate == 'besterik'){
		$espezialitate= $_POST['beste'];
		if ($espezialitate== ''){
			$espezialitate= "N/A";
		}
	}
	
	//datuak jaso eta irakurri
	
	$izena = $_POST['izena'];
	$abizena1 = $_POST['abizena1'];
	$abizena2 = $_POST['abizena2'];
	$posta = $_POST['eposta'];
	$pass = $_POST['pasahitza'];
	$tel = $_POST['telefonoa'];
	$interes = $_POST['interesak'];
	
	if(filter_var($izena, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*){1,2}/")))=== false){
			echo "<script type=\"text/javascript\">
			    alert('Izena ez da zuzena.');
				history.go(-1);
				</script>";
		}else if(filter_var($abizena1, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+/")))=== false){
			echo "<script type=\"text/javascript\">
			    alert('Lehen abizena ez da zuzena.');
				history.go(-1);
				</script>";
		}else if(filter_var($abizena2, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+/")))=== false){
			echo "<script type=\"text/javascript\">
			    alert('Bigarren abizena ez da zuzena.');
				history.go(-1);
				</script>";	
		}else if(filter_var($posta, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/[a-z]+[0-9]{3}@ikasle\.ehu\.(es|eus)/")))=== false){
			echo "<script type=\"text/javascript\">
			    alert('Emaila ez da zuzena, EHU posta izan behar du.');
				history.go(-1);
				</script>";
		}else if(filter_var($pass, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){6,}/")))=== false){
			echo "<script type=\"text/javascript\">
			    alert('Pasahitza ez da zuzena.');
				history.go(-1);
				</script>";
		}else if(filter_var($tel, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/[0-9]{9}/")))=== false){
			echo "<script type=\"text/javascript\">
			    alert('Telefonoa ez da zuzena.');
				history.go(-1);
				</script>";
		}else{
			$pass = crypt($pass, 'st');
			
			$balioa = "INSERT INTO erabiltzaile(izena,abizena1,abizena2,eposta,pasahitza,telefonoa,espezialitatea,interesak) VALUES ('$_POST[izena]','$_POST[abizena1]','$_POST[abizena2]','$_POST[eposta]','$_POST[pasahitza]','$_POST[telefonoa]','$_POST[espezialitatea]','$_POST[interesak]')";
		
			if (!$niremysql -> query($balioa)){
				die("<p>Errore bat gertatu da: ".$niremysql -> error."</p>");
			}

			echo "
			<p>Modu egokian erregistratu zara. </p>
			<p><a href = 'ShowUsers.php'>Erabiltzaileak ikusi</a></p>";
			
	}
	mysqli_close($niremysql);
	
?>