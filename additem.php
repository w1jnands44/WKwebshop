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

		$merknaam = ucfirst(strtolower($_POST['merknaam']));
		
		include 'save_image.php';
		
		$query = 'INSERT INTO merken (`merk_naam`, `merk_beschrijving`, `merk_image`) VALUES ("' . $merknaam . '", "' . $_POST['merkbeschrijving'] . '", "' . $target_path . '")';

		mysql_query($query);

		header("Location: index.php?page=" . $_POST['returnpage']);
	}
	else if($_GET['itemid'] == "2")
	{
		
	}
?>