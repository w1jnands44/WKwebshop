<?php
include 'connect.php';

$username = $_POST['username'];
$password = $_POST['password'];
$voornaam = $_POST['voornaam'];
$achternaam = $_POST['achternaam'];
$email = $_POST['email'];

$query = 'INSERT INTO klanten (`klant_voornaam`, `klant_achternaam`, `klant_email`) VALUES ("' . $voornaam . '", "' . $achternaam . '", "' . $email . '")';

mysql_query($query);

$klant_id = mysql_insert_id();

include 'encrypt.php';

$password = encrypt($password, $username);

$query = 'INSERT INTO users (`klant_id`, `user_name`, `user_password`, `user_acceslevel`) VALUES ("' . $klant_id . '", "' . $username . '", "' . $password. '", "1")';

mysql_query($query);

header("Location: index.php?page=home");
?>