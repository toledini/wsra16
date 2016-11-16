<!DOCTYPE html>
<html>
<head>
    <meta name="tipo_contenido" content="width=device-width, initial-scale=1" http-equiv="content-type" charset="utf-8">
	<title>berreskuratu</title>
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='stylesPWS/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='stylesPWS/smartphone.css' />
		   
		   <script>
			function galderaLortu(){
				var emaila = document.getElementById('eposta').value;
				var xhr = new XMLHttpRequest();
				xhr.open("GET","pasahitzaGaldera.php?emaila="+emaila,true);
				xhr.onreadystatechange = function(){
					if((xhr.readyState == 4) && (xhr.status == 200)){
						document.getElementById('galderaErantzuna').innerHTML = xhr.responseText;
					}
				}
				xhr.send();
			}
			
			function egiaztatuErantzuna(){
				var emaila = document.getElementById('eposta').value;
				var eran = document.getElementById('erantzuna').value;
				var xhr = new XMLHttpRequest();
				xhr.open("GET","pasahitzaErantzuna.php?emaila="+emaila+"&eran="+eran,true);
				xhr.onreadystatechange = function(){
					if((xhr.readyState == 4) && (xhr.status == 200)){
						document.getElementById('Berria').innerHTML = xhr.responseText;
					}
				}
				xhr.send();
			}
		   </script>
</head>
<body>
	<center>
		<h3>Pasahitza Berria</h3>
		<label>Eposta: </label>
		<input type ="text" id ="eposta">
		<input type="submit" class="btn" value="Bidali" onclick="galderaLortu()">
		<div id="galderaErantzuna"></div>
	</center>
	<p><a href = 'Login.html'>Atzera</a></p>
</body>
</html>