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
    		<h3>Suppression du capteur réussie</h3>
 		</section>
		
		<!--Delete request which will delete the sensor selected in chosecapteur.php by using the id + "dynamic" displaying that the delete is a success-->
 		<section>
 			<?php
				include("mysql.php");
				
				$id=$_POST['id'];
				
				$request= "DELETE FROM `Capteur` WHERE (`id`='$id')";
				$result= mysqli_query($id_bd, $request)
					or die ("Execution de la requete $request impossible");
				mysqli_close($id_bd);
				
				echo '<div>';
				echo "<strong> Le capteur numéro $id à été supprimé </strong>";
			?>
 		</section>
		
		<!-- Redirect to chosebat.php and chosecapteur.php -->
 		<section>		
			<form action="./chosecapteur.php" method="GET">
				<input type="submit" value="Administrer un autre capteur"/>
			</form>
			<form action="./chosebat.php" method="GET">
				<input type="submit" value="Administrer un batiment"/>
			</form>
 		</section>
 		 
	<hr>
 		 <p><em> Validation de la page HTML5 - CSS3 </em></p>
			<a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fbreard.atwebpages.com%2FSA%25c3%258914%2Fpages%2FAbout_me.html" target="_blank"> 
			<img width="100" src="../médias/html5-validator-badge-blue.png" alt="HTML5 Valide !" /></a>

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="http://jigsaw.w3.org/css-validator/validator?uri=http%3A%2F%2Fbreard.atwebpages.com%2FSA%25c3%258914%2Fstyles%2Fstyle-RWD.css" target="_blank">
		<img width="100" src="../médias/vcss-blue.gif" alt="CSS Valide !"/></a>
  
  <footer>
    <ul>
      <li><a href="../pages/Contact.html" style="color:white;text-decoration: none;">BREARD / GARCIA / SAMITIER / SANA</a></li>
      <li><b>SAÉ 23</b></li>
      <li><a href="https://www.iut-blagnac.fr/fr/" style="color:white;text-decoration: none;" target="_blank">IUT de Blagnac </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
    </ul>  
  </footer>
  
 </body>
</html>
