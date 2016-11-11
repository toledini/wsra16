<!DOCTYPE HTML>
<html>
  <head>
    <meta name="tipo_contenido" content="width=device-width, initial-scale=1" http-equiv="content-type" charset="utf-8">
	<title>reviewingQuizes</title>
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
	$niremysql = new mysqli("localhost","root","","quiz");
	//$niremysql = new mysqli("mysql.hostinger.es","u980005360_tol","joantol","u980005360_quiz");
	
	if ($niremysql->connect_error) {
		printf("Konexio errorea: " . $niremysql->connect_error);
	}
	
	$galderak = $niremysql->query("SELECT * FROM galderak");
	
?>
<html>
<body>
	<center>
		<form method="post" action="treatQuestions.php">
			<table>
				<tr>
					<th>Identifikazioa</th>
					<th>Galdera</th>
					<th>Erantzuna</th>
					<th>Konplexutasuna</th>
					<th>Egilea</th>
					<th>Gaia</th>
				</tr>
				<?php
					$kopurua = 0;
					while($ilara = mysqli_fetch_array($galderak)){
						echo "
						<tr>
							<td><input type='number' name='berria[]' value= '".$ilara['zenbakia']."' readonly></td>
							<td><input type='text' name ='berria[]' value = '".$ilara['eposta']."'readonly></td>
							<td><textarea name ='berria[]' required>".$ilara['galdera']."</textarea></td>
							<td><textarea name ='berria[]' required>".$ilara['erantzuna']."</textarea></td>
							<td><input type='text' value='".$ilara['gaia']."' name ='berria[]'></td>
							<td><input type='number' min = 0 max = 5 value ='".$ilara['zailtasuna']."' name ='berria[]'></td>
						</tr>";
					}
				?>
			</table><br/>
			<button type="submit">Gorde aldaketak</button>
		</form>
	</center>
	<span><a href='layout.html'><img src="http://www.freeiconspng.com/uploads/icones-png-theme-home-19.png" alt="atzera" width="50" height="50" align="left"></a></span>	
</body>
</html>

