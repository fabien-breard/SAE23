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
  <link rel="icon" type="image/png" href="../medias/favicon.png" /> <!-- This is icon on browser page tab -->
  <title>SAÉ23 - Gestion</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" /> <!-- This line is used to properly handle the RWD -->
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
        <a href="./Administration.html">Administration</a>
	<a href="./Gestion.html" class="selected">Gestion</a>
	<a href="./consultation.php">Consultation</a>
        <a href="./Contact.html">Contact</a>
        <a href="./Mentions_légales.html"><i>Mentions légales</i></a>
	  </div>
    </div>
	
	<!--</header desktop>--> 
         <ul>
                <li><a href="../index.html">Accueil</a></li>
              <li><a href="./Administration.html" >Administration</a></li>
			  <li><a href="./Gestion.html" class="selected">Gestion</a></li>
			  <li><a href="./consultation.php">Consultation</a></li>
			  <li><a href="./Contact.html">Contact</a></li>
              <li><a href="./Mentions_légales.html"><i>Mentions légales</i></a></li>
         </ul>
    </nav>
    <h1> Détails d'un capteur</h1>
</header>   

				<!-- Start of PHP --> 
			<?php 
				include("mysql.php");
				$capname = $_POST["from"];
				#$type = $_POST["type"];
				$date_start = $_POST["date_start"];
				$time_start = $_POST["time_start"];
				$date_end = $_POST["date_end"];
				$time_end = $_POST["time_end"];
				echo '<section id="Intro">';
    				echo "<h3>Données du capteur <u>$capname</u> du <strong>$date_start/$time_start</strong> au <strong>$date_end/$time_end</strong></h3>";
				echo '</section>';
				echo '<section>';
				
				$reqmes = "SELECT * FROM `Mesure` WHERE `date` >= '$date_start' AND `hor` >= '$time_start' AND `date` <= '$date_end' AND `hor` <= '$time_end' AND `from` LIKE '$capname'"; 
				$resultmes = mysqli_query($id_bd, $reqmes)
					or die("Execution de la requete $resultmes impossible");
					
				if (mysqli_num_rows($resultmes))
				{ 
					#select returns results so we display a table
					$reqmes2 = "SELECT type FROM `Capteur` WHERE `name` LIKE '$capname'"; 
					$resultmes2 = mysqli_query($id_bd, $reqmes2)
						or die("Execution de la requete $resultmes2 impossible");
					
					while ($ligne_capt=mysqli_fetch_array($resultmes2))
					{
							extract($ligne_capt);
					}
					echo '<div class="tab">';
					echo '<table>';
					echo "<caption><i>Capteur de type $type </i></caption>";
					echo '<tr><th>Date</th><th>Heure</th><th>Valeur</th></tr>';
	
					while($ligne=mysqli_fetch_array($resultmes))
						{
							extract($ligne);
							include("infovalue.php");
							echo '<tr><td>'.$date.'</td><td>'.$hor.'</td><td>'.$value.' '.$unit.'</td></tr>';
						}
					echo '</table>';
					echo '<div>';
				} else
				{
				#if there are no values ​​in the array then we display a message rather than an error :)
				echo 'Aucune valeur disponible pour ce capteur';
				};
				
				#closing the database
				mysqli_close($id_bd);				
			?>
			<br>
			<form action="./gest.php" method="GET">
				<input type="submit" value="Visualiser un autre capteur"/>
			</form>

	</section>

<!-- we put a class in a "div" so that the footer touches the bottom of the screen -->
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
