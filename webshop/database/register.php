<?php
require "security.php";
require "connect.php";

// Moeten we registreren of checken op bestaande klant
if(isset($_GET['register']))
{
	if($_GET['register'] == 1)
	{
		checkUser();
	}
	else if($_GET['register'] == 2)
	{
		registerUser();
	}
	else if($_GET['register'] == 3)
	{
		updateGuest();
	}
}
else if(isset($_GET['gast']))
{
	registerGuest();
}

// Check of een klant al bestaat
function checkUser()
{
	$connection = connect();
	$stmt = $connection->prepare("SELECT * FROM gebruikers WHERE email = :email");
	$stmt->bindValue(':email', $_POST['email']);
	$stmt->execute();
	
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$email = $row['email'];
		$lid = $row['islid'];
	}

	if(isset($email))
	{
		if($lid != 4 && $lid != 0)
		{
			header("Location: ../checkout/login_page.php?email=$email");
		}
		else if($lid == 4)
		{
			header("Location: ../checkout/register_page.php?register=3");
		}
		else if($email == $_POST['email']){
			header("Location: ../checkout/login_page.php?email=$email");
		}else{
			header("Location: ../checkout/register_page.php?register=2");
		}
	}
	else{
			header("Location: ../checkout/register_page.php?register=2");
		}
}

// Maak een nieuwe klant aan
function registerUser()
{	
	$naam =  $_POST['Voornaam'] . " " . $_POST['Achternaam']; 
	$password = $_POST['Wachtwoord'];
	$adres = $_POST['Adres'];
	$postcode = $_POST['Postcode'];
	$plaats = $_POST['Plaats'];
	$email = $_POST['Email'];

	// Encrypt het wachtwoord
	$saltcode = generateSalt($pass);
	$hashed_pwd = CreatePasswordHash($password, $saltcode );
	// Aanmaken klant
	try{
		$connection = connect();
		$stmt = $connection->prepare("INSERT INTO gebruikers(naam, saltcode, wachtwoord, adres, postcode, plaats, email) VALUES ('$naam','$saltcode','$hashed_pwd', '$adres', '$postcode', '$plaats', '$email')");
		$stmt->execute();
		header("Location: ../checkout/login_page.php");
	} catch (PDOException $e) {
   		echo 'Connection failed: ' . $e->getMessage();
	}
}

function updateGuest()
{
	$naam =  $_POST['Voornaam'] . " " . $_POST['Achternaam']; 
	$password = $_POST['Wachtwoord'];
	$adres = $_POST['Adres'];
	$postcode = $_POST['Postcode'];
	$plaats = $_POST['Plaats'];
	$email = $_POST['Email'];

	// Encrypt het wachtwoord
	$saltcode = generateSalt($pass);
	$hashed_pwd = CreatePasswordHash($password, $saltcode );
	// Aanmaken klant
	try{
		$connection = connect();
		$stmt = $connection->prepare("UPDATE gebruikers SET naam = '$naam', saltcode = '$saltcode', wachtwoord = '$hashed_pwd', adres = '$adres', postcode = '$postcode', plaats = '$plaats' WHERE email = '$email'");
		$stmt->execute();

		header("Location: ../checkout/login_page.php");
	} catch (PDOException $e) {
   		echo 'Connection failed: ' . $e->getMessage();
	}
}

?>