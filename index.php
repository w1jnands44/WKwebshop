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
			<a href="?page=home"><div class="menu_txt">Home</div></a>
			<a href="?page=artikelen"><div class="menu_txt">Artikelen</div></a>
			<?php
				if(isset($_SESSION['logged']) && $_SESSION['user_acceslevel'] >= 3)
				{
					echo '<a href="?page=admin"><div class="menu_txt">Admin Panel</div></a>';
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
									<tr><td>Gebruikersnaam:</td><td><input type="text" name="username" maxlength="12"/></td></tr>
									<tr><td>Wachtwoord:</td><td><input type="password" name="password" maxlength="30"/></td></tr>
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
							?>
								<div class="login_message">
									<div class="user_info_holder">
										<a href="index.php?page=details&action=2"><img class="user_image" alt="can\'t load image." src="<?php echo $_SESSION['user_image']; ?>"/></a>
										<div style="width:70px;height:45px;float:left;">
											<span style="margin-top:28px;margin-left:7px;float:left;font-size:14px;"><a href="logout.php?returnpage=<?php echo $_SERVER['PHP_SELF']; ?>">Uitloggen.</a></span>
											<span style="margin-top:3px;margin-left:7px;float:left;font-size:20px;font-weight:bold;"><a href="index.php?page=details"><?php echo $_SESSION['user_name']; ?></a></span>
										</div>
									</div>
								</div>
							<?php
							}
							else
							{
							?>
								<div class="login_message">
									<img class="user_image" alt="can\'t load image." src="<?php echo $_SESSION['user_image']; ?>"/>
									<p style="text-align:center;"><a href="index.php?page=details"><?php echo $_SESSION['klant_voornaam'] . " " . $_SESSION['klant_achternaam']; ?></a>.
									<a href="logout.php?returnpage=<?php echo $_SERVER['PHP_SELF']; ?>">Uitloggen.</a></p>
								</div>
							<?php
							}
						}
					?>
					</div>
				</div>
		</div>
		<div class="footer"></div>
	</body>
</html>