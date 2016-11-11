<?php 
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');
	
	$zerbitzari= new soap_server;
	$location = "http://websistemak2016.esy.es/myquiz/";
	//$location = "http://localhost:1234/wsra16/myquiz/";
	$zerbitzari->configureWSDL('ValidTicket',$location);
	$zerbitzari->wsdl->schemaTargetNamespace=$location;
	$zerbitzari->register('ValidTicket',array('x'=>'xsd:string'),array('z'=>'xsd:string'),$location);
	
	function ValidTicket($x){
		
		$file= fopen("tickets.txt","r");
		$ticket=trim(utf8_encode($x));
		if($file){
			while(($buffer= fgets($file))!==false){
					$check=trim(utf8_encode($buffer));
				if($ticket==$check){
					return "BAIMENDUN ERABILTZAILEA";
				}
			}
			if(!feof($file)){
				echo "fgets() funtzioak errorea eman du\n";			
			}else{
				return "BAIMENIK GABEKO ERABILTZAILEA";
			}
				$fclose($file);
		}else{
			echo "Ezin da fitxategia zabaldu.";
		}
		
	}
	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$zerbitzari->service($HTTP_RAW_POST_DATA);
?>