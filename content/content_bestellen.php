<?php 

if(!isset($_POST['bestellen']))
{
	if(isset($_GET['artikel_id']))
	{
		include 'connect.php';

		$id = $_GET['artikel_id'];

		$query = "SELECT * FROM artikelen WHERE artikel_id LIKE '$id'";

		$resultaat = mysql_query($query) or die (mysql_error()) ;

		while ($row = mysql_fetch_array($resultaat)) 
		{
			if($row['artikel_image1'] == null || $row['artikel_image1'] == "")
			{
				$image = "images/layout/default_image_user.png";
			}
			else
			{
				$image = $row['artikel_image1'];
			}
?>
			<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
				<div class="winkelwagen">
					<table>
						<tr>
							<td width="200px"><b>Afbeelding</b></td>
							<td width="100px"><b>Naam</b></td>
							<td width="100px"><b>Beschrijving</b></td>
							<td width="100px"><b>Prijs<b></td>
							<td width="100px"><b>Aantal<b></td>
						</tr>
						<tr>
							<td colspan="5">
								<hr />
							</td>
						</tr>

						<tr>
							<td>
								<img width="150px" alt="afbeelding" src="<?php echo $image ?>"/>
							</td>
							<td>
								<?php echo $row['artikel_naam']; ?>
							</td>
							<td>
								<?php echo $row['artikel_beschrijving']; ?>
							</td>
							<td>
								<?php echo $row['artikel_prijs']; ?>
							</td>
							<td>
								<input type="number" value="1" name="aantal" min="1" max="99">
							</td>

						</tr>
					</table>
				</div> 
			<input type="submit" name="bestellen" value="Toevoegen aan winkelwagen"/>
		</form>
	
<?php 
		}
	}

	else
	{
		echo 'Er zitten nog geen producten in uw winkelwagen, klik <a href="?page=artikelen">hier</a> om naar een product te zoeken.';
	}
}
else
{
	$expire = time()+3600 ;
	$aantal = $_POST['aantal'];
	$artikelid = $_GET['artikel_id'];
	$username = $_SESSION['user_name'];

	if(!isset($_COOKIE["wkwebshop_$username"]))
	{
		setcookie("wkwebshop_$username", $artikelid .";". $aantal, $expire);
	}
	else
	{
		setcookie("wkwebshop_$username", $_COOKIE["wkwebshop_$username"].";". $artikelid .";". $aantal, $expire);
	}
	

	header("Location: index.php?page=winkelwagen");
} 
?>
