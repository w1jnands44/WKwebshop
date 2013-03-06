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
			<h1>WK Webshop</h1>
		</div>
		<div class="menu">
			<a href="?page=home">Home</a>|
			<a href="?page=artikelen">Artikelen</a>
			<?php
				if(isset($_SESSION['logged']) && $_SESSION['user_acceslevel'] >= 3)
				{
					echo '|<a href="admin.php">Admin Panel</a>';
				}
			?>
		</div>
		<div class="content_holder">
			<?php
				include 'content_' . $_GET['page'] . '.php';
			?>
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
								<input type="hidden" name="returnpage" value="<?php echo $_SERVER['PHP_SELF'] . "?" . $_GET['page'] ?>">
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