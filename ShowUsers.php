<?php 
	
	$niremysql = new mysqli("localhost","root","","quiz");
	//$niremysql = new mysqli("mysql.hostinger.es","u980005360_tol","xdTLvMz9rW","u980005360_quiz");
		
	if($niremysql->connect_errno) {
		die( "Konexioan errorea gertatu da: (". 
		$niremysql->connect_errno() . ") " . 
		$niremysql->connect_error()	);
	}
		
	$hautatu = "SELECT * FROM erabiltzaile";
	$balioak = $niremysql -> query ($hautatu);
		
	echo "<h1> Erabiltzaileen zerrenda </h1>";
	echo '<table border=1>
	<tr>
	<th> Posta </th>
	<th> Izena </th>
	<th> Abizena1 </th>
	<th> Abizena2 </th>
	<th> Pasahitza </th>
	<th> Telefonoa </th>
	<th> Espezialitatea </th>
	<th> Interesak </th>
	</tr>';	
	
	while($ilara = mysqli_fetch_assoc($balioak)){
			if($ilara['EPOSTA'] != "web000@ehu.es"){
				echo '<tr><td>'.$ilara['EPOSTA'].'</td> <td>'. $ilara['IZENA']. '</td> <td>'. $ilara['ABIZENA1']. '</td> <td>'. $ilara['ABIZENA2']. '</td> <td>'. $ilara['PASAHITZA'].'</td> <td>'. $ilara['TELEFONOA'].'</td> <td>'. $ilara['ESPEZIALITATEA'].'</td> <td>'. $ilara['INTERESAK'].'</td></tr>';
			}
		}
		
	echo "
			<p><a href = 'layout.html'>Goazen hasierako orrira.</a></p>";
			
	mysqli_close($niremysql);
	
?>