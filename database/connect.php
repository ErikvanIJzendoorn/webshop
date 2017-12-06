<?php

function connect()
{
	define("host", "localhost");
	define("database", "webshop");
	define("dbUser", "root");
	define("dbPass", "");

	$connection = new PDO("mysql:host=".host.";dbname=".database, dbUser, dbPass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $connection;
}

?>