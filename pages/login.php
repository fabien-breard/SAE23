<?php

	session_start();
	$_SESSION["login"]=$_REQUEST["login"];
	$login=$_SESSION["login"];

	$_SESSION["mdp"]=$_REQUEST["mdp"];
	$password=$_SESSION["mdp"];
	
	$_SESSION["choix"]=$_REQUEST["choix"];
	$choix=$_SESSION["choix"];
	
	$_SESSION["auth"]=FALSE;
	
	if(empty($login) and empty($password))
		header("Location:logfail.html");
	else
		{
		#If login and password aren't empty, then, compare data in database and login/password entered by the user and finally redirect him to chosecapteur.php or chosebat.php
		#in function of the data receeived by Administration.html if the login/password entered is correct
		include ("mysql.php");
		
		$reqlogin = "SELECT `login` FROM `Administration`";
		$reslogin = mysqli_query($id_bd, $reqlogin)
			or die("Execution de la requête $reqlogin impossible");
			
		$reqpass = "SELECT `password` FROM `Administration`";
		$respass = mysqli_query($id_bd, $reqpass)
			or die("Execution de la requête $reqpass impossible");
			
		$liglogin = mysqli_fetch_row($reslogin);
		$ligpass = mysqli_fetch_row($respass);
		
		if ($login==$liglogin[0] and $password==$ligpass[0])
			{
				$_SESSION["auth"]=TRUE;
				mysqli_close($id_bd);
				#header("Location:choix.html");
				echo "CHOIX=$choix";

				if ($choix=='Connexion aux capteurs')
				{
					header("Location:chosecapteur.php");
				}
				else
				{
					header("Location:chosebat.php");
				}


			}
		else
			{
				$_SESSION=array();
				session_destroy();
				unset($_SESSION);
				mysqli_close($id_bd);
				header("Location:logfail.html");
				$_SESSION["page"] = 'Gestion.html';
			}
		}
?>
	
