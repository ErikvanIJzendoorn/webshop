<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <title>Winkelwagen</title>
  <link rel="stylesheet" href="../materialize/css/materialize.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script rel="materialize" src="../materialize/js/materialize.min.js"></script>
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script type="text/javascript" href="../js/materialize.js"></script>
  <script type="text/javascript" src="../checkout/js/simpleCart.js"></script>
  <link rel="shortcut icon" type="image/png" href="../fotos/logo-axa.png"/>
  <link rel="stylesheet" href="checkout.css">
</head>

<header>
  <!-- Navbar -->
  <div class="row">
    <nav>
    <div class="nav-wrapper">
      <ul class="center">
        <li><a href="../shop/shop.php?filter=PrijsHL"  style="max-width: 150px; max-height: 100px;"><img src="../fotos/logo-axa.png" width="150" height="100" alt="Logo"></a></li>
      </ul>
      <ul class="right">
        <li><a class="nav_item" href="../shop/shop.php?filter=PrijsHL">Winkel</a></li>
        <li><a class="nav_item" href="../home/info.php">Home</a></li>
        <li><a class="nav_item" href="../checkout/admin_login.php">Administrator login</a></li>
      </ul>
    </div>
  </nav>
  </div>
</header>

<body>
<?php
	require "../database/connect.php";
	// Haal de gekozen producten op en stop ze in een session var
	$resDetails = [];
	$resDetails = $_POST;

	$_SESSION['resDetails'] = $resDetails;
?>

<div class="container margin">
	<table>
	<thead>
		<th>Reservering</th>
	</thead>
	<tbody>
		<?php
			$bundels = getBundels();
			if($resDetails['itemCount'] != 0)
			{
			$i = 1;
			$j = 0;
			?>
			<tr>
				<th>Productnaam</th>
				<th>Aantal</th>
				<th>Maat</th>
				<th>Prijs</th>
			</tr>
			<?php
			do{
				if($bundels[$i - 1][1] == $resDetails['item_name_' . $i])
					{
						$maat1 = explode(', ', $resDetails['item_options_' . $i])[0];
						$maat2 = explode(', ', $resDetails['item_options_' . $i])[1];
						?>
						<tr>
							<!-- Laat product naam, aantal, size en prijs zien -->
							<td><?=$resDetails['item_name_' . $i];?></td>
							<td><?=$resDetails['item_quantity_' . $i];?></td>
							<td></td>
							<td>€ <?=$resDetails['item_price_' . $i];?></td>
						</tr>
						<tr>
							<!-- Laat product naam, aantal, size en prijs zien -->
							<td><?=$bundels[0][4];?></td>
							<td></td>
							<td><?=$maat1;?></td>
							<td></td>
						</tr>
						<tr>
							<!-- Laat product naam, aantal, size en prijs zien -->
							<td><?=$bundels[1][4];?></td>
							<td></td>
							<td><?=$maat2;?></td>
							<td></td>
						</tr>
						<?php
					}
					else{
						?>
						<tr>
							<!-- Laat product naam, aantal, size en prijs zien -->
							<td><?=$resDetails['item_name_' . $i];?></td>
							<td><?=$resDetails['item_quantity_' . $i];?></td>
							<td><?=$resDetails['item_options_' . $i];?></td>
							<td>€ <?=$resDetails['item_price_' . $i];?></td>
						</tr>
						<?php
					}
					$i++;
				}while($i != $resDetails['itemCount'] + 1);
				?>
					<tr>
						<!-- Totaal prijs -->
						<td>Totaal: </td>
						<td></td>
						<td></td>
						<td><strong class="simpleCart_total"></strong></td>
					</tr>	
					</tbody>
					</table>
					<div class="but_div">
						<a class="btn but" style="margin-left: 42%;" href="login_page.php">Verder</a>
					</div>
				<?php
			}else
			{
				?>
					<tr><td>Er staan geen producten in de winkelwagen.</td></tr>
					</tbody>
					</table>
					<div class="but_div">
						<a class="btn but" style="margin-left: 42%;" href="../shop/shop.php">Terug</a>
					</div>
				<?php
			}
		?>	
</div>
</body>
</html>