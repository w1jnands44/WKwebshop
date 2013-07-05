<?php
include 'connect.php';

if(isset($_POST['voornaam']))
{
	echo "voornaam set" . $_POST['email'];
	
	if(isset($_POST['email']))
	{
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			header("Location: index.php?page=register&error=3");
			//echo "invalid";
		}
	}
	
	$voornaam = ucfirst(strtolower($_POST['voornaam']));
	$achternaam =  ucfirst(strtolower($_POST['achternaam']));

	$query = 'INSERT INTO klanten (`klant_voornaam`, `klant_achternaam`, `klant_email`, `klant_tel`, `klant_straat`, `klant_plaats`, `klant_postcode`) VALUES ("' . $voornaam . '", "' . $achternaam . '", "' . $_POST['email'] . '", "' . $_POST['telefoon'] . '", "' . $_POST['straat'] . '", "' . $_POST['plaats'] . '", "' . $_POST['postcode'] . '")';

	mysql_query($query);

	$klant_id = mysql_insert_id();
	
	if($_FILES['image']['name'] != null)
	{
		include 'save_image.php';
		$target_path = save_image("images/user/" . $_POST['username']);
	}
	else
	{
		$target_path = null;
	}
	
	include 'encrypt.php';

	$password = encrypt($_POST['password'], $_POST['username']);

	$query = 'INSERT INTO users (`klant_id`, `user_name`, `user_password`, `user_acceslevel`, `user_image`) VALUES ("' . $klant_id . '", "' . $_POST['username'] . '", "' . $password. '", "' . $_POST['acceslevel'] . '", "' . $target_path . '")';

	mysql_query($query);
}
else
{	
	if($_FILES['image']['name'] != null)
	{
		include 'save_image.php';
		$target_path = save_image("images/user/" . $_POST['username']);
	}
	else
	{
		$target_path = null;
	}
	
	include 'encrypt.php';

	$password = encrypt($_POST['password'], $_POST['username']);

	$query = 'INSERT INTO users (`user_name`, `user_password`, `user_acceslevel`, `user_image`) VALUES ("' . $_POST['username'] . '", "' . $password. '", "' . $_POST['acceslevel'] . '", "' . $target_path . '")';
	
	mysql_query($query);
}

//header("Location: index.php?page=" . $_POST['returnpage']);
?>