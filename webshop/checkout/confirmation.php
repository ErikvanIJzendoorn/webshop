<?php
require "../database/connect.php";

if(isset($_SESSION['request']))
{
	$paymentRequest = $_SESSION['request'];
}else{
	$paymentRequest = "off";
}
mailReservartion($paymentRequest);
function mailReservartion($paymentRequest)
{
	$resDetails = $_SESSION['resDetails'];
	$klantDetails = $_SESSION['klant'];
	$bundels = getBundels();


	$i = 1;
	$j = 0;

	$to = $klantDetails[2];
	$subject = "Bestelling bevestigd";

	$message = '<html><body><head><script type="text/javascript" src="../checkout/js/simpleCart.js"></script></head>';
	$message .= 'Beste meneer/mevrouw, <br>';
	$message .= 'Hier volgt een bevestiging van de bestelling.';
	$message .= '<table>';
	$message .= '<tr><td><strong>Reservering</strong></td></tr>';
	$message .= '<tr><td><strong>Persoonsgegevens</strong></td></tr>';
	$message .= "<tr><td>" . $klantDetails[1] . "</td></tr>";
	$message .= "<tr><td>" . $klantDetails[2] . "</td></tr>";
	$message .= "<tr><td>" . $klantDetails[3] . "</td></tr>";
	$message .= "<tr><td>" . $klantDetails[4] . " " . $klantDetails[5] . "</td></tr>";
	$message .= '<tr><td><strong>Producten</strong></td></tr>';
	$message .= '<tr><td><strong>Productnaam</strong></td>';
	$message .= '<td><strong>Aantal</strong></td>';
	$message .= '<td><strong>Maat</strong></td>';
	$message .= '<td><strong>Prijs</strong></td></tr>';

	do{
		if($bundels[1] == $resDetails['item_name_' . $i])
		{
			$maat1 = explode(', ', $resDetails['item_options_' . $i])[0];
			$maat2 = explode(', ', $resDetails['item_options_' . $i])[1];

			$message .= "<tr><td>" . $resDetails['item_name_' . $i] . "</td>";
			$message .= "<td>" . $resDetails['item_quantity_' . $i] . "</td>";
			$message .= "<td></td>";
			$message .= "<td>" . "€" . $resDetails['item_price_' . $i] . "</td><tr>";

			$message .= "<tr><td>" . $bundels[4] . "</td>";
			$message .= "<td></td>";
			$message .= "<td>" . $maat1 . "</td>";
			$message .= "<td></td></tr>";

			$message .= "<tr><td>" . $bundels[4] . "</td>";
			$message .= "<td></td>";
			$message .= "<td>" . $maat2 . "</td>";
			$message .= "<td></td></tr>";
		}
		else{
			$message .= "<tr><td>" . $resDetails['item_name_' . $i] . "</td>";
			$message .= "<td>" . $resDetails['item_quantity_' . $i] . "</td>";
			$message .= "<td>" . $resDetails['item_options_' . $i] . "</td>";
			$message .= "<td>" . "€" . $resDetails['item_price_' . $i] . "</td></tr>";
		}
		$i++;
	}
	while($i != $resDetails['itemCount'] + 1);

	if(isset($paymentRequest))
	{
		if($paymentRequest == 'on')
		{
			$message .= '<br><tr>Gelieve €' . $resDetails['total'] . ' over te maken naar:';
			$message .= '<br>NL** **** ******6512';
			$message .= '<br>Zet ' . '123' . ' in de beschrijving';
			$message .= '</tr>';
		}else{
			$message .= '<tr><td>Totaal: </td>';
			$message .= '<td></td><td></td>';
			$message .= '<td><strong> €' . $resDetails['total'] . '</strong></td>';
			$message .= '</tr>';
		}
	}

	$message .= '<br>Betalen kan met cash bij het afhalen van de bestelling.<br>';
	$message .= 'Bedankt voor uw bestelling en graag tot de volgende keer.<br>';

	$message .= '</table>';
	$message .= '</html></body>';

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: <noreply@valleirennerskleding.nl>' . "\r\n";

	mail($to,$subject,$message,$headers);
	mailBeheerder();
}

function mailBeheerder()
{
	$resDetails = $_SESSION['resData'];
	$klantDetails = $_SESSION['klant'];

	$to = "";
	$subject = "";
	$message = "";
	$headers = "";

	$to = "info@valleirennerskleding.nl";
	$subject = "Nieuwe Bestelling aangemaakt";

	$message = '<html><body>';

	$message .= 'Er is een nieuwe bestelling aangemaakt door: ' . $klantDetails[2] . '<br>';
	$message .= 'Verdere details kunt u vinden op de beheerapplicatie.' . '<br>';

	$message .= '</html></body>';


	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: <noreply@valleirennerskleding.nl>' . "\r\n";

	mail($to,$subject,$message,$headers);
	session_destroy();
	?>
		<script type="text/javascript">
		alert("Bestelling succesvol!");
		window.location.href = "../shop/shop.php";
		</script>
	<?php
}

?>