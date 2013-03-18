<?php
	if(!isset($_SESSION['logged']) || $_SESSION['user_acceslevel'] < 3)
	{
		//header("Location: index.php?page=home");
	}
	
	if(!isset($_GET['itemid']) || $_GET['itemid'] == "0")
	{
		
	}
	else if($_GET['itemid'] == "1")
	{
		include 'connect.php';

		$naam = ucfirst(strtolower($_POST['naam']));
		
		$extension = end(explode(".", $_FILES['image']['name']));

		$target_path = "images/merk/" . $naam . "." . $extension;
		
		include 'save_image.php';
		
		$query = 'INSERT INTO merken (`merk_naam`, `merk_beschrijving`, `merk_image`) VALUES ("' . $naam . '", "' . $_POST['beschrijving'] . '", "' . $target_path . '")';

		mysql_query($query);

		header("Location: index.php?page=" . $_POST['returnpage']);
	}
	else if($_GET['itemid'] == "2")
	{
		include 'connect.php';

		$naam = ucfirst(strtolower($_POST['naam']));
		
		$extension = end(explode(".", $_FILES['image']['name']));

		$target_path = "images/categorie/" . $naam . "." . $extension;
		
		include 'save_image.php';
		
		$query = 'INSERT INTO categorie (`categorie_naam`, `categorie_beschrijving`, `categorie_image`) VALUES ("' . $naam . '", "' . $_POST['beschrijving'] . '", "' . $target_path . '")';

		mysql_query($query);

		header("Location: index.php?page=" . $_POST['returnpage']);
	}
?>