<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>Webshop</title>
	<link rel="stylesheet" href="../materialize/css/materialize.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script rel="materialize" src="../materialize/js/materialize.min.js"></script>
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script type="text/javascript" href="../js/materialize.js"></script>
	<script type="text/javascript" src="../checkout/js/simpleCart.js"></script>
	<link rel="shortcut icon" type="image/png" href="../fotos/logo-axa.png"/>
	<link rel="stylesheet" href="shop.css">
</head>
<!-- Zorg ervoor dat materialize werkt -->
<script>
	 $(document).ready(function(){
	    $('select').select();	
	  });
</script>

<header>
	<!-- Navbar -->
	<div class="row">
		<nav>
	  <div class="nav-wrapper container">
	  	<ul class="center">
	  		<li><a href="../shop/shop.php?filter=PrijsHL"  style="max-width: 150px; max-height: 100px;"><img src="../fotos/logo-axa.png" width="150" height="100" alt="Logo"></a></li>
	  	</ul>
	    <ul class="right">
	    	<li><a class="nav_item" href="../shop/shop.php">Winkel</a></li>
	    	<li><a class="nav_item" href="../home/info.php">Home</a></li>
	    	<li><a class="nav_item" href="../checkout/admin_login.php">Administrator login</a></li>
	    </ul>
	  </div>
	</nav>
	</div>
</header>

<body>
<div class="row">
	<?php
		require "../database/products.php";
		// Als product is gekozen
		if(isset($_GET['product']))
		{
			?>
			<div class="col s8 offset-s1">
				<?php
					handleSelectedProduct();
				?>
			</div>
			<?php
		}
		else{
			// Alle producten
			?>
			<div class="col shop s8 offset-s1">
				<div class="row">
					<div class="col s12">
						<!-- Laat alle producten zien -->
					<?php
						showAllProducts();
					?>	
					</div>
				</div>
			</div>
			<?php
		}

	?>
	
	<!-- Winkelwagen -->
	<div class="col s3 cart">
		<div class="simpleCart_items"></div>
		<div class="simpleCart_total"></div>	
		<div>
			<a class="simpleCart_empty btn cart_knop" href="shop.php?filter=PrijsHL">Leeg maken</a>
			<a class="simpleCart_checkout btn cart_knop" href="javascript:;">Bestellen</a>
		</div>
	</div>
</div>
</div>
</body>
</html>