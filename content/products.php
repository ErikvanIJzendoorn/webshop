<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<link rel="stylesheet" href="../materialize/css/materialize.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script rel="materialize" src="../materialize/js/materialize.min.js"></script>
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script type="text/javascript" href="../js/materialize.js"></script>
</head>
<body>
	<?php
		require "../database/products.php";
		getProducts();
	?>
</body>
</html>