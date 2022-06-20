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
  		    		<h3>Sélectionnez le batiment à supprimer ou entrez en un nouveau !</h3>
 		</section>
		
 		<section>
			<fieldset>
				<legend><strong> Liste des batiments</strong> </legend> 		
				<!-- table which display every existing building data-->
				<?php
					include("mysql.php");
					$request = "SELECT * FROM `Batiment`";
					$result = mysqli_query($id_bd, $request)
						or die("Execution de la requete $request impossible");
					
	 
					echo '<table>';
					echo '<tr><th>Identifiant</th><th>Nom</th><th>Gestionnaire</th></tr>';
					while($ligne=mysqli_fetch_assoc($result))
					{
						extract($ligne);
						echo '<tr><td>N°'.$id.'</td><td>'.$name.'</td><td>'.$gest.'</td></tr>';
					}
					echo '</table>';

				?>
			</fieldset>
 		</section>
		
 		<section>
			<!-- form where you can chose between every building (displayed as "id / name")-->			
			<form action="suppbat.php" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend><strong> Supprimer un batiment</strong> </legend> 					
					<?php
						include("mysql.php");
						$request = "SELECT * FROM `Batiment`";
						$result = mysqli_query($id_bd, $request)
							or die("Execution de la requete $request impossible");
						mysqli_close($id_bd);
						echo '<div class="tab">';
						echo '<label for="id"> Id/Nom du votre Batiment à supprimer : </label>';
						echo '<select name="id">';
							
						while($ligne=mysqli_fetch_array($result))
						{
							extract($ligne);
							echo "<option value='$id'> $id / $name </option>";
							
						}
						echo 'name : ';
						echo '</select>';
						echo '</div>';
					?>

					<div class="valid">
						<input type="submit" value="Supprimer">
					</div>
				</fieldset> 
			</form>
			
			<!-- form where you can enter the name and chose the administrator of the building in order to create a new building-->			
			<form action="addbat.php" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend><strong> Ajouter un batiment</strong> </legend>
					<label for="name"> Nom du batiment </label>
					<input type="text" name="name" id="name" />
					<br />
					<?php
						include("mysql.php");
						$request = "SELECT `login` FROM `Gestionnaire`";
						$result = mysqli_query($id_bd, $request)
							or die("Execution de la requete $request impossible");
						mysqli_close($id_bd);
					
						echo '<label for="bat">Gestionnaire de votre batiment : </label>';
						echo '<select name="gest">';
						
						while($ligne=mysqli_fetch_array($result))
						{
							extract($ligne);
							echo "<option value='$login'> $login </option>";
						}
						echo '</select>';
					?>
					<div class="valid">
						<input type="submit" value="Ajouter" />
					</div>
				</fieldset>
			</form>
		</section>
		
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
  
	</body>
</html>
