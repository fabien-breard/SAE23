<?php
	#login to the database by using loign/password + using of the base SAE23
	
	$id_bd = mysqli_connect("localhost", "samitier", "azertyuiop1230", "SAE23")
		or die("Connexion au serveur/à la base de données impossible");
		
	mysqli_query($id_bd, "SET NAMES 'utf8'");

?>
