<!DOCTYPE html>
<html lang="fr">
	<head>
		<link rel="stylesheet" type="text/css" href="../styles/style-RWD.css" />
		<link rel="icon" type="image/png" href="../medias/favicon.png" /> <!-- This is icon on browser page tab -->
		<title>SAÉ23 - Consultation</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" /> <!-- This line is used to properly handle the RWD -->
		<meta name="author" content="BGSS" />
		<meta name="description" content="SAÉ23" />
		<meta name="keywords" content="HTML, CSS" />
	</head>
	<body>
		<header>
			<!--
		</header mobile>
		-->
		<nav>
			<div class="dropdown">
				<button class="boutonmenuprincipal">Menu</button>
				<div class="dropdown-child">
					<a href="../index.html">Accueil</a>
					<a href="./Administration.html">Administration</a>
					<a href="./Gestion.html">Gestion</a>
					<a href="./consultation.php"  class="selected">Consultation</a>
					<a href="./Contact.html">Contact</a>
					<a href="./Mentions_légales.html"><i>Mentions légales</i></a>
				</div>
			</div>
			<!--
		</header desktop>
		-->
		<ul>
			<li><a href="../index.html">Accueil</a></li>
			<li><a href="./Administration.html">Administration</a></li>
			<li><a href="./Gestion.html">Gestion</a></li>
			<li><a href="./consultation.php" class="selected">Consultation</a></li>
			<li><a href="./Contact.html">Contact</a></li>
			<li>
				<a href="./Mentions_légales.html"><i>Mentions légales</i></a>
			</li>
		</ul>
	</nav>
	<h1>Espace Consultation </h1>
</header>
<section id="Intro">
	<h3>Affichage des dernières mesures de l'ensemble des capteurs</h3>
</section>

<section>

			<!-- Creation of a table displaying the name of the building and all its sensors + their latest values -->
		<?php
			include("mysql.php");
		
			$reqbat = "SELECT `name` FROM `Batiment`";
			$resbat = mysqli_query($id_bd, $reqbat);
				
			while($ligne = mysqli_fetch_array($resbat))
				{
					extract ($ligne);
					echo '<section>';
					echo "<h5>$name</h5>";
					
					
					$reqcap = "SELECT * FROM `Capteur` WHERE `bat` = '$name'";
					$rescap = mysqli_query($id_bd, $reqcap);
					
					while($lignecap = mysqli_fetch_array($rescap))
						{	
							extract($lignecap);
							echo '<div class="tableaux">';
							echo '<table>';
							echo "<caption><i><u>Capteur :</u> $name</i></caption>";
							echo '<tr><th>Date</th><th>Heure</th><th>Valeur</th></tr>';
														
							$reqmes = "SELECT * FROM `Mesure` WHERE `from` = '$name' ORDER BY `date` DESC, `hor` DESC LIMIT 1";
							$resmes = mysqli_query($id_bd, $reqmes);
							
							while($lignemes = mysqli_fetch_array($resmes))
							{
								extract($lignemes);
								include("infovalue.php");
								echo '<tr><td>'.$date.'</td><td>'.$hor.'</td><td>'.$value.' '.$unit.'</td></tr>';
							
							}
							echo '</table>';
							echo '</div>';
						}
					
				echo '</section>';			
				}
		?>

</section>



<hr>
	<p>
		<em> Validation de la page HTML5 - CSS3 </em>
	</p>
	<a href="https://validator.w3.org/nu/" target="_blank"><img width="100" src="../medias/html5-validator-badge-blue.png" alt="HTML5 Valide !" /></a>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="https://validator.w3.org/nu/?showsource=yes&doc=http%3A%2F%2Fbreard.atwebpages.com%2FSAE23%2Fstyles%2Fstyle-RWD.css" target="_blank"><img width="100" src="../medias/vcss-blue.gif" alt="CSS Valide !"/></a>
	<footer>
		<ul>
			<li><a href="../pages/Contact.html" style="color:white;text-decoration: none;">BREARD / GARCIA / SAMITIER / SANA</a></li>
			<li><b>SAÉ 23</b></li>
			<li><a href="https://www.iut-blagnac.fr/fr/" style="color:white;text-decoration: none;" target="_blank">IUT de Blagnac </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
		</ul>
	</footer>
</body>
</html>
