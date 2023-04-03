<?php
    //Start de sessie
	session_start();
?>
<!doctype html>
<html>
<head>
	<link href="CSS/base.css" rel="stylesheet" type="text/css">
	<link href="CSS/galleria.css" rel="stylesheet">
	<meta charset="UTF-8">
    <script src="../JS/jquery.js"></script>
	<script src="JS/burger.js"></script>
	<title>Galleria</title>
</head>

<body>
	
<?php

//Voeg het bestand config.php toe:
require 'config.php';

//Pak de id uit het url
$ID = $_GET['id'];

//Maak een query aan om de id te selecteren
$query = "SELECT * FROM Club_register WHERE ID = " . $ID;

//Maak de resultaat van de id werkend in mysqli
$resultaat = mysqli_query($mysqli, $query);

//Pak de array van de table uit de database
$rij = mysqli_fetch_array($resultaat);

?>
	
<header>
	<!--Zet de logo van de happy italy in de header-->
	<img src="images/logo-happyitaly.svg" alt="logo">
	
	    <!--Positioneer de burger naar de linkerkant van de navigatiebar-->
		<div class="pos">
			<div class="burger"></div>
			<div class="burger"></div>
			<div class="burger"></div>
		</div>
	
    <!--Rechtsboven komt er je profiel foto te staan met verschillende ranks-->	
	<div class="avatar">
					<?php
		//Als de gebruiker ingelogd is dan is zijn profiel foto zichbaar
		if(isset($rij['Gebruikersnaam']))
		{
			//Als de gebruiker meer dan 100 punten heeft dan is de user een capo di tutti capi
			if ($rij['Punten'] > 100) 
			{
				echo "<img src='Club Famiglia_beeldmateriaal/capo_di_tutti_capi.png' alt='associate' width='125px' height='125px' style='position: relative; left: 10%;top: 6px;'>";
			}
			//Als de gebruiker meer dan 50 punten heeft dan is de user een don
			else if ($rij['Punten'] > 50) 
			{
				echo "<img src='Club Famiglia_beeldmateriaal/don.png' alt='associate' width='125px' height='125px' style='position: relative; left: 10%;top: 6px;'>";
			}
			//Als de gebruiker meer dan 25 punten heeft dan is de user een capo
			else if ($rij['Punten'] > 25) 
			{
				echo "<img src='Club Famiglia_beeldmateriaal/capo.png' alt='associate' width='125px' height='125px' style='position: relative; left: 10%;top: 6px;'>";
			}
			//Als de gebruiker meer dan 0 punten heeft dan is de user een associate
			else if ($rij['Punten'] >= 0)
			{
				echo "<img src='Club Famiglia_beeldmateriaal/associate.png' alt='associate' width='125px' height='125px' style='position: relative; left: 10%;top: 6px;'>";
			}
		}
				  ?>
	</div>


</header>
	
		<?php
	        //Als de gebruiker niet ingelogd is dan komt de bar met daarop "Register/Login" te staan
			if(!isset($_SESSION['Gebruikersnaam']))
		{
            echo "<div class='log'>";
			echo "<a href='login.php'><p>Register/Login</p></a>";
			echo "</div>";
		}
	        //Anders staat er "Welkom gebruiker"
			else
		{
			echo "<p>Welkom " . $rij['Gebruikersnaam'] . "</p>";
		}
		?>
	
<nav>
	    <!--Als op de burger klikt dan komt er de burger zelf en links naar bepaalde pagina's -->
		<div class="pos">
			<div class="burger"></div>
			<div class="burger"></div>
			<div class="burger"></div>
		</div>
		
	<ul>
			<?php
		    //Als de gebruiker ingelogd is dan heeft hij toegang tot profiel, upload en de user kan uitloggen
			if(isset($_SESSION['Gebruikersnaam']))
		{
			echo '<a href="homepage.php?id='.$ID.'"><li>Home</li></a>';
			echo '<hr>';
			echo '<a href="lafamiglia.php?id='.$ID.'"><li>LaFamiglia</li></a>';
			echo '<hr>';
			echo '<a href="galleria.php?id='.$ID.'"><li>Galleria</li></a>';
			echo '<hr>';
			echo '<a href="upload.php?id='.$ID.'"><li>Upload</li></a>';
			echo '<hr>';
			echo '<a href="profiel.php?id='.$ID.'"><li>Profiel</li></a>';
			echo '<hr>';
			echo '<a href="loguit.php?id='.$ID.'"><li>Loguit</li></a>';
			echo '<hr>';
		}
            //Anders heb je alleen toegang tot homepage, lafamiglia en galleria
			else
		{
			echo '<a href="homepage.php"><li>Home</li></a>';
			echo '<hr>';
			echo '<a href="lafamiglia.php"><li>LaFamiglia</li></a>';
			echo '<hr>';
			echo '<a href="galleria.php"><li>Galleria</li></a>';
			echo '<hr>';
			echo '<a href="login.php"><li>Login</li></a>';
			echo '<hr>';
		}
			?>
	</ul>
</nav>
	
<main class="stretch">
	<div class="pic">
	<?php
$path = 'images/';
$files = scandir($path);
$ignore = array( 'cgi-bin', '.', '..');

//verwijder alle niet goedgekeurde files
$files = array_filter($files, function($file) use ($ignore) {return !in_array($file, $ignore);});

//haal de tijd van aanpasing van elke file
$times = array_map(function($file) use ($path) {return filemtime("$path/$file");}, $files);

//soorteer de tijd en soort van de files
array_multisort($times, SORT_DESC, SORT_NUMERIC, $files);
//begin een foreach
foreach ($files as $file) 
{
    echo '<img src="images/' . $file . '" />';
}
	?>
	</div>
</main>
	
	
<footer>
	<p>Contact:</p>
</footer>

</body>
</html>
