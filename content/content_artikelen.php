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
							<input type="radio" name="keuze" value="merk">merk<br>
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
			<form >
				<div class="home_artikel">

					<div class="categorie_afbeelding">
						<img class="afbeelding" alt="test" src="<?php echo $row['categorie_image']; ?>"/>
					</div>

					<div class="categorie_naam">
						<b> <a href='?page=artikelen&categorie=<?php echo $row['categorie_naam']; ?>'> <?php echo $row['categorie_naam']; ?> </a></b>
						<input type="hidden" value="<?php echo $row['categorie_naam']; ?>" />
					</div>
				</div> 
			</form>
			<?php 
		}

		if($_GET["categorie"] == "Notebooks")
		{
			$query = 'SELECT * FROM artikelen a, categorie c WHERE a.categorie_id == c.categorie_id AND c.catagorie_naam == ".echo $_GET["categorie"] ?>"';

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
							<div class="rechtsonder">
								<div class="product_prijs">
									<b> <?php echo "&euro;" .$row['artikel_prijs']; ?></b>
								</div>
								<div class="bestelbtn">
									<input type="submit" value="Toevoegen aan winkelwagen" />
								</div>
							</div>
						</div> 
					<?php 
				}
		}
		elseif($_GET["categorie"] == "Desktops")
		{
			$query = "";
		}
		elseif($_GET["categorie"] == "Randapparatuur")
		{
			$query = "";
		}
		elseif($_GET["categorie"] == "Componenten")
		{
			$query = "";
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
		elseif($_POST['keuze'] == 'merk')
		{
			$query = "SELECT * FROM merken WHERE merk_naam LIKE '%" . $_POST['searchbar'] . "%'";
		}

		$resultaat = mysql_query($query) or die (mysql_error()) ;
		
		while ($row = mysql_fetch_array($resultaat)) 
		{
			if($_POST['keuze'] == "merk")
			{

				if($row['merk_image'] == null || $row['merk_image'] == "")
				{
					$image = "images/layout/default_image_product.png";
				}
				else
				{
					$image = $row['merk_image'];
				}

				?>
					<div class="home_artikel">

						<div class="product_afbeelding">
							<img class="afbeelding" alt="test" src="<?php echo $image; ?>"/>
						</div>

						<div class="product_naam">
							<b> <?php echo $row['merk_naam']; ?></b>
						</div>
						<div class="product_beschrijving">
							<b> <?php echo $row['merk_beschrijving']; ?></b>
						</div>
					</div> 
				<?php 
			}
			else
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
						<div class="rechtsonder">
							<div class="product_prijs">
								<b> <?php echo "&euro;" .$row['artikel_prijs']; ?></b>
							</div>
							<div class="bestelbtn">
								<input type="submit" value="Toevoegen aan winkelwagen" />
							</div>
						</div>
					</div> 
				<?php 
			}
		}
	}
	else
	{
		echo "Er is geen keuze aangegeven.";
	}
?>
