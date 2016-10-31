<?php

	session_start();
	$niremysql = new mysqli("localhost","root","","quiz");
	//$niremysql = new mysqli("mysql.hostinger.es","u980005360_tol","joantol","u980005360_quiz");
	
	if ($niremysql->connect_error) {
		printf("Konexio errorea: " . $niremysql->connect_error);
	}

	if (isset($_POST['submit'])){
		if(!$_POST['eposta'] | !$_POST['pasahitza']){
				echo "<script type=\"text/javascript\">
			    alert('Bete ezazu eposta edo/eta pasahitza.');
				history.go(-1);
				</script>";
		}else{
			$eposta=$_POST['eposta'];
			if (!filter_var($eposta,FILTER_VALIDATE_REGEXP,
				array("options"=>array("regexp"=>"/[a-z]+[0-9]{3}@ikasle\.ehu\.(es|eus)/"))) === false) {
				echo("Epostaren formatua egokia da. <br/>");
				$pasahitza=$_POST['pasahitza'];
				if (!filter_var($pasahitza,FILTER_VALIDATE_REGEXP,
				array("options"=>array("regexp"=>"/[a-zA-Z0-9]{6,}/"))) === false) {
					echo("Pasahitzaren formatua egokia da. <br/>");
					$arg = $niremysql->query("SELECT * FROM erabiltzaile WHERE eposta='$eposta' and pasahitza='$pasahitza'");	
					$row = mysqli_num_rows( $arg );
					if($row > 0){
						$dataordua=Date('Y-m-d H:i:s');;
						$balioa = "INSERT INTO konexioak (eposta, data) VALUES ('$eposta','$dataordua')"; 
						if (!$niremysql -> query($balioa)){
							die("<p>Errorea gertatu da: ".$niremysql -> error ."</p>");
						}else{
							echo 'Konexioa zuzen sartu da';
						}
						setcookie("ErabiltzaileLog",$eposta);
						header('Location:handlingQuizes.php');
					}else{
						echo "<script type=\"text/javascript\">
						alert('Erabiltzaile hori erregistratu gabea dago.');
						history.go(-1);
						</script>";
					}
				}else{
					echo "<script type=\"text/javascript\">
					alert('Pasahitzaren formatua ez da egokia.');
					history.go(-1);
					</script>";
				} 
			}else{
				echo "<script type=\"text/javascript\">
			    alert('Epostaren formatua ez da egokia.');
				history.go(-1);
				</script>";
			}
		}
	}
?>