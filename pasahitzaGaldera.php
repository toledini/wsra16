<?php 
	
	//$niremysql = new mysqli("localhost","root","","quiz");
	$niremysql = new mysqli("mysql.hostinger.es","u980005360_tol","joantol","u980005360_quiz");
	
	if ($niremysql->connect_error) {
		printf("Konexio errorea: " . $niremysql->connect_error);
	}
		
		if(!isset($_GET['emaila']))
			echo "Ez dago ezarrita";
		$user = $_GET['emaila'];
		
		$balioak = $niremysql -> query ("SELECT galdera FROM erabiltzaile WHERE eposta = '$user'");
		while($row = mysqli_fetch_assoc($balioak)){
			echo "<br><b>".$row['galdera']."</b><br>";
			echo "<input type = 'text' id ='erantzuna'>";
			echo "<button type = 'input' onclick ='egiaztatuErantzuna()'>Bidali</button>";
			echo "<div id='Berria'></div>";
		}
?>