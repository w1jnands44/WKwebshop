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
				<td><a href='index.php?page=admin&action=1'>Een gebruiker toevoegen</a></td>
			</tr>
			<tr>
				<td><a href='index.php?page=admin&action=2'>Een artikel toevoegen</a></td>
			</tr>
			<tr>
				<td><a href='index.php?page=admin&action=3'>Een merk toevoegen</a></td>
			</tr>
			<tr>
				<td><a href='index.php?page=admin&action=4'>Een categorie toevoegen</a></td>
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
			<form action='register.php' method="POST">
				<table border="0px;">
					<tr><td>Gebruikersnaam:</td><td><input type="text" name="username"/></td></tr>
					<tr><td>Wachtwoord:</td><td><input type="password" name="password"/></td></tr>
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
					<tr><td>Afbeelding:</td><td><input type="file" name="image"/></td></tr>
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
	else if($get['action'] == "5")
	{
		echo "Nog geen content...";
	}
?>