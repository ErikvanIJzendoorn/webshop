<?php
require "connect.php";
if(isset($_GET['gast']) == 1)
{
	$_SESSION['gast_email'] = $_POST['email'];
	header("Location: ../database/register.php?gast=1");
}else{
	attemptLogin();
}

function attemptLogin()
{
	// Krijg opgegeven email en wachtwoord
	$form_email = $_POST['Email'];
	$form_password = $_POST['Wachtwoord'];
	
	$loginInfo = Login($form_password, $form_email);

	try{   
		if(isset($loginInfo[2]))	
		{
			// Als het klopt
			if($loginInfo[0] == $loginInfo[1])
			{
		    	if($loginInfo[3] == 2 || $loginInfo[3] == 3)
				{
					header("Location: ../home/home.php");
				}
				else{
					$_SESSION['email'] = $form_email;
					header("Location: ../checkout/checkout.php");
				}
			}
			// Als het niet klopt
			else{
			   	throw new Exception('Inloggegevens komen niet overeen');
			}
		}
		else if($loginInfo[3] == 4 && !isset($loginInfo[2]))
		{
			throw new Exception('Je bent de vorige keer als gast ingelogd.<br> Maak eerst een account aan om te kunnen inloggen');
		}
		else{
			throw new Exception('Geen bestaand account gevonden.');
		}
	} catch (Exception $e) {
   	 	echo 'Foutmelding: ',  $e->getMessage(), "<br>";
   	 	echo '<a href="../checkout/login_page.php">Klik hier</a> om terug te gaan naar het inloggen';
	}
}

?>