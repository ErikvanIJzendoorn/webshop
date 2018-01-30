<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <title>Betalingsoverzicht</title>
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
	// Haal de gekozen producten en de klantgegevens op en stop ze in een reservering
	if(isset($_GET['gast']))
	{
		$email = $_SESSION['gast_email'];
		$klantDetails = getLoginInfo($email);
		$_SESSION['klant'] = $klantDetails;
		$resDetails = $_SESSION['resDetails'];
	}
	else{
		$email = $_SESSION['email'];
		$klantDetails = getLoginInfo($email);
		$_SESSION['klant'] = $klantDetails;
		$resDetails = $_SESSION['resDetails'];
	}
?>

<div class="container">
	<table>
	<thead>
		<th>Reservering</th>
	</thead>
	<tbody>
		<!-- Klantgegevens -->
		<?php
			if(isset($_GET['gast']))
			{
				?><tr><td><?=$klantDetails[2]?></td></tr><?php
			}else
			{
				?>
				<th>Persoonsgegevens</th>
				<tr><td><?=$klantDetails[1]?></td></tr>
				<tr><td><?=$klantDetails[2]?></td></tr>
				<tr><td><?=$klantDetails[3]?></td></tr>
				<tr><td><?=$klantDetails[4]?> <?=$klantDetails[5]?></td></tr>
				<?php
			}
		?>

		<tr><th>Producten</th></tr>
		<tr>
			<th>Productnaam</th>
			<th>Aantal</th>
			<th>Maat</th>
			<th>Prijs</th>
		</tr>
		<?php
		$i = 1;
		$j = 0;
		$bundels = getBundels();
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
			<!-- Totaal Bedrag -->
			<td>Totaal: </td>
			<td></td>
			<td></td>
			<td><strong class="simpleCart_total"></strong></td>
		</tr>
		<?php
			if(isset($_GET['gast']))
			{
				?>
					<form action="../database/reserveer.php?gast=1" method="post">
				<?php
			}else{
				?>
					<form action="../database/reserveer.php" method="post">
				<?php
			}
		?>
		
		<tr>
			<td>
				<label>
			        <input type="checkbox" name="betaalverzoek" />
			        <span>Ik wil graag een betaalverzoek via de mail krijgen.</span>
		     	</label>
			</td>
		</tr>	
		<tr>
			<td>
				<?php
					if(isset($_GET['gast']))
					{
						?>
							<button class="btn simpleCart_empty" type="submit" name="action">Reserveer</button>
						<?php
					}
					else{
						?>
							<button class="btn simpleCart_empty" type="submit" name="action">Reserveer</button>
						<?php
					}
				?>
			</td>
		</tr>
		</form>
	</tbody>
</table>
</div>

</body>
</html>