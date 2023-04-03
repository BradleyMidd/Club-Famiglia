<?php
//Start de session
session_start();
//Als de gebruiker niet ingelogd is
if($_SESSION['Gebruikersnaam'] == true)
{
	echo "";
}

else 
{
	//Stuur de gebruiker direct terug naar 'inlog.php'
	//header('location:inlog.php');
	header('Location: login.php');
}
?>