<?php 
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');
	
	$zerbitzari= new soap_server;
	$location = "http://localhost:1234/wsra16/myquiz/";
	$zerbitzari->configureWSDL('ValidPassword',$location);
	$zerbitzari->wsdl->schemaTargetNamespace=$location;
	$zerbitzari->register('ValidPassword',array('x'=>'xsd:string'),array('z'=>'xsd:string'),$location);
	
	function ValidPassword($x){
		
		$file= fopen("toppasswords.txt","r");
		$password=trim(utf8_encode($x));
		if($file){
			while(($buffer= fgets($file))!==false){
					$check=trim(utf8_encode($buffer));
				if($password==$check){
					return "BALIOGABEA";
				}
			}
			if(!feof($file)){
				echo "fgets() funtzioak errorea eman du\n";			
			}else{
				return"BALIOZKOA";
			}
				$fclose($file);
		}else{
			echo "Ezin da fitxategia zabaldu.";
		}
		
	}
	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$zerbitzari->service($HTTP_RAW_POST_DATA);
?>