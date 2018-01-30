<?php

require "connect.php";

// Als er een product gekozen is
function showAllProducts()
{
	$producten = getProducts();
	foreach ($producten as $value) 
		{
			?>
			<a href="shop.php?product=<?=$value[0]?>">
			<div class="col s4 item" id="<?=$value[0]?>">
				<div class="text">
					<h6><?=$value[1]?></h6>
				</div>
					<?php
						if(isset($value[5]))
						{
							echo '<img class="foto" width="150" height="150" src="data:image/jpeg;base64,'.base64_encode( $value[5] ).'"/>'; 
						}
						else{
							?>
								<img class="foto" src="http://via.placeholder.com/150x150" alt="Product Foto">
							<?php
						}
					?>
				<div class="text">
					<span>Prijs: € <?=$value[3]?></span>
				</div>
			</div>
			</a>
			<?php
		}
}

function handleSelectedProduct()
{
	$product = getSelectedProduct();
	if($product[6] == 1)
	{
		showSelectedBundel();
	}else{
		showSelectedProduct();
	}
}

// Haal de maten op voor dit product
// En laat de klant kiezen welke maat en hoeveel hij van het product wilt
function showSelectedProduct()
{
	$product = getSelectedProduct();
	$id = $product[0];
	?>
	<div class="col s11 prod" style="background-color: rgba(204, 204, 204, 1);">
		<div class="row simpleCart_shelfItem">
			<div class="col s3 margin">
				<?php
					if(isset($product[5]))
					{
						echo '<img class="sel_foto" width="200" height="200" src="data:image/jpeg;base64,'.base64_encode( $product[5] ).'"/>'; 
					}
					else{
						?>
							<img class="sel_foto" src="http://via.placeholder.com/200x200" alt="Product Foto">
						<?php
					}
				?>
			</div>
			<div class="col s3 offset-s1 sel_info">
				<h5 class="item_name"><?=$product[1];?></h5>
				<p><?=$product[2]?></p>
				<span class="sel_prijs item_price">Prijs: € <?=$product[3]?></span>
				<div class="sel_button">
					<a href="shop.php" class="btn item_add">Toevoegen</a>
				</div>
			</div>
			<div class="col s2 sel_maat" style="background-color: rgba(204, 204, 204, 1);">
				<div class="row" style="margin-top: 22px;">
					<div class="col s8">							      
					<h6 class="col s12">Maten</h6>
						<div class="input-field">
							<select class="item_size">
							<?php
					    		$productSizes = getSizes($id);
								foreach ($productSizes as $value) 
								{
						      		if($value[3] >= 1)
						      		{
							      		?>
											<option value="<?=$value[2]?>"><?=$value[2];?></option>
							      		<?php
						      		}
						      		else
						      		{
						      			?>
											<option value="<?=$value[2]?>"><?=$value[2];?></option>
							      		<?php
						      		}
					      		}
						    ?>
					    	</select>
					    </div>
				  	</div>
					<div class="col s8">
				  	<h6 class="sel_titel">Aantal</h6>
		  				<input class="item_Quantity" placeholder="1 - 20" type="number" min="1" max="20" style="background-color: white;" required>
		  			</div>
				</div>
			</div>
		<div class="col s2 sel_voorraad" style="background-color: rgba(204, 204, 204, 1);">
		<?php
			$count = 0;

	      	foreach ($productSizes as $value) 
	      	{
	      		$maxCount = count($productSizes);

	      		if($value[3] >= 1)
	      		{
	      			$count++;
	      		}
	      	}
			    
	      	// Check of alle maten beschikbaar zijn - Moet nog verandert worden
	      	if($count != $maxCount)
	      		{
	      			echo "
	      				<strong>Let op:</strong> niet alle maten zijn op voorraad.<br><br>
	      				Hierdoor kan de levertijd oplopen tot maximaal 8 weken.
	      			";

	      		}
	      		else{
	      			echo "Wij hebben alle maten op voorraad";
	      		}
	      ?>
		</div>
		</div>
		<?php 	
			showProductStock();
		?>
	</div>
	<?php
}

function showSelectedBundel()
{
	$bundel = getSelectedBundel();
	$product = getSelectedProduct();
	$bundelItem = count($bundel);
	?>
	<div class="col s12 prod" style="background-color: rgba(204, 204, 204, 1);">
		<div class="row simpleCart_shelfItem">
			<div class="col s3">
				<img class="sel_foto" src="http://via.placeholder.com/200x200" alt="Product Foto">
			</div>
			<div class="col s2 sel_info">
				<h5 class="item_name"><?=$bundel[0][1];?></h5>
				<p><?=$product[2];?></p>
				<span class="prijs item_price">Prijs: € <?=$bundel[0][2]?></span>
				<div class="sel_button">
					<a href="shop.php?filter=PrijsHL" class="btn item_add">Toevoegen</a>
				</div>
			</div>

			<div class="col s3 offset-s1 sel_maat">
				<div class="row" style="margin-top: 22px;">
					<h6 class="sel_titel">Maten</h6>
					<?php 
					$bundelSize = getSizes($bundel[0][3]);
					foreach ($bundel as $value) 
					{
						
					?>
					<div class="maat_wrap">
						<span class="col s12"><?=$value[4];?></span>						      
						<div class="col s5">	
							<select class="item_size">
						    	<?php
									foreach ($bundelSize as $value) 
									{
							      		if($value[3] >= 1)
							      		{
								      		?>
												<option value="<?=$value[2]?>"><?=$value[2];?></option>
								      		<?php
							      		}
							      		else
							      		{
							      			?>
												<option value="<?=$value[2]?>"><?=$value[2];?></option>
								      		<?php
							      		}
						      		}
							    ?>
						    </select>
					  	</div>
			  		</div>
				  	<?php 
		  				} 
		  			?>
		  		</div>
			</div>
			<div class="col s2 sel_voorraad" style="background-color: rgba(204, 204, 204, 1);">
			<?php
				$count = 0;

		      	foreach ($bundelSize as $value) 
		      	{
		      		$maxCount = count($bundelSize);

		      		if($value[3] >= 1)
		      		{
		      			$count++;
		      		}
		      	}
				    
		      	// Check of alle maten beschikbaar zijn - Moet nog verandert worden
		      	if($count != $maxCount)
		      		{
		      			echo "
		      				<strong>Let op:</strong> niet alle maten zijn op voorraad.<br><br>
		      				Hierdoor kan de levertijd oplopen tot maximaal 8 weken.
		      			";

		      		}
		      		else{
		      			echo "Wij hebben alle maten op voorraad";
		      		}
		      ?>
			</div>
		</div>
		<?php 	
			showBundelStock();
		?>	
	</div>
		<?php
	}

function showBundelStock()
{	
	$bundel = getSelectedBundel();
	$id = $bundel[0][3];
	$stock = getStock($id);
	?>
		<div class="sel_voorraad" style="background-color: rgba(204, 204, 204, 1);">
			<table>
				<?php
				foreach($stock as $value)
				{
					?>
							<td>
								<th><?=$value[2]?></th>
							</td>
					<?php
				}
				?>
					</tr>
					<tr>

				<?php
				foreach($stock as $value)
				{
					?>	
						<td>
							<th><?=$value[3]?></th>
						</td>
					<?php
				}
				?>
				</tr>
			</table>
		</div>
	<?php
}

function showProductStock()
{	
	$product = getSelectedProduct();
	$id = $product[0];
	$stock = getStock($id);
	?>
		<div class="sel_voorraad" style="background-color: rgba(204, 204, 204, 1);">
			<table>
			<h5>Voorraadoverzicht</h5>
				<?php
				foreach($stock as $value)
				{
					?>
							<td>
								<th><?=$value[2]?></th>
							</td>
					<?php
				}
				?>
					</tr>
					<tr>

				<?php
				foreach($stock as $value)
				{
					?>	
						<td>
							<th><?=$value[3]?></th>
						</td>
					<?php
				}
				?>
				</tr>
			</table>
		</div>
	<?php
}

?>

