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
			<a href="index.php?page=home">Home</a>|
			<a href="#">Artikelen</a>
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
		</div>
		<div class="footer"></div>
	</body>
</html>