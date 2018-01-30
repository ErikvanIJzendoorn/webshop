<?php
require "connect.php";
if(isset($_POST['email']))
{
	$email = $_POST['email'];
	$gast_naam = getGuestLoginInfo($email);
}
else{
	// error
}

function getGuestLoginInfo($email)
{
	$connection = connect();
	$stmt = $connection->prepare("SELECT naam, email FROM gebruikers WHERE email = :email");
	$stmt->bindValue(":email", $email);
	$stmt->execute();

	if($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$naam = $row['naam'];
	}else{
		$naam = " ";
	}

	return $naam;
}

if($gast_naam == $email)
{
	$_SESSION['gast_email'] = $gast_naam;
	header("Location: ../checkout/checkout.php?gast=1");	
}
else{
	registerGuest($email);
}

function registerGuest($gast_email)
	{
		try
		{
			$connection = connect();
			// Aanmaken klant
			$stmt = $connection->prepare("INSERT INTO gebruikers(naam, email, islid) VALUES 
				('$gast_email', '$gast_email', '4')");
			$stmt->execute();

			$connection = $connection;
			$stmt = $connection->prepare("SELECT id,email FROM gebruikers WHERE email = '$gast_email'");
			$stmt->execute();

			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$_SESSION['gastid'] = $row['id'];
				$email = $row['email'];
			}

			$_SESSION['gast_email'] = getGuestLoginInfo($email);
			header("Location: ../checkout/checkout.php?gast=1");
		}	catch (PDOException $e) {
		    echo 'Connection failed: ' . $e->getMessage();

		}
	}



?>