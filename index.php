<html>
	<head>
		<title>WK Webshop</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<?php 
			session_start(); 
			if(!isset($_GET['page']))
			{
				$_GET['page'] = "home";
			}
		?>
	</head>
	
	<body>
		<div class="header">
		</div>
		<div class="menu">
			<a href="?page=home">Home</a>|
			<a href="?page=artikelen">Artikelen</a>
			<?php
				if(isset($_SESSION['logged']) && $_SESSION['user_acceslevel'] >= 3)
				{
					echo '|<a href="?page=admin">Admin Panel</a>';
				}
			?>
		</div>
		<div class="content_holder">
			<div class="content">
				<?php
					$filename = 'content/content_' . $_GET['page'] . '.php';
					
					if(file_exists ($filename))
					{
						include $filename;
					}
					else
					{
						include 'content/content_home.php';
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
									<input type="hidden" name="returnpage" value="<?php echo $_SERVER['PHP_SELF'] . "?page=" . $_GET['page'] ?>">
									<tr><td colspan="2" style="text-align:center;">Nog geen account? Registreer <a href="index.php?page=register">hier</a>.</td></tr>
								</table>
							</form>
						<?php
						}
						else
						{
							if(!isset($_SESSION['klant_voornaam']))
							{
								echo '<div class="login_message"><img style="width:50px;height:50px;float:left;" alt="can\'t load image." src="' . $_SESSION['user_image'] . '"/><p style="text-align:center;">Welkom <a href="index.php?page=details">' . $_SESSION['user_name'] . '</a>.<a href="logout.php?returnpage=' . $_SERVER['PHP_SELF'] . '">Uitloggen.</a></p></div>';
							}
							else
							{
								echo '<div class="login_message"><p style="text-align:center;">Welkom <a href="index.php?page=details">' . $_SESSION['klant_voornaam'] . " " . $_SESSION['klant_achternaam'] . '</a>.<a href="logout.php?returnpage=' . $_SERVER['PHP_SELF'] . '">Uitloggen.</a></p></div>';
							}
						}
					?>
					</div>
				</div>
		</div>
		<div class="footer"></div>
	</body>
</html>