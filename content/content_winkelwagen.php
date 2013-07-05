<?php 
	
	include 'connect.php';

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

	if (isset($_POST['updateWinkelwagen']))
	{

		print_r($_POST);

			foreach ($_POST as $var) 
			{
				echo $var;
			}

			/*print_r($_POST);
			$cookie = $_COOKIE["wkwebshop_$username"];

			$vars = explode(";", $cookie);

			$counter = 0;

			




			$cookie = $_COOKIE["wkwebshop_$username"];

			$vars = explode(";", $cookie);

			print_r($vars);

			
			$counter = 0;

		while (count($vars) > $counter) 
		{
			
			$query = "SELECT * FROM artikelen WHERE artikel_id = ".$vars[$counter];
			$counter++;
			$resultaat = mysql_query($query) or die (mysql_error()) ;

			while ($row = mysql_fetch_array($resultaat)) 
			{
	
				$totaalprijs = 0;
				$totaalproducten = 0;

				$totaalprijs += $vars[$counter] * $row['artikel_prijs'];
				$totaalproducten += $vars[$counter];

			}
			 
			$counter++;
			}*/
		}	

	
	if(isset($username) && isset($_COOKIE["wkwebshop_$username"]))
	{

		$cookie = $_COOKIE["wkwebshop_$username"];

		$vars = explode(";", $cookie);

		$counter = 0;

		echo '<table width="100%">';
		echo '<th>Artikel naam</th> <th>Prijs</th> <th>Aantal</th>';
		echo '<tr>
				<td  colspan="3">
					<hr />
				</td>
			  </tr>';
		
		while (count($vars) > $counter) 
		{
			
			$query = "SELECT * FROM artikelen WHERE artikel_id = ".$vars[$counter];

			$counter++;
			$resultaat = mysql_query($query) or die (mysql_error()) ;

			while ($row = mysql_fetch_array($resultaat)) 
			{
				if($row['artikel_image1'] == null || $row['artikel_image1'] == "" || $row['artikel_image1'] == "null")
				{
					$image = "images/layout/default_image_product.png";
				}
				else
				{
					$image = $row['artikel_image1'];
				}
			?>
				<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
				<tr>
					<td style="text-align:center;">
						<?php echo $row['artikel_naam']; ?>
					</td>
					<td style="text-align:center;">
						<?php echo "&euro;".$row['artikel_prijs']; ?>
					</td>
					<td style="text-align:center;">
						<input id="inputNumber" type="number" name="<?php echo $row['artikel_id']; ?>" min="1" max="99" style="width:50px;" value="<?php echo $vars[$counter]; ?>"/>
					</td>
				</tr>
			
			<?php 

			$totaalprijs += $vars[$counter] * $row['artikel_prijs'];
			$totaalproducten += $vars[$counter];

			}
			 
			$counter++;
		}
		echo '</table>';	
	}
	else
	{
		echo 'Er zitten nog geen producten in uw winkelwagen, klik <a href="?page=artikelen">hier</a> om naar een product te zoeken.';
		mysql_close($connect);
	}
?>
<hr />
	<table class="zoeken">
		<tr>
			<td>
				<input type="submit" name="deleteWinkelwagen" value="Uw winkelwagen leeg maken."/>
			</td>
			<td>
				<input type="submit" id="updateWinkelwagen" name="updateWinkelwagen" value="Winkelwagen bijwerken."/>
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
		


