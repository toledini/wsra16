<?php 
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');
	$bezero=new nusoap_client('http://localhost:1234/wsra16/myquiz/ValidPassword.php?wsdl',false);
	
	if(isset($_POST['pasahitza'])){
		$pasahitza = $bezero->call('ValidPassword',array('x'=>$_POST['pasahitza']));
		if($pasahitza=="BALIOZKOA"){
			echo "BALIOZKOA";
		}else if($pasahitza=="BALIOGABEA"){
			echo "BALIOGABEA";
		}
	}
	
?>