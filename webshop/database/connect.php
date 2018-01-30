<?php
session_id();
session_start();
// Maak een verbinding met de database

define("host", "mysql1336int.cp.hostnet.nl");
define("database", "db297542_valleirenners");
define("dbUser", "u297542_Website");
define("dbPass", "OiF3Zgre");

function connect()
{	
	$connection = new PDO("mysql:host=".host.";dbname=".database, dbUser, dbPass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $connection;
}

function Login($pass, $email)
{
	require "security.php";
	$connection = connect();
	$stmt = $connection->prepare("SELECT saltcode, wachtwoord, islid FROM gebruikers WHERE email = :email");
	$stmt->bindValue(":email", $email);
	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		// Check het opgegeven wachtwoord met het bestaande wachtwoord
		$check_salt = $row['saltcode'];
		$check_hash = $row['wachtwoord'];
		$lid = $row['islid'];

		$verify_hash = CreatePasswordHash($pass, $check_salt);

		$verify_pass = checkPassword($check_hash);
		$loginInfo = array($verify_hash, $verify_pass, $check_salt, $lid);
	}

	return $loginInfo;

	$_SESSION['email'] = $email;
}

function getLoginInfo($email)
{
	require "security.php";
	$connection = connect();
	$stmt = $connection->prepare("SELECT naam, email, adres, postcode, plaats, id, islid FROM gebruikers WHERE email = :email");
	$stmt->bindValue(":email", $email);
	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		// Check het opgegeven wachtwoord met het bestaande wachtwoord
	    $naam = $row['naam'];
	    $email = $row['email'];
	    $adres = $row['adres'];
	    $postcode = $row['postcode'];
	    $plaats = $row['plaats'];
	    $id = $row['id'];
	    $beheer = $row['islid'];

	    $persoon = array($id, $naam, $email, $adres, $postcode, $plaats, $beheer);
	}

	return $persoon;
}

// Haal alle producten op
function getProducts()
{
	$connection = connect();
	$stmt = $connection->prepare("SELECT producten.id, artikelcode, naam, omschrijving, verkoopprijs, isbundel, isactive, categorie, fotos.productid, fotos.foto FROM producten
					LEFT JOIN fotos ON
					producten.id = fotos.productid
					WHERE isactive = 1");
	$stmt->execute();

	// Sla productgegevens op
	$producten = [];
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$id = $row['id'];
		$naam = $row['naam'];
		$prijs = $row['verkoopprijs'];
		$disc = $row['omschrijving'];
		$code = $row['artikelcode'];
		$bundel = $row['isbundel'];
		$foto = $row['foto'];

		$product = array($id, $naam, $disc, $prijs, $code, $foto, $bundel);
		array_push($producten, $product);
	}

	return $producten;
}

function getBundels()
{
	$connection = connect();
	$stmt = $connection->prepare("SELECT * FROM bundeloverzicht");
	$stmt->execute();

	$bundels = [];
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$id = $row['bundelid'];
		$naam = $row['Bundelnaam'];
		$prijs = $row['Bundelprijs'];
		$prodid = $row['productid'];
		$prodnaam = $row['Productnaam'];

		$bundel = array($id, $naam, $prijs, $prodid, $prodnaam);
		array_push($bundels, $bundel);
	}
	return $bundels;
}

function getSelectedProduct()
{
	$connection = connect();
	$stmt = $connection->prepare("SELECT producten.id, artikelcode, naam, omschrijving, verkoopprijs, isbundel, isactive, categorie, fotos.productid, fotos.foto FROM producten
					LEFT JOIN fotos ON
					producten.id = fotos.productid
					WHERE producten.id = :id");
	$stmt->bindValue(":id", $_GET['product']);
	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$id = $row['id'];
		$naam = $row['naam'];
		$prijs = $row['verkoopprijs'];
		$disc = $row['omschrijving'];
		$code = $row['artikelcode'];
		$bundel = $row['isbundel'];
		$foto = $row['foto'];

		$selectedProduct = array($id, $naam, $disc, $prijs, $code, $foto, $bundel);
	}

	return $selectedProduct;
}

function getSelectedBundel()
{
	$connection = connect();
	$stmt = $connection->prepare("SELECT * FROM bundeloverzicht WHERE bundelid = :id");
	$stmt->bindValue(":id", $_GET['product']);
	$stmt->execute();

	$bundels = [];
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$id = $row['bundelid'];
		$naam = $row['Bundelnaam'];
		$prijs = $row['Bundelprijs'];
		$prodid = $row['productid'];
		$prodnaam = $row['Productnaam'];

		$bundel = array($id, $naam, $prijs, $prodid, $prodnaam);
		array_push($bundels, $bundel);
	}

	return $bundels;
}

function getSizes($id)
{
	$connection = connect();
	$stmt = $connection->prepare("SELECT * FROM voorraadoverzicht WHERE id = :id ORDER BY MaatID ASC");
	$stmt->bindValue(":id", $id);
	$stmt->execute();

	$allSizes = [];
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$id = $row['id'];
		$naam = $row['Productnaam'];
		$maat = $row['Maat'];
		$maatId = $row['MaatID'];
		$hoeveelheid = $row['Hoeveelheid'];

		$Size = array($id, $naam, $maat, $hoeveelheid, $maatId);
		array_push($allSizes, $Size);
	}

	return $allSizes;
}

function getStock($id)
{
	$connection = connect();
	$stmt = $connection->prepare("SELECT * FROM voorraadoverzicht WHERE id = :id ORDER BY MaatID ASC");
	$stmt->bindValue(":id", $id);
	$stmt->execute();

	$stock = [];
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$id = $row['id'];
		$naam = $row['Productnaam'];
		$maat = $row['Maat'];
		$maatId = $row['MaatID'];
		$hoeveelheid = $row['Hoeveelheid'];

		$item = array($id, $naam, $maat, $hoeveelheid, $maatId);
		array_push($stock, $item);
	}

	return $stock;
}
?>