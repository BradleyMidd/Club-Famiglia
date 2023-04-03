<?php
//Start de sessie
session_start();
?>
<!doctype html>
<html>
	<head>
	<link href="CSS/register.css" rel="stylesheet">
	<link href="CSS/base_logged.css" rel="stylesheet">
	<meta charset="UTF-8">
    <script src="../JS/jquery.js"></script>
	<script src="JS/burger.js"></script>
	<title>register</title>
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
    <!--Rechtsboven komt er je profiel foto te staan met verschillende ranks-->
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
			
			//Pak de gegevens van de post
			$Gebruikersnaam = $_POST['user'];
			$Wachtwoord = sha1($_POST['pass']);
			$Email = $_POST['email'];
			$Adres = $_POST['adres'];
			$BS = $_POST['bs'];
			$Geboortedatum = $_POST['date'];
			
			//Maak een query om alle gegevens in te voeren op de database
			$create = "INSERT INTO Club_register (ID, Gebruikersnaam, Wachtwoord, Email, Adres, BeroepStudie, Geboortedatum, Punten, Level) VALUES (NULL, '$Gebruikersnaam', '$Wachtwoord', '$Email', '$Adres', '$BS', '$Geboortedatum', '0', '0')";
			
			//Als het query goed uitgevoerd is dan ga je naar de login pagina
			if(mysqli_query($mysqli, $create))
			{
				header("Location: https://82737.ict-lab.nl/Club-Famiglia/login.php");
			}
			
			//Anders blijf je in de registratiepagina
			else
			{
				header("Location: https://82737.ict-lab.nl/Club-Famiglia/register.php");
			}
		}
		//Als er niet op submit gedrukt wordt dan moet je je gegevens invoeren
		else
		{
		?>
		
		<fieldset>
		
			<legend>Register</legend>
				<ul>
					<form action="" method="post">
						<li><label for="Gebruikersnaam">Gebruikersnaam:</label></li>
						 <li><input type="text" name="user" placeholder="Gebruikersnaam..."></li>
						  <li><label for="Wachtwoord">Wachtwoord:</label></li>
							<li><input type="password" name="pass" placeholder="Wachtwoord..."></li>
							 <li><label for="Email">Email:</label></li>
							  <li><input type="email" name="email" placeholder="Email..."></li>
							   <li><label for="Adres">Adres:</label></li>
								<li><input type="text" name="adres" placeholder="Adres..."></li>
								  <li><label for="Beroep/Studie">Beroep/Studie:</label></li>
								 <li><input type="text" name="bs" placeholder="Beroep/Studie..."></li>
							   <li><label for="Geboortedatum:">Geboortedatum:</label></li>
							 <li><input type="date" name="date"></li>
						  <button type="submit" name="submit">Registeer</button>
		           		</form>
			    </ul>
		 </fieldset>
		
<?php
}
?>	
		</section>
		
</main>
	
	
<footer>
	<!--Hier komt u contact te staan (dus bijvoorbeeld nummer, email of social media)-->
	<p>Contact:</p>
</footer>
</body>
</html>
