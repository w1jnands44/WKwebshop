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
		<div style="width:1000px;height:150px;margin: 0 auto;">
			<div class="header">
				<h1 id="header-title">WK-Webshop</h1>
			</div>
			<div class="login_box">
				<?php
					if(!isset($_SESSION['logged']))
					{
					?>
						<form action="login.php" method="POST">
							<table class="login_form">
								<tr><td>Gebruikersnaam:</td><td><input type="text" name="username" maxlength="12"/></td></tr>
								<tr><td>Wachtwoord:</td><td><input type="password" name="password" maxlength="30"/></td></tr>
								<?php
									if(isset($_GET['error']))
									{
										$error = "";
										
										switch ($_GET['error']) {
											case 0:
												$error = "Gebruiker niet gevonden.";
												break;
											case 1:
												$error = "Wachtwoord komt niet overeen.";
												break;
											case 2:
												$error = "U moet ingelogd zijn.";
												break;
										}
										
										echo '<tr><td colspan="2" style="text-align:center;color:red;">'. $error . '</td></tr>';
									}
								?>
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
		<div class="menu">
			<a href="?page=home"><div class="menu_txt">Home</div></a>
			<a href="?page=artikelen"><div class="menu_txt">Artikelen</div></a>
			<?php
				if(isset($_SESSION['logged']))
				{
					echo '<a href="?page=details"><div class="menu_txt">Account</div></a>';
					if($_SESSION['user_acceslevel'] >= 3)
					{
						echo '<a href="?page=admin"><div class="menu_txt">Admin Panel</div></a>';
					}
				}
			?>
			<a href="?page=winkelwagen" style="float:right;"><img src="images/layout/cart.png" style="float:left;width:40px;height:40px;"/><div class="menu_txt" style="font-size:14px;margin-top:11px;">Winkelwagen</div></a>
		</div>
		<div class="content_holder">
			<div class="side_info">
				
			</div>
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
		</div>
		<div class="footer"></div>
	</body>
</html>