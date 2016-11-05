<?php
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');
	$bezero=new nusoap_client('http://wsjiparsar.esy.es/webZerbitzuak/egiaztatuMatrikula.php?wsdl',false);
	
	if(isset($_POST["eposta"])){
		$matrikula=$bezero->call('egiaztatuE',array('x'=>$_POST["eposta"]));
		if($matrikula=="EZ"){
			echo "EZ";
		}else{
			echo "BAI";
		}
	}

?>