<?php
include 'connect.php';

/*
$username = $_POST['username'];
$password = $_POST['password'];
$voornaam = $_POST['voornaam'];
$achternaam = $_POST['achternaam'];
$email = $_POST['email'];
$acceslevel = $POST['acceslevel'];
*/

$query = 'INSERT INTO klanten (`klant_voornaam`, `klant_achternaam`, `klant_email`) VALUES ("' . $_POST['voornaam'] . '", "' . $_POST['achternaam'] . '", "' . $POST['email'] . '")';

mysql_query($query);

$klant_id = mysql_insert_id();

include 'encrypt.php';

$password = encrypt($POST['password'], $_POST['username']);

$query = 'INSERT INTO users (`klant_id`, `user_name`, `user_password`, `user_acceslevel`) VALUES ("' . $_POST['klant_id'] . '", "' . $_POST['username'] . '", "' . $_POST['password']. '", "' . $_POST['acceslevel'] . '")';

mysql_query($query);

header("Location: index.php?page=" . $_POST['returnpage']);
?>