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
							<input type="radio" name="keuze" value="categorie">categorie<br>
							<input type="radio" name="keuze" value="prijs">titel<br>
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
	if(!isset($_POST["zoeken"]))
	{
		include 'connect.php';	

		$query = "SELECT * FROM catagorie GROUP BY catagorie_id";

		$resultaat = mysql_query($query) or die (mysql_error()) ;

		while ($row = mysql_fetch_array($resultaat)) 
		{
			$data[] = $row;
		}

		foreach ($data as $key) 
		{
			?>
				<div class="home_artikel">

					<div class="categorie_afbeelding">
						<b>afbeelding</b>
					</div>

					<div class="categorie_naam">
						<b> <?php echo $key['catagorie_naam']; ?></b>
					</div>
				</div> 
			<?php 
		}
	}
?>
