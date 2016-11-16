<?php 
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');
	//$bezero=new nusoap_client('http://websistemak2016.esy.es/myquiz/ValidTicket.php?wsdl',false);
	$bezero=new nusoap_client('http://localhost:1234/wsra16/myquiz/ValidTicket.php?wsdl',false);
	
	if(isset($_POST['tiketa'])){
		$tiketa = $bezero->call('ValidTicket',array('x'=>$_POST['tiketa']));
		if($tiketa=="BAIMENDUN ERABILTZAILEA"){
			echo "BAIMENDUN ERABILTZAILEA";
		}else if($tiketa=="BAIMENIK GABEKO ERABILTZAILEA"){
			echo "BAIMENIK GABEKO ERABILTZAILEA";
		}
	}
	
?>