<?php
	if(!isset($_GET['state']))
	{
		$_GET['state'] = "0";
	}
	
	if($_GET['state'] == "0")
	{
		
	}
	else if($_GET['state'] == "1")
	{
		?>
		
		<form action='index.php?page=content_admin&state="1"' method="POST">
			<table border="0px;">
				<tr><td>Gebruikersnaam:</td><td><input type="text" name="username"/></td></tr>
				<tr><td>Wachtwoord:</td><td><input type="password" name="password"/></td></tr>
				<select name='acceslevel'>
					<option value="0">Geen toegang</option>
					<option value="1">Klant</option>
					<option value="2">--no-data--</option>
					<option value="3">Administrator</option>
				</select></td></tr>
				<tr><td colspan="2" style="text-align:center;"><input type="submit" value="Registreer"/></td></tr>
			</table>
			<input type="hidden" name="returnpage" value='content_admin&state="3"'/>
		</form>
		
		<?php
	}
	else if($_GET['state'] == "2")
	{
		include 'connect.php';

		/*
		$username = $_POST['username'];
		$password = $_POST['password'];
		$voornaam = $_POST['voornaam'];
		$achternaam = $_POST['achternaam'];
		$email = $_POST['email'];
		$acceslevel = $POST['acceslevel'];
		*/

		$query = 'INSERT INTO klanten (`klant_voornaam`, `klant_achternaam`, `klant_email`) VALUES ("' . $_POST['voornaam'] . '", "' . $_POST['achternaam'] . '", "' . $POST['email'] . '")';

		mysql_query($query);

		$klant_id = mysql_insert_id();

		include 'encrypt.php';

		$password = encrypt($POST['password'], $_POST['username']);

		$query = 'INSERT INTO users (`klant_id`, `user_name`, `user_password`, `user_acceslevel`) VALUES ("' . $_POST['klant_id'] . '", "' . $_POST['username'] . '", "' . $_POST['password']. '", "' . $_POST['acceslevel'] . '")';

		mysql_query($query);

		header("Location: index.php?page=" . $_POST['returnpage']);
	}
	else if($_GET['state'] == "3")
	{
		?>
		
		<p>Gebruiker toegevoegd. <a href="index.php?page=content_admin">Terugkeren.</a></p>
		
		<?php
	}
	
/*
	if ($_SESSION['user_acceslevel'] < 3)
	{
		echo "<p style='margin-top:10%;'>U heeft geen toegang to deze content!</p>";
	}
	else
	{
		if (isset($_POST['username']))
	{
	
	$connect_host = "localhost";
	$connect_username = "root";
	$connect_pass = "";
	$connect_name = "wkwebshop";
	
	$connect = mysql_connect("$connect_host", "$connect_username", "$connect_pass") or die ("Could not connect to MySQL!");
	mysql_select_db("$connect_name") or die ("Could not connect to database!");
	
	$username = $_POST['username'];
	$password = $_POST['password'];
						
						/*
						$salt = base64_encode(mcrypt_create_iv(PBKDF2_SALT_BYTES, MCRYPT_DEV_URANDOM));
						
						$username = create_hash($username, $salt);
						$password = create_hash($username, $salt);
						*/
						
	/*$sql = mysql_query("SELECT user_name FROM users WHERE user_name='$username'");
	while ($data = mysql_fetch_array($sql)) 
	{
		$db_username = $data['user_name'];
	}
	
	if (!empty($db_username)) 
	{
		echo '<p style="margin-top:10%;">Gebruiker bestaat al!</p>';
	}
	else
	{
		mysql_query("INSERT INTO users (user_name, user_password, user_acceslevel, user_salt) VALUES('" . $username . "','" . $password . "','" . $_POST['acceslevel'] . "','" . $salt . "')");
		echo "<p style='margin-top:10%;'>Gebruiker aangemaakt!</p>";
	}
		
	mysql_close($connect);							
}
	else
	{
?>
	<h3 style="margin-top:10%;">Gebruiker registreren</h3>
						
		<table border='0px'>
			<form action='<?php echo $_SERVER['PHP_SELF'] . "?" . $_GET['page']; ?>' method='post'>
			<tr><td>Gebruikersnaam:</td><td><input type='text' name='username'></td></tr>
			<tr><td>Wachtwoord:</td><td><input type='password' name='password'></td></tr>
			<!--<tr><td>Voornaam:</td><td><input type='text' name='voornaam'></td></tr>
			<tr><td>Achternaam:</td><td><input type='text' name='achternaam'></td></tr>-->
			<tr>
				<td>Acces level:</td>
				<td>
					<select name='acceslevel'>
							<option value="0">Geen toegang</option>
							<option value="1">Gebruiker</option>
							<option value="2">Klant</option>
							<option value="3">Administrator</option>
					</select>
					</td>
				</tr>
				<tr><td></td><td><input id='submit_btn' type='submit' name='submit' value='Registreren'></td></td>
			</form>
		</table>
	<?php
	}
}*/
?>