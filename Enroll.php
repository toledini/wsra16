<?php

	$niremysql = new mysqli("localhost","root","","quiz");
	
	if ($mysqli->connect_error) {
		printf("Connection failed: " . $mysqli->connect_error);
	}
	
	//besterik espezialitatea aukeratzean
	$espezialitate = $_POST['espezialitatea'];
	if ($esp == 'besterik'){
		$esp = $_POST['beste'];
		if ($esp == ''){
			$esp = "N/A";
		}
	}
	
	//argazkiren bat sartzean
	
	if($_FILES['image']['error']==0){
		$file= $_FILES['image']['tmp_name'];
		$image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
		$image_name= addslashes($_FILES['image']['name']);
	}else{
		$image=null;
		$image_name="";
	}
	
	//datuak jaso eta irakurri
	
	$izena = $_POST['eposta'];
	$abizena1 = $_POST['abizena1'];
	$abizena2 = $_POST['abizena2'];
	$posta = $_POST['eposta'];
	$pass = $_POST['pasahitza'];
	$tel = $_POST['telefonoa'];
	$interes = $_POST['interesak'];
	
	if(filter_var($posta, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>/^[a-z]+[0-9]{3}@ikasle\.ehu\.(es|eus)$/)))=== false){
		echo("Emaila ez da zuzena, EHU posta izan behar du.");
		}else if(filter_var($izena, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>/^([A-ZΑΙΝΣΪ]{1}[a-zραινσϊ]+[\s]*){1,2}$/)))=== false){
		echo("Izena ez da zuzena.");
		}else if(filter_var($abizena1, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>/^([A-ZΑΙΝΣΪ]{1}[a-zραινσϊ]+[\s]*)+$/)))=== false){
		echo("Lehen abizena ez da zuzena.");
		}else if(filter_var($abizena2, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>/^([A-ZΑΙΝΣΪ]{1}[a-zραινσϊ]+[\s]*)+$/)))=== false){
		echo("Bigarren abizena ez da zuzena.");
		}else if(filter_var($pass, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){6,}$/)))=== false){
		echo("Pasahitzak adierazitako formatua behar du: gutxienez minuskula bat, maiuskula bat, digitu bat eta karaktere espezial bat, inolako zuriunerik gabe");
		}else if(filter_var($tel, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>/^[0-9]{9}$/)))=== false){
		echo("Telefono okerra.");
		}else{
			$pass = crypt($pass, 'st');
			
			$balioa = "INSERT INTO erabiltzaile(izena,abizena1,abizena2,eposta elektronikoa,pasahitza,telefonoa,espezialitatea,interesak,irudia) VALUES ()";
			
	}
	
	
	
	

>