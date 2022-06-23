<.php
	session_start();
		if ($_SESSION["auth"]!=TRUE)
			header("Location:logfail.php");
?>

<!DOCTYPE html>
<html lang="fr">
		<head>
			<link rel="stylesheet" type="text/css" href="../styles/style-RWD.css" />
			<link rel="icon" type="image/png" href="../medias/favicon.png" /> <!-- icon that you can see in the tab (with title) -->
			<title>SAÉ23 - Administration</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1" />
			<meta name="author" content="BGSS" />
			<meta name="description" content="SAÉ23" />
			<meta name="keywords" content="HTML, CSS" />
 		</head>
 		<body>
  			<header>
   
   				<!--</header mobile>--> 
   				<nav>
					<div class="dropdown">
						<button class="boutonmenuprincipal">Menu</button>
      					<div class="dropdown-child">
       						<a href="../index.html">Accueil</a>
        					<a href="./administration.html"class="selected">Administration</a>
							<a href="./Gestion.html">Gestion</a>
							<a href="./consultation.php">Consultation</a>
        					<a href="./Contact.html" >Contact</a>
        					<a href="./Mentions_légales.html"><i>Mentions légales</i></a>
	  					</div>
    				</div>
	
					<!--</header desktop>--> 
    				<ul>
              			<li><a href="../index.html">Accueil</a></li>
              			<li><a href="./Administration.html" class="selected">Administration</a></li>
						<li><a href="./Gestion.html">Gestion</a></li>
						<li><a href="./consultation.php">Consultation</a></li>
						<li><a href="./Contact.html">Contact</a></li>
             			 <li><a href="./Mentions_légales.html"><i>Mentions légales</i></a></li>
         			</ul>
        		</nav>
       			 <h1>Page Administrateur</h1>
    		</header> 
    
  			<section id="Intro">
    			<h3>Ajout du batiment réussi</h3>
 			</section>
 			
			<section>
			<!-- Insert request in function of data sent by the chosebat.php form + "dynamic" displaying of building's data-->
				<?php
					include("mysql.php");
					
					$name=$_POST['name'];
					$gest=$_POST['gest'];
					
					$request = "INSERT INTO `Batiment` (`name`,`gest`)
					VALUES('$name','$gest')";
					$result= mysqli_query($id_bd, $request)
						or die("Execution de la requete $request impossible");
					mysqli_close($id_bd);
					
					echo '<div>';
					echo "<strong>Le batiment suivant a été ajouté :</strong>";
					echo "<ul>
							<li> Nom du batiment : $name </li>
							<li> Gestionnaire du batiment : $gest </li>
					  	</ul>
					 	</div>";
				?>
			</section>
		
			<!-- Redirect to chosebat.php and chosecapteur.php -->
			<section>
				<form action="./chosebat.php" method="GET">
					<input type="submit" value="Administrer un autre batiment"/>
				</form>
			
				<form action="./chosecapteur.php" method="GET">
					<input type="submit" value="Administrer un capteur"/>
				</form>
 			</section>
 		
			<div class=fige-bottom>
				<hr>
 				<p><em> Validation de la page HTML5 - CSS3 </em></p>
				<a href="https://validator.w3.org/nu/" target="_blank"> 
				<img width="100" src="../medias/html5-validator-badge-blue.png" alt="HTML5 Valide !" /></a>

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="https://validator.w3.org/nu/?showsource=yes&doc=http%3A%2F%2Fbreard.atwebpages.com%2FSAE23%2Fstyles%2Fstyle-RWD.css" target="_blank">
				<img width="100" src="../medias/vcss-blue.gif" alt="CSS Valide !"/></a>

  				<footer>
    				<ul>
      					<li><a href="../pages/Contact.html" style="color:white;text-decoration: none;">BREARD / GARCIA / SAMITIER / SANA</a></li>
      					<li><b>SAÉ 23</b></li>
      					<li><a href="https://www.iut-blagnac.fr/fr/" style="color:white;text-decoration: none;" target="_blank">IUT de Blagnac </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
    				</ul>  
 				</footer>
  			</div>
 		</body>
</html>
