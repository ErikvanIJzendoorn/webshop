<?php
require "connect.php";
$connection = connect();

if(isset($_POST['betaalverzoek']))
{
	$paymentRequest = $_POST['betaalverzoek'];
}

createReservation($connection, $paymentRequest);

function createReservation($connection, $paymentRequest)
{
	$klant = $_SESSION['klant'];

	$reservering = $_SESSION['resDetails'];	
	$bundels = getBundels();

	if(isset($reservering))
	{
		$CombinedProducten = [];
		for ($i = 1; $i < $reservering['itemCount'] + 1; $i++)
		{ 
			$stmt = $connection->prepare("SELECT * FROM producten WHERE naam = :naam");
			$stmt->bindValue(":naam", $reservering['item_name_' . $i]);
			$stmt->execute();

			$singleProduct = [];
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$naam = $row['naam'];
				$id = $row['id'];

				$product = array($naam, $id);
				array_push($singleProduct, $product);
			}
			$CombinedProduct = array($singleProduct);
			array_push($CombinedProducten, $CombinedProduct);
		}
	}
	// bestelling
	// id, klantid, datum, status
	try{
		if(isset($_GET['gast']))
		{
			if($_GET['gast'] == 1)
			{
				$persoon = getLoginInfo($_SESSION['gast_email']);
				if($paymentRequest == 'on')
				{
					$stmt = $connection->prepare("INSERT INTO bestellingen (klantid, datum, status, betaalmethode) VALUES (:id, :datum, 1, 2)");
					$stmt->bindValue(":id", $persoon[0]);
					$stmt->bindValue(":datum", date("d-m-Y"));
					$stmt->execute();
				}
				else{
					$stmt = $connection->prepare("INSERT INTO bestellingen (klantid, datum, status, betaalmethode) VALUES (:id, :datum, 1, 1)");
					$stmt->bindValue(":id", $persoon[0]);
					$stmt->bindValue(":datum", date("d-m-Y"));
					$stmt->execute();
				}
			}
		}else{
			if($paymentRequest == 'on')
			{
				$connection = $connection;
				$stmt = $connection->prepare("INSERT INTO bestellingen (klantid, datum, status, betaalmethode) VALUES (:id, :datum, 1, 2)");
				$stmt->bindValue(":id", $klant[0]);
				$stmt->bindValue(":datum", date("d-m-Y"));
				$stmt->execute();
			}
			else{
				$connection = $connection;
				$stmt = $connection->prepare("INSERT INTO bestellingen (klantid, datum, status, betaalmethode) VALUES (:id, :datum, 1, 1)");
				$stmt->bindValue(":id", $klant[0]);
				$stmt->bindValue(":datum", date("d-m-Y"));
				$stmt->execute();
			}
		}
	}
	catch (Exception $e) {
   	 	echo 'Foutmelding: ',  $e->getMessage(), "<br>";
	}

	// bestellingproduct
	// bestellingid, productid, maat
	try{
		for ($i = 1; $i < $reservering['itemCount'] + 1; $i++) { 
			if($bundels[$i - 1][1] == $CombinedProducten[$i - 1][0][0][0])
			{		
				$maat1 = explode(', ', $reservering['item_options_' . $i])[0];
				$maat2 = explode(', ', $reservering['item_options_' . $i])[1];
				
				$stmt = $connection->prepare("INSERT INTO bestellingproduct (bestellingid, productid, hoeveelheid, maat, bundelChild) VALUES ((SELECT max(id) FROM bestellingen), :prodid, :hoeveelheid, (SELECT id FROM maten WHERE naam = :maat), :bundel)");		
				$stmt->bindValue(":prodid", $bundels[$i - 1][3]);
				$stmt->bindValue(":hoeveelheid", 1);
				$stmt->bindValue(":maat", $maat1);
				$stmt->bindValue(":bundel", $bundels[$i - 1][0]);
				$stmt->execute();
				$i++;

				$stmt = $connection->prepare("INSERT INTO bestellingproduct (bestellingid, productid, hoeveelheid, maat, bundelChild) VALUES ((SELECT max(id) FROM bestellingen), :prodid, :hoeveelheid, (SELECT id FROM maten WHERE naam = :maat), :bundel)");		
				$stmt->bindValue(":prodid", $bundels[$i - 1][3]);
				$stmt->bindValue(":hoeveelheid", 1);
				$stmt->bindValue(":maat", $maat2);
				$stmt->bindValue(":bundel", $bundels[$i - 1][0]);
				$stmt->execute();
				$i--;

				$stmt = $connection->prepare("INSERT INTO bestellingproduct (bestellingid, productid, hoeveelheid, maat) VALUES ((SELECT max(id) FROM bestellingen), :prodid, :hoeveelheid, 13)");		
				$stmt->bindValue(":prodid", $bundels[0][0]);
				$stmt->bindValue(":hoeveelheid", 1);
				$stmt->execute();

			}else{
				$connection = $connection;
				$stmt = $connection->prepare("INSERT INTO bestellingproduct (bestellingid, productid, hoeveelheid, maat) VALUES ((SELECT max(id) FROM bestellingen), :prodid, :hoeveelheid, (SELECT id FROM maten WHERE naam = :maat))");		
				$stmt->bindValue(":prodid", $CombinedProducten[$i - 1][0][0][1]);
				$stmt->bindValue(":hoeveelheid", $reservering['item_quantity_' . $i]);
				$stmt->bindValue(":maat", $reservering['item_options_' . $i]);
				$stmt->execute();
			}		
		}
	}
	catch (Exception $e) {
   	 	echo 'Foutmelding: ',  $e->getMessage(), "<br>";
	}
	header("Location: ../checkout/confirmation.php");
}

?>