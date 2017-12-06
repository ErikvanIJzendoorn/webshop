<?php
attemptLogin();
function attemptLogin()
{
	require "security.php";
	require "connect.php";

	$form_username = $_POST['naam'];
	$form_password = $_POST['wachtwoord'];

	$connection = connect();
	$stmt = $connection->prepare("SELECT saltcode, wachtwoord FROM gebruikers WHERE naam = :username");
	$stmt->bindValue(":username", $form_username);
	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$stored_salt = $row['saltcode'];
	    $stored_hash = $row['wachtwoord'];
	    $check_pass = $stored_salt . $form_password;
	    $check_hash = hash('sha512',$check_pass);
	}

	if($stored_salt != NULL)
	{
		if($check_hash == $stored_hash){
	    header("Location: ../shop/shop.php");
		}
		else{
		    echo "Not authenticated";
		}
	}
	else{
		echo "Not a valid user";
	}
}

?>