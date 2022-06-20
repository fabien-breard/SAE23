<!--start of session --> 
<?php
	session_start();
		if ($_SESSION["auth"]!=TRUE)
			header("Location:logfail.html");
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<link rel="stylesheet" type="text/css" href="../styles/style-RWD.css" />
		<link rel="icon" type="image/png" href="../medias/favicon.png" />
		<
		<!-- This is icon on browser page tab -->
		<title>SAÉ23 - Gestion</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!-- This line is used to properly handle the RWD -->
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
					<a href="./Gestion.html" class="selected">Gestion</a>
					<a href="./consultation.php">Consultation</a>
					<a href="./Contact.html">Contact</a>
					<a href="./Mentions_légales.html"><i>Mentions légales</i></a>
				</div>
			</div>
			<!--
		</header desktop>
		-->
		<ul>
			<li><a href="../index.html">Accueil</a></li>
			<li><a href="./Administration.html" >Administration</a></li>
			<li><a href="./Gestion.html" class="selected">Gestion</a></li>
			<li><a href="./consultation.php">Consultation</a></li>
			<li><a href="./Contact.html">Contact</a></li>
			<li>
				<a href="./Mentions_légales.html"><i>Mentions légales</i></a>
			</li>
		</ul>
	</nav>
	<h1> Affichage des capteurs du batiment du gestionnaire </h1>
</header>

<section id="Intro">
	<h3>Veuillez choisir un capteur </h3>
</section>

	<section>	
	
	<form action="affichegest.php" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend><strong> Capteurs dans votre batiment : </strong></legend>
			
			<!--choice of sensor to display + choice of time slice -->
			<?php
				include("mysql.php");
				
				$ugest = $_SESSION["gest"];
				
				$reqbat = 'SELECT * FROM `Batiment`';
				$resultbat = mysqli_query($id_bd, $reqbat);		
				
				while($ligne=mysqli_fetch_array($resultbat))
					{
						extract($ligne);
						if ($ugest ==  $gest)
							{
								$batname=$name;
							}
					}
				$reqcap = 'SELECT * FROM `Capteur` WHERE bat="'.$batname.'"';
				$resultcap = mysqli_query($id_bd, $reqcap)
					or die("Execution de la requete $resultcap impossible");
				mysqli_close($id_bd);
				

				$i=true;
				while($ligne2=mysqli_fetch_array($resultcap))
					{
						extract($ligne2);
						if ($i)
							{
								echo '<input type="radio" name="from" value="'.$name.'" id="'.$name.'" />';
								echo '<label for="'.$name.'">'.$name.'</label>';
								echo '<br>';
								$i=false;
							}
						else
							{
								echo '<input type="radio" name="from" value="'.$name.'" id="'.$name.'" />';
								echo '<label for="'.$name.'">'.$name.'</label>';
								echo '<br>';
							}
					}

			#initialize the end date to the current date
			date_default_timezone_set('Europe/Paris');
			$date_actual = date('d/m/y');
			?>
		</fieldset>
		<fieldset>
			<legend><strong> Plage horaire de recherche : </strong></legend>
			<label for="start">Début de recherche :</label>
			<input type="date" id="date_start" name="date_start" value="2022-06-01" min="2022-01-01" max="2024-12-31">
			<label for="start">Heure de début:</label>
			<input type="time" id="time_start" name="time_start" value="00:00">
			<br>
			<label for="start">Fin de recherche:</label>
			<input type="date" id="date_end" name="date_end" value="2022-06-30"  min="2022-01-01" max="2024-12-31">
			<label for="start">Heure de fin:</label>
			<input type="time" id="time_end" name="time_end" value="23:59">
		</fieldset>
		<p>
			<input type="submit" value="Valider" />
		</p>
	</form>
	</section>

<!-- we put a class in a "div" so that the footer touches the bottom of the screen -->
<div class=fige-bottom>
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
</div>
</body>
</html>
