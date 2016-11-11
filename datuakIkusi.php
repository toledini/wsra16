<?php 

	session_start();
	//$niremysql = new mysqli("localhost","root","","quiz");
	$niremysql = new mysqli("mysql.hostinger.es","u980005360_tol","joantol","u980005360_quiz");
	
	if ($niremysql->connect_error) {
		printf("Konexio errorea: " . $niremysql->connect_error);
	}
	$eposta=$_SESSION['username'];
	$galderak = $niremysql -> query ("Select galdera, zailtasuna, gaia from galderak where eposta='$eposta'");
	$mota="galdera ikusi";
	$ordua= Date('Y-m-d H:i:s');
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	if(!$ident= $niremysql-> query("SELECT identifikazioa FROM konexioak WHERE eposta='$eposta' ORDER BY identifikazioa DESC LIMIT 1")){
					die("<p>Errore bat gertatu da: ".$niremysql -> error."</p>");
			}
			$row = mysqli_fetch_array($ident);
			$ident=intval($row['identifikazioa']);
			
			$balioa= "INSERT INTO ekintzak (konexioa, eposta, mota, ordua, ip) values ('$ident', '$eposta', '$mota','$ordua','$ip')";
			if (!$niremysql -> query($balioa)){
				die("<p>Errore bat gertatu da: ".$niremysql -> error."</p>");
			}
	$numrows = mysqli_num_rows($galderak);
	if($numrows > 0){
		
		echo "<h1> Galderen zerrenda </h1>";		
		echo "
		<table border=1>
			<tr>
				<th>Galdera</th>
				<th>Zailtasuna</th>
				<th>Gaia</th>
			</tr>";
			
		while ($row = mysqli_fetch_assoc($galderak)){
			echo "
			<tr>
				<td>".$row['galdera']."</td>
				<td>".$row['zailtasuna']."</td>
				<td>".$row['gaia']."</td>
			</tr>";
		}
		echo "</table>";
	}else{
		echo "
		<center><p>Ez duzu txertatutako galderarik.</p></center>";
	}
	
	echo "<p><a href = 'handlingQuizes.php'>Segi kudeatzen galderak.</a></p>";
	
?>