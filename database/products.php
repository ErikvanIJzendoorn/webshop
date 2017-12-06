<?php
function handleFilter()
{
	$query = "SELECT * FROM producten ";
	if(isset($_GET['filter']))
	{
		if($_GET['filter'] == "PrijsHL")
		{
			$totalQuery = $query . "ORDER BY producten.verkoopprijs DESC";
			return $totalQuery;
		}

		if($_GET['filter'] == "PrijsLH")
		{
			$totalQuery = $query . "ORDER BY producten.verkoopprijs ASC";
			return $totalQuery;
		}
	}

	if(isset($_GET['weer']))
	{
		if($_GET['weer'] == "Zomer")
		{
			$totalQuery = $query . "WHERE categorie = 1 OR categorie = 2 OR categorie = 4";
			return $totalQuery;
		}
		if($_GET['weer'] == "Winter")
		{
			$totalQuery = $query . "WHERE categorie = 1 OR categorie = 3 OR categorie = 4";
			return $totalQuery;
		}
	}

	if(isset($_GET['gender']))
	{
		if($_GET['gender'] == "Man")
		{
			$totalQuery = $query . "WHERE gender = 1 OR gender = 3";
			return $totalQuery;
		}
		if($_GET['gender'] == "Vrouw")
		{
			$totalQuery = $query . "WHERE gender = 2 OR gender = 3";
			return $totalQuery;
		}
	}
	
	if(isset($_GET['soort']))
	{
		if($_GET['soort'] == "ShirtK")
		{
			$totalQuery = $query . "WHERE categorie = 1";
			return $totalQuery;
		}

		if($_GET['soort'] == "ShirtL")
		{
			$totalQuery = $query . "WHERE categorie = 2 OR categorie = 3";
			return $totalQuery;
		}

		if($_GET['soort'] == "Jassen")
		{
			$totalQuery = $query . "WHERE categorie = 4";
			return $totalQuery;
		}
	}
}

function showProduct()
{
	if(isset($_GET['product']))
	{
		$id = $_GET['product'];
		$query = "SELECT * FROM producten WHERE id = '$id'";
		return $query;
	}
}

function getProducts()
{
	require "connect.php";

	$query = handleFilter();
	$selectedProduct = 'false';
	if(!isset($query))
	{
		$query = showProduct();
		$selectedProduct = 'true';
	}
	
	$connection = connect();
	$stmt = $connection->prepare($query);
	$stmt->execute();

	$producten = [];
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$id = $row['id'];
		$naam = $row['naam'];
		$prijs = $row['verkoopprijs'];
		$disc = $row['omschrijving'];
		$code = $row['artikelcode'];

		$product = array($naam, $disc, $prijs, $id, $code);
		array_push($producten, $product);
	}
	if($selectedProduct != 'true')
	{
		foreach ($producten as $value) 
		{
			?>
			<a class="product" href="shop.php?product=<?=$value[3]?>">
				<div class="col s3 item">
				<div class="row naam">
					<span class="naam" style="text-align: center;"><?=$value[0]?></span>
				</div>
					<img class="foto" src="http://via.placeholder.com/150x150" alt="Product Foto">
				<div class="row prijs">
					<span class="prijs">Prijs: € <?=$value[2]?></span>
				</div>
			</div>
			</a>
			<?php
		}
	}
	if($selectedProduct == 'true')
	{
		selectedProduct($producten, $connection);
	}
}

function selectedProduct($producten, $connection)	
{
	$query = "SELECT * FROM voorraadoverzicht WHERE id = :artcode ORDER BY MaatID ASC";

	$stmt = $connection->prepare($query);
	$stmt->bindValue(":artcode", $_GET['product']);
	$stmt->execute();

	$selProducten = [];
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$id = $row['id'];
		$naam = $row['Productnaam'];
		$maat = $row['Maat'];
		$hoeveelheid = $row['Hoeveelheid'];

		$selProduct = array($id, $naam, $maat, $hoeveelheid);
		array_push($selProducten, $selProduct);
	}

	foreach ($producten as $value) 
		{
			?>
				<div class="col s10 prod">
					<div class="row simpleCart_shelfItem">
						<div class="col s4 margin">
						<img class="foto" src="http://via.placeholder.com/200x200" alt="Product Foto">
						</div>
						<div class="col s3">
							<h5 class="item_name"><?=$producten[0][0]?></h5>
							<p><?=$value[1]?></p>
							<span class="prijs item_price">Prijs: € <?=$value[2]?></span>
						</div>
						<div class="col s3">
							<h4>Maten</h4>
							<div class="input-field col s4">
							    <select class="item_size">
							      <?php
							      	foreach ($selProducten as $value) {
							      		if($value[3] >= 1)
							      		{
								      		?>
												<option value="<?=$value[2]?>"><?=$value[2];?></option>
								      		<?php
							      		}
							      		else{
							      			?>
												<option class="text" value="<?=$value[2]?>"><?=$value[2];?></option>
								      		<?php
							      		}
							      	}
							      ?>
							    </select>
						  	</div>
						  	<div class="input-field col s6">
						  		<input class="item_Quantity" placeholder="Aantal" type="text" style="background-color: white;">
						  	</div>
						</div>
						<div class="col s2 margin">
							<?php
							$count = 0;
						      	foreach ($selProducten as $value) 
						      	{
						      		$maxCount = count($selProducten);

						      		if($value[3] >= 1)
						      		{
						      			$count++;
						      		}
						      	}
						      	if($count != $maxCount)
						      		{
						      			echo "Niet alle maten zijn op voorraad";
						      		}
						      		else{
						      			echo "Wij hebben alle maten op voorraad";
						      		}
						      ?>
						</div>	
						<div class="col s5">
							<a href="shop.php?filter=PrijsHL" class="btn item_add">Bestellen</a>
						</div>
					</div>
				</div>
			<?php
		}
}
	

?>