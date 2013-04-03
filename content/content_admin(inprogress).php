<?php
	if(!isset($_SESSION['logged']) || $_SESSION['user_acceslevel'] < 3)
	{
		header("Location: index.php?page=home");
	}

	if(!isset($_GET['action']) || $_GET['action'] == "0")
	{
		?>
		<div style="width:380px;height:380px;">
			<div style="width:120px;height:380px;float:left;">
				<div style="width:120px;height:140px;text-align:center;font-weight:bold;color:black;">
					<a href="index.php?page=admin(inprogress)&action=1" style="text-decoration:none;">
						<img src="images/layout/default_image_product.png" style="width:120px;height:120px;"/>
						Gebruikers
					</a>
				</div>
				<div style="width:120px;height:140px;text-align:center;font-weight:bold;color:black;margin-top:110px;">
					<a href="index.php?page=admin(inprogress)&action=2" >
						<img src="images/layout/default_image_product.png" style="width:120px;height:120px;"/></a>
						Artikelen
					</a>
				</div>
			</div>
			<div style="width:120px;height:380px;float:right;">
				<div style="width:120px;height:140px;text-align:center;font-weight:bold;color:black;">
					<a href="index.php?page=admin(inprogress)&action=3" >
						<img src="images/layout/default_image_product.png" style="width:120px;height:120px;"/></a>
						Merken
					</a>
				</div>
				<div style="width:120px;height:140px;text-align:center;font-weight:bold;color:black;margin-top:110px;">
					<a href="index.php?page=admin(inprogress)&action=4" >
						<img src="images/layout/default_image_product.png" style="width:120px;height:120px;"/></a>
						Categoriën
					</a>
				</div>
			</div>
		</div>
		<?php
	}
	else if($_GET['action'] == "1")
	{
		//Overzicht van gebruikers
		if(isset($_GET['user']))
		{
			include 'connect.php';
			
			$query = "SELECT u.user_id, u.user_name, u.user_image, u.user_acceslevel, k.klant_voornaam, k.klant_achternaam, k.klant_email
				FROM klanten k
				RIGHT JOIN users u ON u.klant_id = k.klant_id
				WHERE u.user_id = " . $_GET['user'];

			$resultaat = mysql_query($query) or die (mysql_error()) ;
			
			$t=1;
			
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
				<form action="register.php" method="POST" enctype="multipart/form-data">
					<table border="0px;">
						<tr><td>Gebruikersnaam:</td><td><input type="text" name="username" maxlength="12" value="<?php echo $row['user_name'] ?>"/></td></tr>
						<tr><td>Functie:</td><td>
							<select name='acceslevel'>
								<?php
									switch ($row['user_acceslevel']) {
									case 0:
										echo '<option value="0">Geen toegang</option>
											<option value="1">Klant</option>
											<option value="2">--no-data--</option>
											<option value="3">Administrator</option>';
										break;
									case 1:
										echo '<option value="1">Klant</option>
											<option value="0">Geen toegang</option>
											<option value="2">--no-data--</option>
											<option value="3">Administrator</option>';
										break;
									case 2:
										echo '<option value="2">--no-data--</option>
											<option value="1">Klant</option>
											<option value="0">Geen toegang</option>
											<option value="3">Administrator</option>';
										break;
									case 3:
										echo '<option value="3">Administrator</option>
											<option value="2">--no-data--</option>
											<option value="1">Klant</option>
											<option value="0">Geen toegang</option>';
										break;
									}
								?>
							</select>
						</td></tr>
						<tr><td>Voornaam:</td><td><input type="text" name="voornaam" maxlength="20" value="<?php echo $row['klant_voornaam'] ?>" <?php if($row['klant_voornaam'] == null || $row['klant_voornaam'] == "") { echo 'disabled'; } ?> /></td></tr>
						<tr><td>Achternaam:</td><td><input type="text" name="achternaam" maxlength="30" value="<?php echo $row['klant_achternaam'] ?>" <?php if($row['klant_voornaam'] == null || $row['klant_voornaam'] == "") { echo 'disabled'; } ?> /></td></tr>
						<tr><td>Email:</td><td><input type="email" name="email" maxlength="45" value="<?php echo $row['klant_email'] ?>" <?php if($row['klant_voornaam'] == null || $row['klant_voornaam'] == "") { echo 'disabled'; } ?> /></td></tr>
						<tr><td>Huide avatar:</td><td><img style="width:150px;height:150px;" alt="can\'t load image." src="<?php echo $image; ?>"/></td></tr>
						<tr><td>Nieuwe avatar:</td><td><input type="file" name="image"/></td></tr>
						<tr><td colspan="2" style="text-align:center;"><input type="submit" value="Aanpassen"/></td></tr>
					</table>
				</form>
				<?php
			}
			
			echo '</table>';
		}
		else
		{
			include 'connect.php';
			
			$query = "SELECT u.user_id, u.user_name, u.user_image, k.klant_voornaam, k.klant_achternaam
				FROM klanten k
				RIGHT JOIN users u ON u.klant_id = k.klant_id";

			$resultaat = mysql_query($query) or die (mysql_error()) ;
			
			echo '<table style="border-collapse:collapse;font-size:18px;font-weight:bold;text-align:center;">
				<tr style="border-bottom:1pt solid black;text-align:right;background-color:#ECF8FF;"><td>Avatar</td><td>Username</td><td>Voornaam</td><td>Achternaam</td></tr>';
			
			$t=1;
			
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
				
				echo '<tr style="border-bottom:1pt solid black;text-align:right;background-color:#';
				if($t%2==1) { echo 'D8E9F4;">'; } else { echo 'ECF8FF;">'; }
			?>
					<td style="width:70px;"><a href="index.php?page=admin(inprogress)&action=1&user= <?php echo $row['user_id'] ?>"><img style="width:60px;height:60px;border:1px solid lightblue;" alt="Can\'t load image" src="<?php echo $image; ?>"/></a></td>
					<td style="width:150px;"><a href="index.php?page=admin(inprogress)&action=1&user= <?php echo $row['user_id'] ?>" style="text-decoration:none;"><span style="font-size:15px;font-weight:bold;"><?php echo $row['user_name']; ?></span><a/></td>
					<td style="width:150px;"><a href="index.php?page=admin(inprogress)&action=1&user= <?php echo $row['user_id'] ?>" style="text-decoration:none;"><span style="font-size:15px;font-weight:bold;"><?php echo $row['klant_voornaam']; ?></span><a/></td>
					<td style="width:150px;"><a href="index.php?page=admin(inprogress)&action=1&user= <?php echo $row['user_id'] ?>" style="text-decoration:none;"><span style="font-size:15px;font-weight:bold;"><?php echo $row['klant_achternaam']; ?></span><a/></td>
				</tr>
			<?php 
				$t++;
			}
			
			echo '</table>';
		}
	}
	else if($_GET['action'] == "2")
	{
		echo "Hier komt overzicht artikelen";
	}
	else if($_GET['action'] == "3")
	{
		echo "Hier komt overzicht merken";
	}
	else if($_GET['action'] == "4")
	{
		echo "Hier komt overzicht categoriën";
	}
?>