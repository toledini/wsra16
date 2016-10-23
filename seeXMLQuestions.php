<!DOCTYPE HTML>
<html>
  <head>
    <meta name="tipo_contenido" content="width=device-width, initial-scale=1" http-equiv="content-type" charset="utf-8">
	<title>ShowQuestionsXML</title>
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
		
		
	echo "<h1> Galderen zerrenda XML </h1>";
	echo '<table border=1>
	<tr>
	<th> Galdera </th>
	<th> Zailtasuna </th>
	<th> Gaia </th>
	</tr>';
	
	$fitxategi = simplexml_load_file("galderak.xml");
	foreach($fitxategi->children() as $gald){
		$zailtasun = $gald[0]['complexity'];
		$gaia = $gald[0]['subject'];
		$galdera = $gald[0] -> itemBody -> p;
		echo "<tr><td>".$galdera."</td>";
		echo "<td style= 'text-align:center'>". $zailtasun."</td>";
		echo "<td style= 'text-align:center'>". $gaia. "</td></tr>";
	}
		
	echo "
			<p><a href = 'layout.html'>Goazen hasierako orrira.</a></p>";
			
	
?>