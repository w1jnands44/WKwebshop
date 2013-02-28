<?php
	session_start();
	
	if (!isset($_SESSION['logged']))
	{
		header("Location: index.php");
	}
	
	if($_SESSION['user_acceslevel'] < 3)
	{
		header("Location: index.php");
	}
?>
<html>
	<head>
		<title>WK Webshop</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	
	<body>
		<div class="header">
			<h1>WK Webshop</h1>
		</div>
		<div class="menu">
			<a href="index.php">Home</a>|
			<a href="#">Artikelen</a>
			<?php
				if($_SESSION['logged'] && $_SESSION['user_acceslevel'] >= 3)
				{
					echo '|<a href="admin.php">Admin Panel</a>';
				}
			?>
		</div>
		<div class="content_holder">
			<div class="content">
				
					<?php
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
								
								//$username = md5($username);
								//$password = md5($password);
								
								$sql = mysql_query("SELECT user_name FROM users WHERE user_name='$username'");
								while ($data = mysql_fetch_array($sql)) {
									$db_username = $data['username'];
								}
								
								if (!empty($db_username)) 
								{
									echo '<p style="margin-top:10%;">Gebruiker bestaat al!</p>';
								}
								else
								{
									mysql_query("INSERT INTO users (user_name, user_password, user_acceslevel, user_voornaam, user_achternaam) VALUES('" . $username . "','" . $password . "','" . $_POST['acceslevel'] . "','" . $_POST['voornaam'] . "','" . $_POST['achternaam'] . "')");
									echo "<p style='margin-top:10%;'>Gebruiker aangemaakt!</p>";
								}
								
								mysql_close($connect);							
							}
							else
							{
							?>
								<h3 style="margin-top:10%;">Gebruiker registreren</h3>
								
								<table border='0px'>
									<form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
										<tr><td>Gebruikersnaam:</td><td><input type='text' name='username'></td></tr>
										<tr><td>Wachtwoord:</td><td><input type='password' name='password'></td></tr>
										<tr><td>Voornaam:</td><td><input type='text' name='voornaam'></td></tr>
										<tr><td>Achternaam:</td><td><input type='text' name='achternaam'></td></tr>
										<tr><td>Acces level:</td><td>
										<select name='acceslevel'>
										   <option value="0">Geen toegang</option>
										   <option value="1">Gast</option>
										   <option value="2">Gebruiker</option>
										   <option value="3">Administrator</option>
										</select></td></tr>
										<tr><td></td><td><input id='submit_btn' type='submit' name='submit' value='Registreren'></td></td>
									</form>
								</table>
							<?php
							}
						}
					?>
			</div>
			<div class="side_info">
				<div class="login_box">
				<?php
					if(!isset($_SESSION['logged']))
					{
					?>
						<form action="login.php" method="POST">
							<table class="login_form">
								<tr><td>Gebruikersnaam:</td><td><input type="text" name="username"/></td></tr>
								<tr><td>Wachtwoord:</td><td><input type="password" name="password"/></td></tr>
								<tr><td colspan="2" style="text-align:center;"><input type="submit" value="Inloggen"/></td></tr>
							</table>
						</form>
					<?php
					}
					else
					{
						echo '<div class="login_message"><p>Welkom <a href="details.php">' . $_SESSION['user_voornaam'] . " " . $_SESSION['user_achternaam'] . '</a>.<a href="logout.php?returnpage=' . $_SERVER['PHP_SELF'] . '">Uitloggen.</a></p></div>';
					}
				?>
				</div>
			</div>
		</div>
		<div class="footer"></div>
	</body>
</html>