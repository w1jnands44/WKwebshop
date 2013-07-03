<?php
	if(!isset($_SESSION['logged']) || $_SESSION['user_acceslevel'] < 3)
	{
		header("Location: index.php?page=home");
	}
	
	if(!isset($_GET['itemid']) || $_GET['itemid'] == "0")
	{
		include 'connect.php';
		include 'save_image.php';

		$naam = ucfirst(strtolower($_POST['naam']));
		
		if($_FILES['image1']['name'] != null)
		{
			$target_path1 = save_image("images/artikel/" . $naam . "1", $_FILES['image1']['name'], 1);
		}
		else
		{
			$target_path1 = "null";
		}
		
		if($_FILES['image2']['name'] != null)
		{
			$target_path2 = save_image("images/artikel/" . $naam . "2", $_FILES['image2']['name'], 2);
		}
		else
		{
			$target_path2 = "null";
		}
		
		if($_FILES['image3']['name'] != null)
		{
			$target_path3 = save_image("images/artikel/" . $naam . "3", $_FILES['image3']['name'], 3);
		}
		else
		{
			$target_path3 = "null";
		}
		
		$query = 'INSERT INTO artikelen (`merk_id`, `categorie_id`, `artikel_naam`, `artikel_voorraad`, `artikel_beschrijving`, `artikel_prijs`, `artikel_image1`, `artikel_image2`, `artikel_image3`) VALUES ("' . $_POST['merk_id'] . '", "' . $_POST['categorie_id'] . '", "' . $naam . '", "' . $_POST['voorraad'] . '", "' . $_POST['beschrijving'] . '", "' . $_POST['prijs'] . '", "' . $target_path1 . '", "' . $target_path2 . '", "' . $target_path3 . '")';

		mysql_query($query);

		header("Location: index.php?page=" . $_POST['returnpage']);
	}
	else if($_GET['itemid'] == "1")
	{
		include 'connect.php';

		$naam = ucfirst(strtolower($_POST['naam']));
		
		if($_FILES['image']['name'] != null)
		{
			echo "wel image";
			include 'save_image.php';
			$target_path = save_image("images/merk/" . $naam);
		}
		else
		{
			echo "niet image";
			$target_path = "null";
		}
		
		$query = 'INSERT INTO merken (`merk_naam`, `merk_beschrijving`, `merk_image`) VALUES ("' . $naam . '", "' . $_POST['beschrijving'] . '", "' . $target_path . '")';
		
		mysql_query($query);

		header("Location: index.php?page=" . $_POST['returnpage']);
	}
	else if($_GET['itemid'] == "2")
	{
		include 'connect.php';

		$naam = ucfirst(strtolower($_POST['naam']));
		
		if($_FILES['image']['name'] != null)
		{
			include 'save_image.php';
			$target_path = save_image("images/categorie/" . $naam);
		}
		else
		{
			$target_path = "null";
		}
		
		$query = 'INSERT INTO categorie (`categorie_naam`, `categorie_beschrijving`, `categorie_image`) VALUES ("' . $naam . '", "' . $_POST['beschrijving'] . '", "' . $target_path . '")';

		mysql_query($query);

		header("Location: index.php?page=" . $_POST['returnpage']);
	}
?>