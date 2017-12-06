<?php
registerUser();
function registerUser()
{	
	require "security.php";
	require "connect.php";

	$naam =  $_POST['voornaam'] . " " . $_POST['achternaam']; 
	$password = $_POST['wachtwoord'];
	$adres = $_POST['adres'];
	$postcode = $_POST['postcode'];
	$plaats = $_POST['plaats'];
	$email = $_POST['email'];

	$user_salt = generateSalt(); // Maak een salt code aan uit de security function
	$combo = $user_salt . $password; // Voeg wachtwoord toe aan salt code 
	$hashed_pwd = hash('sha512',$combo); // Encrypt wachwoord + salt code met sha512

	$connection = connect();
	$stmt = $connection->prepare("INSERT INTO gebruikers(naam, saltcode, wachtwoord, adres, postcode, plaats, email) VALUES ('$naam','$user_salt','$hashed_pwd', '$adres', '$postcode', '$plaats', '$email')");
	$stmt->execute();

	header("Location: ../login/login.php");
}

?>