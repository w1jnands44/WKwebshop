<?php
	if(!isset($_SESSION['logged']) || $_SESSION['user_acceslevel'] < 3)
	{
		header("Location: index.php?page=home");
	}

	if(!isset($_GET['action']) || $_GET['action'] == "0")
	{
		?>
		
		<table>
			<tr>
				<td><a href='index.php?page=admin&action=1'>Een gebruiker toevoegen.</a></td>
			</tr>
			<tr>
				<td><a href='index.php?page=admin&action=2'>Een artikel toevoegen.</a></td>
			</tr>
			<tr>
				<td><a href='index.php?page=admin&action=3'>Een merk toevoegen.</a></td>
			</tr>
			<tr>
				<td><a href='index.php?page=admin&action=4'>Een categorie toevoegen.</a></td>
			</tr>
			<tr>
				<td><a href='index.php?page=admin&action=5'>Overzicht van alle gebruikers.</a></td>
			</tr>
			<tr>
				<td><a href='index.php?page=admin&action=6'>Overzicht van alle artikelen.</a></td>
			</tr>
			<tr>
				<td><a href='index.php?page=admin&action=7'>Overzicht van alle merken.</a></td>
			</tr>
			<tr>
				<td><a href='index.php?page=admin&action=8'>Overzicht van alle categori�n.</a></td>
			</tr>
		</table>
		
		<?php
	}
	else if($_GET['action'] == "1")
	{
		if(!isset($_GET['state']) || $_GET['state'] == "0")
		{
			?>
			<h2>Een gebruiker toevoegen</h2>
			<form action='register.php' method="POST" enctype="multipart/form-data">
				<table border="0px;">
					<tr><td>Gebruikersnaam:</td><td><input type="text" name="username" maxlength="12"/></td></tr>
					<tr><td>Wachtwoord:</td><td><input type="password" name="password" maxlength="30"/></td></tr>
					<tr><td colspan="2" style="text-align:center;"><select name='acceslevel'>
						<option value="0">Geen toegang</option>
						<option value="1">Klant</option>
						<option value="2">--no-data--</option>
						<option value="3">Administrator</option>
					</select></td></tr>
					<tr><td>Avatar:</td><td><input type="file" name="image"/></td></tr>
					<tr><td colspan="2" style="text-align:center;"><input type="submit" value="Toevoegen"/></td></tr>
				</table>
				<input type="hidden" name="returnpage" value='admin&action=1&state=1'/>
			</form>
			
			<?php
		}		
		else if($_GET['state'] == "1")
		{
			?>
			
			<p>Gebruiker toegevoegd. <a href="index.php?page=admin">Terugkeren.</a></p>
			
			<?php
		}
	}
	else if($_GET['action'] == "2")
	{
		if(!isset($_GET['state']) || $_GET['state'] == "0")
		{
		?>
			<h2>Een artikel toevoegen</h2>
			<form action='additem.php?itemid=0' method="POST" enctype="multipart/form-data">
				<table border="0px;">
					<tr><td>Naam:</td><td><input type="text" name="naam" maxlength="30"/></td></tr>
					<tr><td>Beschrijving:</td><td><input type="text" name="beschrijving" maxlength="500"/></td></tr>
					<tr><td>Categorie:</td><td><select name="categorie_id">
					<?php
						include 'connect.php';	

						$query = "SELECT * FROM categorie GROUP BY categorie_naam";

						$resultaat = mysql_query($query) or die (mysql_error()) ;

						while ($row = mysql_fetch_array($resultaat)) 
						{
							echo '<option value="' . $row['categorie_id'] . '">' . $row['categorie_naam'] . '</option>';
						}
					?></select><td></tr>
					<tr><td>Merk:</td><td><select name="merk_id">
					<?php
						include 'connect.php';	

						$query = "SELECT * FROM merken GROUP BY merk_naam";

						$resultaat = mysql_query($query) or die (mysql_error()) ;

						while ($row = mysql_fetch_array($resultaat)) 
						{
							echo '<option value="' . $row['merk_id'] . '">' . $row['merk_naam'] . '</option>';
						}
					?>
					</select></td></tr>
					<tr><td>Begin voorraad</td><td><input type="number" min="0" max="99" name="voorraad"/></td></tr>
					<tr><td>Prijs</td><td><input type="text" maxlength="10" name="prijs"/></td></tr>
					<tr><td>Afbeelding 1:</td><td><input type="file" name="image1"/></td></tr>
					<tr><td>Afbeelding 2:</td><td><input type="file" name="image2"/></td></tr>
					<tr><td>Afbeelding 3:</td><td><input type="file" name="image3"/></td></tr>
					<tr><td colspan="2" style="text-align:center;"><input type="submit" value="Toevoegen"/></td></tr>
				</table>
				<input type="hidden" name="returnpage" value='admin&action=2&state=1'/>
			</form>
		<?php
		}
		else if($_GET['state'] == "1")
		{
			?>
			
			<p>Artikel toegevoegd. <a href="index.php?page=admin">Terugkeren.</a></p>
			
			<?php
		}
	}
	else if($_GET['action'] == "3")
	{
		if(!isset($_GET['state']) || $_GET['state'] == "0")
		{
			?>
			<h2>Een merk toevoegen</h2>
			<form action='additem.php?itemid=1' method="POST" enctype="multipart/form-data">
				<table border="0px;">
					<tr><td>Naam:</td><td><input type="text" name="naam" maxlength="30"/></td></tr>
					<tr><td>Beschrijving:</td><td><input type="text" name="beschrijving" maxlength="500"/></td></tr>
					<tr><td>Afbeelding:</td><td><input type="file" name="image"/></td></tr>
					<tr><td colspan="2" style="text-align:center;"><input type="submit" value="Toevoegen"/></td></tr>
				</table>
				<input type="hidden" name="returnpage" value='admin&action=3&state=1'/>
			</form>
			<?php
		}		
		else if($_GET['state'] == "1")
		{
			?>
			
			<p>Merk toegevoegd. <a href="index.php?page=admin">Terugkeren.</a></p>
			
			<?php
		}
	}
	else if($_GET['action'] == "4")
	{
		if(!isset($_GET['state']) || $_GET['state'] == "0")
		{
			?>
			<h2>Een categorie toevoegen</h2>
			<form action='additem.php?itemid=2' method="POST" enctype="multipart/form-data">
				<table border="0px;">
					<tr><td>Naam:</td><td><input type="text" name="naam" maxlength="30"/></td></tr>
					<tr><td>Beschrijving:</td><td><input type="text" name="beschrijving" maxlength="500"/></td></tr>
					<tr><td>Afbeelding:</td><td><input type="file" name="image"/></td></tr>
					<tr><td colspan="2" style="text-align:center;"><input type="submit" value="Toevoegen"/></td></tr>
				</table>
				<input type="hidden" name="returnpage" value='admin&action=4&state=1'/>
			</form>
			<?php
		}		
		else if($_GET['state'] == "1")
		{
			?>
			
			<p>Categorie toegevoegd. <a href="index.php?page=admin">Terugkeren.</a></p>
			
			<?php
		}
	}
	else if($_GET['action'] == "5")
	{
		include 'connect.php';
		
		//$query = "SELECT * FROM users GROUP BY user_name";
		
		$query = "SELECT u.user_id, u.user_name, u.user_image, u.user_acceslevel, k.klant_id, k.klant_voornaam, k.klant_achternaam, k.klant_email, klant_tel, klant_straat, klant_plaats, klant_postcode
					FROM klanten k
					RIGHT JOIN users u ON u.klant_id = k.klant_id";
					//WHERE u.user_id = " . $_GET['user'];
		
		$resultaat = mysql_query($query) or die (mysql_error()) ;
		
		echo '<table style="border-collapse:collapse;font-size:16px;font-weight:bold;text-align:center;">
		<tr style="border-bottom:1pt solid black;">
			<td>Avatar</td>
			<td>Username</td>
			<td>Voornaam</td>
			<td>Achternaam</td>
			<td>Telefoon</td>
			<td>Adres</td>
			<td>email</td>
		</tr>';
		
		while ($row = mysql_fetch_array($resultaat)) 
		{
			if($row['user_image'] == null || $row['user_image'] == "" || $row['user_image'] == "null")
			{
				$image = "images/layout/default_image_user.png";
			}
			else
			{
				$image = $row['user_image'];
			}
		?>
			<tr style="border-bottom:1pt solid black;text-align:right;">
				<td><img style="width:50px;height:50px;border:1px solid lightblue;" alt="Can\'t load image" src="<?php echo $image; ?>"/></td>
				<td><span style="font-size:14px;font-weight:bold;"><?php echo $row['user_name']; ?></span></td>
				<td><span style="font-size:14px;font-weight:bold;"><?php echo $row['klant_voornaam']; ?></span></td>
				<td><span style="font-size:14px;font-weight:bold;"><?php echo $row['klant_achternaam']; ?></span></td>
				<td><span style="font-size:14px;font-weight:bold;"><?php echo $row['klant_tel']; ?></span></td>
				<td><span style="font-size:14px;font-weight:bold;"><?php echo $row['klant_straat'] . $row['klant_postcode'] . $row['klant_plaats']; ?></span></td>
				<td><span style="font-size:14px;font-weight:bold;"><?php echo $row['klant_email']; ?></span></td>
			</tr>
		<?php 
		}
		
		echo '</table>';
	}
	else if($_GET['action'] == "6")
	{
		include 'connect.php';
		
		$query = "SELECT a.artikel_id, a.artikel_naam, a.artikel_voorraad, a.artikel_beschrijving, a.artikel_prijs, a.artikel_image1, a.artikel_image2, a.artikel_image3, a.merk_id, a.categorie_id, m.merk_id, m.merk_naam, c.categorie_id, c.categorie_naam
		FROM artikelen a
		RIGHT JOIN merken m ON a.merk_id = m.merk_id
		RIGHT JOIN categorie c ON a.categorie_id = c.categorie_id";

		$resultaat = mysql_query($query) or die (mysql_error()) ;
		
		echo '<table style="border-collapse:collapse;font-size:18px;font-weight:bold;text-align:center;">
		<tr style="border-bottom:1pt solid black;">
			<td>Afbeelding</td>
			<td>Naam</td>
			<td>Merk</td>
			<td>Categorie</td>
			<td>Voorraad</td>
			<td>Prijs</td>
		</tr>';
		
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
			<tr style="border-bottom:1pt solid black;text-align:right;">
				<td><img style="width:100px;height:100px;border:1px solid lightblue;" alt="Can\'t load image" src="<?php echo $image; ?>"/></td>
				<td><span style="font-size:22px;font-weight:bold;"><?php echo $row['artikel_naam']; ?></span></td>
				<td><span style="font-size:22px;font-weight:bold;"><?php echo $row['merk_naam']; ?></span></td>
				<td><span style="font-size:22px;font-weight:bold;"><?php echo $row['categorie_naam']; ?></span></td>
				<td><span style="font-size:22px;font-weight:bold;"><?php echo $row['artikel_voorraad']; ?></span></td>
				<td><span style="font-size:22px;font-weight:bold;"><?php echo $row['artikel_prijs']; ?></span></td>
			</tr>
		<?php 
		}
		
		echo '</table>';
	}
	else if($_GET['action'] == "7")
	{
		include 'connect.php';
		
		$query = "SELECT * FROM merken GROUP BY merk_naam";

		$resultaat = mysql_query($query) or die (mysql_error()) ;
		
		echo '<table style="border-collapse:collapse;font-size:18px;font-weight:bold;text-align:center;">
		<tr style="border-bottom:1pt solid black;">
			<td>Afbeelding</td>
			<td>Naam</td>
		</tr>';
		
		while ($row = mysql_fetch_array($resultaat)) 
		{
			if($row['merk_image'] == null || $row['merk_image'] == "" || $row['merk_image'] == "null")
			{
				$image = "images/layout/default_image_product.png";
			}
			else
			{
				$image = $row['merk_image'];
			}
		?>
			<tr style="border-bottom:1pt solid black;text-align:right;">
				<td><img style="width:100px;height:100px;border:1px solid lightblue;" alt="Can\'t load image" src="<?php echo $image; ?>"/></td>
				<td><span style="font-size:22px;font-weight:bold;"><?php echo $row['merk_naam']; ?></span></td>
			</tr>
		<?php 
		}
		
		echo '</table>';
	}
	else if($_GET['action'] == "8")
	{
		include 'connect.php';
		
		$query = "SELECT * FROM categorie GROUP BY categorie_naam";

		$resultaat = mysql_query($query) or die (mysql_error()) ;
		
		echo '<table style="border-collapse:collapse;font-size:18px;font-weight:bold;text-align:center;">
		<tr style="border-bottom:1pt solid black;">
			<td>Afbeelding</td>
			<td>Naam</td>
		</tr>';
		
		while ($row = mysql_fetch_array($resultaat)) 
		{
			if($row['categorie_image'] == null || $row['categorie_image'] == "" || $row['categorie_image'] == "null")
			{
				$image = "images/layout/default_image_product.png";
			}
			else
			{
				$image = $row['categorie_image'];
			}
		?>
			<tr style="border-bottom:1pt solid black;text-align:right;">
				<td><img style="width:100px;height:100px;border:1px solid lightblue;" alt="Can\'t load image" src="<?php echo $image; ?>"/></td>
				<td><span style="font-size:22px;font-weight:bold;"><?php echo $row['categorie_naam']; ?></span></td>
			</tr>
		<?php 
		}
		
		echo '</table>';
	}
?>