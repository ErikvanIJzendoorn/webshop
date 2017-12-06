<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>Register</title>
	<link rel="stylesheet" href="../materialize/css/materialize.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script rel="materialize" src="../materialize/js/materialize.min.js"></script>
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script type="text/javascript" href="../js/materialize.js"></script>
	<script type="text/javascript" src="../shoppingcart/js/simpleCart.js"></script>
	<link rel="stylesheet" href="shop.css">
</head>
<script>
	 $(document).ready(function(){
	    $('select').select();	
	    $('.dropdown-trigger').dropdown({constrainWidth: false});
	  });
</script>

<header>
<nav>
  <div class="nav-wrapper">
    <a href="#!" class="brand-logo">Logo</a>
    <a class="brand-logo center">Valleirenners Kledingwinkel</a>
    <ul class="right hide-on-med-and-down">
    </ul>
  </div>
</nav>
</header>

<body>
<div class="row">
	<div class="col s1 margin">
	<?php
	  require "../content/filter.php";
	?>
	</div>
	<div class="col s7 offset-s1 margin">
	<?php
	  require "../content/products.php";
	?>	
	</div>
	
	<div class="col s3" style="background-color: wheat; margin-top: 30px;">
		<div class="simpleCart_items margin"></div>
		<div class="simpleCart_total"></div>	
		<div style="padding: 15px;">
			<a class="simpleCart_empty btn" href="shop.php?filter=PrijsHL">Winkelwagen legen</a>
			<a class="simpleCart_checkout btn" href="../shoppingcart/shoppingcart.php" style="margin-left: 50px;">Betalen</a>
		</div>
	</div>

</div>

</div>
</body>
</html>