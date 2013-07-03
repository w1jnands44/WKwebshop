<?php 
	if(isset($_SESSION['user_name']))
	{
		$username = $_SESSION['user_name'];
	}
	else
	{
		header("Location: ?error=2");
	}
	
	$totaalprijs = 0;
	$totaalproducten = 0;

	if(isset($_POST['deleteWinkelwagen']))
	{
		setcookie("wkwebshop_$username", "", time()-3600);
		header("Location: index.php?page=winkelwagen");
	}

	include 'connect.php';
	
	if(isset($username) && isset($_COOKIE["wkwebshop_$username"]))
	{
		$cookie = $_COOKIE["wkwebshop_$username"];

		$vars = explode(";", $cookie);

		$counter = 0;
		
		while (count($vars) > $counter) 
		{
			
			$query = "SELECT * FROM artikelen WHERE artikel_id = ".$vars[$counter];
			$counter++;
			$resultaat = mysql_query($query) or die (mysql_error()) ;
			
			echo '<table style="border-collapse:collapse;font-size:18px;font-weight:bold;text-align:center;">';
			
			while ($row = mysql_fetch_array($resultaat)) 
			{
				if($row['artikel_image'] == null || $row['artikel_image'] == "" || $row['artikel_image'] == "null")
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
										<img class="afbeelding" alt="afbeelding" src="<?php echo $image; ?>"/>
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
											<b>Aantal: </b><?php echo $vars[$counter]; ?>
										</div>
									</div>
								</div> 
			<?php 

			$totaalprijs += $vars[$counter] * $row['artikel_prijs'];
			$totaalproducten += $vars[$counter];

			}
			 
			echo '</table>';
			$counter++;
		}		
	}
	else
	{
		echo 'Er zitten nog geen producten in uw winkelwagen, klik <a href="?page=artikelen">hier</a> om naar een product te zoeken.';
		mysql_close($connect);
	}
?>
<hr />
 <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
	<table class="zoeken">
		<tr>
			<td>
				<input type="submit" name="deleteWinkelwagen" value="Uw winkelwagen leeg maken."/>
			</td>
			<td>
				<b>Totaal prijs: </b> <?php echo "&euro;". $totaalprijs; ?>
			</td>
			<td> 
				<b>Totaal aantal producten: </b> <?php echo $totaalproducten; ?>
			</td>
		</tr>
	</table>
</form>

<form action="index.php?page=afronden" method="POST">
	<input type="submit" name="afronden" value="Bestelling afronden."/>
</form>
		


