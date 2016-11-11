<?php

	session_start();
	$niremysql = new mysqli("localhost","root","","quiz");
	//$niremysql = new mysqli("mysql.hostinger.es","u980005360_tol","joantol","u980005360_quiz");
	
	if ($niremysql->connect_error) {
		printf("Konexio errorea: " . $niremysql->connect_error);
	}
	
	if($_SESSION['username']!= 'web000@ehu.es'){
		echo "<script type=\"text/javascript\">
			    alert('Ez zara irakaslea edo logeatu gabe sartzen saiatu zara.');
				history.go(-1);
				</script>";
	}else{

		$niremysql -> query("DELETE FROM galderak");
		
		$galderaBerriak = $_POST['berria'];
		
		unlink("galderak.xml");
		
		$xml = new DOMDocument();
		$xslt = $xml->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="seeXMLQuestions.xsl"');
		$xml->appendChild($xslt);
		
		$gald = $xml -> createElement("assessmentItems");
		$xml -> appendChild($gald);
		$xml -> save("galderak.xml");
		
		
		$kopBalioak = count($galderaBerriak);
		$kont = 0;
		
		$xml2= simplexml_load_file('galderak.xml');
		
		while($kont < $kopBalioak){
			$zenb = $galderaBerriak[$kont];
			$kont++;
			$eposta = $galderaBerriak[$kont];
			$kont++;
			$gal = $galderaBerriak[$kont];
			$kont++;
			$eran = $galderaBerriak[$kont];
			$kont++;
			$gaia = $galderaBerriak[$kont];
			$kont++;
			$zail = $galderaBerriak[$kont];
			$kont++;
			
			$txertatu = "INSERT INTO galderak (zenbakia, eposta, galdera, erantzuna, gaia, zailtasuna) VALUES ('$zenb','$eposta','$gal','$eran','$gaia','$zail')";
			$niremysql->query($txertatu);
			
					$item= $xml2-> addChild('assessmentItem');
					$item-> addAttribute('complexity',$zail);
					$item -> addAttribute ('subject',$gaia);
					$body= $item ->addChild('itemBody');
					$body->addChild('p',$gal);
					$response= $item-> addChild('correctResponse');
					$response-> addChild('value',$eran);	
		}
		$xml2 -> asXML("galderak.xml");
		header('Location:reviewingQuizes.php');
	}
?>