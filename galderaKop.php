<!DOCTYPE HTML>
<html>
  <head>
    <meta name="tipo_contenido" content="width=device-width, initial-scale=1" http-equiv="content-type" charset="utf-8">
	<title>Galdera kopurua</title>
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

	session_start();
	//$niremysql = new mysqli("localhost","root","","quiz");
	$niremysql = new mysqli("mysql.hostinger.es","u980005360_tol","joantol","u980005360_quiz");
	
	if ($niremysql->connect_error) {
		printf("Konexio errorea: " . $niremysql->connect_error);
	}
	
	$eposta=$_COOKIE["ErabiltzaileLog"];
					
	$galderakDB = $niremysql -> query ("SELECT * FROM galderak");
	$rows=mysqli_num_rows($galderakDB);
	
	$galderakErab = $niremysql -> query ("SELECT * FROM galderak WHERE eposta='$eposta'");
	$rows2=mysqli_num_rows($galderakErab);
	
	echo $eposta.' erabiltzailearen galdera-kopurua / Datu-basean dauden galdera-kopurua: '.$rows2.' / '.$rows;
?>