<?php

	session_start();
	
	$_SESSION["login"]=$_REQUEST["login"];
	$login=$_SESSION["login"];

	$_SESSION["mdp"]=$_REQUEST["mdp"];
	$password=$_SESSION["mdp"];
	
	$_SESSION["auth"]=FALSE;
	
	$_SESSION["gest"]=$login;
	
	if(empty($login) and empty($password))
		header("Location:logfail.html");
	else
		{
		
			include ("mysql.php");
			
			$reqlogin = 'SELECT `login` FROM `Gestionnaire` WHERE login="'.$login.'"';
			$reslogin = mysqli_query($id_bd, $reqlogin)
				or die("Execution de la requête $reqlogin impossible");
				
			$reqpass = 'SELECT `password` FROM `Gestionnaire` WHERE password="'.$password.'"';
			$respass = mysqli_query($id_bd, $reqpass)
				or die("Execution de la requête $reqpass impossible");
			
			#Count the nomber of lines where password(in database) is the same as the password entered by the user, and if the result is different from 0 (=if the line exist)
			#Then redirect the user to gest.php
			if($reslogin->num_rows != 0)
				{
					if($respass-> num_rows != 0)
						{
							$_SESSION["auth"]=TRUE;
							mysqli_close($id_bd);
							header("Location:gest.php");
						}
					else
						{
							$_SESSION=array();
							session_destroy();
							unset($_SESSION);
							mysqli_close($id_bd);
							header("Location:logfail.html");
						}
				}
			else
				{
					$_SESSION=array();
					session_destroy();
					unset($_SESSION);
					mysqli_close($id_bd);
					$_SESSION["page"] = 'logingest.php';
					header("Location:logfail.html");
				}
		}	
			
?>
	
