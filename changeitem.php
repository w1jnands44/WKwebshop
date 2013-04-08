<?php
include 'connect.php';

if(isset($_POST['voornaam']))
{
	$voornaam = ucfirst(strtolower($_POST['voornaam']));
	$achternaam =  ucfirst(strtolower($_POST['achternaam']));

	$query = 'UPDATE klanten SET klant_voornaam = "' . $voornaam . '", klant_achternaam = "' . $achternaam . '", klant_email = "' . $_POST['email'] . '" WHERE klant_id = ' . $_POST['klantid'];

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

	$query = 'UPDATE users SET user_name="' . $_POST['username'] . '", user_acceslevel = ' . $_POST['acceslevel'] . ', user_image = "' . $target_path . '" WHERE user_id = ' . $_POST['userid'];

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

	$query = 'UPDATE users SET user_name="' . $_POST['username'] . '", user_acceslevel = ' . $_POST['acceslevel'] . ', user_image = "' . $target_path . '" WHERE user_id = ' . $_POST['userid'];
	
	mysql_query($query);
}

header("Location: index.php?page=" . $_POST['returnpage']);
?>