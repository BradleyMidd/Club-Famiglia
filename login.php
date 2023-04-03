<?php
    //Start de sessie
	session_start();
?>
<!doctype html>
<html>
<head>
	<link href="CSS/login.css" rel="stylesheet">
	<link href="CSS/base_logged.css" rel="stylesheet">
	<meta charset="UTF-8">
    <script src="../JS/jquery.js"></script>
	<script src="JS/burger.js"></script>
	<title>login</title>
</head>

<body>
<header>
		
	<!--Zet de logo van de happy italy in de header-->
	<img src="images/logo-happyitaly.svg" alt="logo">
	
	    <!--Positioneer de burger naar de linkerkant van de navigatiebar-->
		<div class="pos">
			<div class="burger"></div>
			<div class="burger"></div>
			<div class="burger"></div>
		</div>

</header>
	
<nav>
	<!--Als op de burger klikt dan komt er de burger zelf en links naar bepaalde pagina's -->
	<div class="pos">
		<div class="burger"></div>
		<div class="burger"></div>
		<div class="burger"></div>
	</div>
		
    <!--Als de gebruiker niet ingelogd is dan heeft de gebruiker toegang tot homepage, lafamiglia en galleria-->
	<ul>
		<a href="homepage.php"><li>Home</li></a>
		<hr>
		<a href="lafamiglia.php"><li>LaFamiglia</li></a>
		<hr>
		<a href="galleria.php"><li>Galleria</li></a>
		<hr>
		<a href="login.php"><li>Login</li></a>
		<hr>
	</ul>
</nav>
	
<main class="stretch">
		
	<section>
		
		<?php
//Als er op submit gedrukt wordt dan voert hij de volgende code uit:
if(isset($_POST['submit']))
{
	    //Voeg het bestand config.php toe:
		require 'config.php';
		
	    //Pak de gebruikersnaam en wachtwoord van de post
		$Gebruikersnaam = $_POST['user'];
		$Wachtwoord = sha1($_POST['pass']);
		
	    //Maak een query waar gebruikersnaam en wachtwoord gelijk is aan de gebruikersnaam en wachtwoord die in de database is opgeslagen
		$account = "SELECT * FROM Club_register
		            WHERE Gebruikersnaam = '$Gebruikersnaam' 
					AND Wachtwoord = '$Wachtwoord'";
		
	    //Maak de resultaat van de id werkend in mysqli
		$resultaat = mysqli_query($mysqli, $account);
		     
	        //Controleer of het resultaat een rij heeft opgeleverd
			if(mysqli_num_rows($resultaat) > 0)
			{
				//Haal het user uit het resultaat
				$user = mysqli_fetch_array($resultaat);
                
				//Zet de gebruikersnaam in verschillende sessions
				$_SESSION['Gebruikersnaam'] = $user['Gebruikersnaam'];
				$_SESSION['Level'] = $user['Level'];
				
                //Stuur de gebruiker naar de profielpagina
				header("Location: https://82737.ict-lab.nl/Club-Famiglia/profiel.php?id={$user['ID']}");
			}

			else
			{
				//Stuur het weer terug naar de login pagina
				header("Location: https://82737.ict-lab.nl/Club-Famiglia/login.php");
			}
		
}
//Als er niet op submit gedrukt wordt dan moet je je gegevens invoeren	
else
		{
	?>
		<fieldset>
		
			<legend>Login</legend>
				<ul>
					<form action="" method="post">
						<li><label for="Gebruikersnaam">Gebruikersnaam:</label></li>
						 <li><input type="text" name="user" placeholder="Gebruikersnaam..."></li>
						  <li><label for="Wachtwoord">Wachtwoord:</label></li>
							<li><input type="password" name="pass" placeholder="Wachtwoord..."></li>
					  			<button type="submit" name="submit">Login</button>
					   </form>
					<li><a href="register.php">Geen account? Register nu!</a></li>
			     </ul>
		</fieldset>
		
	</section>
		
</main>
	
	
<footer>
	<!--Hier komt u contact te staan (dus bijvoorbeeld nummer, email of social media)-->
	<p>Contact:</p>
</footer>
<?php
}
?>
</body>
</html>
