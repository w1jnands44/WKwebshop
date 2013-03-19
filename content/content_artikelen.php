<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
		<div class="artikel_zoeken">
			<div>
				<table class="zoeken">
					<tr>
						<td>
							Zoeken op
						</td>
						<td>
							<input type="radio" name="keuze" value="naam">naam<br>
							<input type="radio" name="keuze" value="beschrijving">beschrijving<br>
							<input type="radio" name="keuze" value="prijs">prijs<br>
						</td>
						<td>
							<input type="text" name="searchbar"/>
						</td>
						<td>
							<input type="submit" name="zoeken" value="Zoeken"/>
						</td>
					</tr>
				</table>
			</div>
		</div> 
	</form>
<hr />

<?php
	include 'connect.php';	

	if(!isset($_POST["zoeken"]))
	{
		
		$query = "SELECT * FROM categorie GROUP BY categorie_id";

		$resultaat = mysql_query($query) or die (mysql_error()) ;

		while ($row = mysql_fetch_array($resultaat)) 
		{
			?>
				<div class="home_artikel">

					<div class="categorie_afbeelding">
						<img class="afbeelding" alt="test" src="<?php echo $row['categorie_image']; ?>"/>
					</div>

					<div class="categorie_naam">
						<b> <?php echo $row['categorie_naam']; ?></b>
					</div>
				</div> 
			<?php 
		}
	}

	elseif(isset($_POST['keuze']) && strlen($_POST['searchbar']) != 0)
	{
		if($_POST['keuze'] == 'naam')
		{
			$query = "SELECT * FROM artikelen WHERE artikel_naam LIKE '%" . $_POST['searchbar'] . "%'";
		}
		elseif($_POST['keuze'] == 'beschrijving')
		{
			$query = "SELECT * FROM artikelen WHERE artikel_beschrijving LIKE '%" . $_POST['searchbar'] . "%'";
		}
		elseif($_POST['keuze'] == 'prijs')
		{
			$query = "SELECT * FROM artikelen WHERE artikel_prijs LIKE '%" . $_POST['searchbar'] . "%'";
		}

		$resultaat = mysql_query($query) or die (mysql_error()) ;
		
		while ($row = mysql_fetch_array($resultaat)) 
		{
			if($row['artikel_image'] == null || $row['artikel_image'] == "")
			{
				$image = "images/layout/default_image_product.png";
			}
			else
			{
				$image = $row['artikel_image'];
			}
			?>
				<div class="home_artikel">

					<div class="product_afbeelding">
						<img class="afbeelding" alt="test" src="<?php echo $image; ?>"/>
					</div>

					<div class="product_naam">
						<b> <?php echo $row['artikel_naam']; ?></b>
					</div>
					<div class="product_beschrijving">
						<b> <?php echo $row['artikel_beschrijving']; ?></b>
					</div>
					<div class="product_prijs">
						<b> <?php echo $row['artikel_prijs']; ?></b>
					</div>
				</div> 
			<?php 
		}

	}
	else
	{
		echo "Er is geen keuze aangegeven.";
	}
?>
