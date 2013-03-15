<?php
include 'connect.php';

/*
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$acceslevel = $POST['acceslevel'];
*/

$voornaam = ucfirst(strtolower($_POST['voornaam']));
$achternaam =  ucfirst(strtolower($_POST['achternaam']));

$query = 'INSERT INTO klanten (`klant_voornaam`, `klant_achternaam`, `klant_email`) VALUES ("' . $voornaam . '", "' . $achternaam . '", "' . $_POST['email'] . '")';

mysql_query($query);

$klant_id = mysql_insert_id();

include 'encrypt.php';

$password = encrypt($_POST['password'], $_POST['username']);

$query = 'INSERT INTO users (`klant_id`, `user_name`, `user_password`, `user_acceslevel`) VALUES ("' . $klant_id . '", "' . $_POST['username'] . '", "' . $password. '", "' . $_POST['acceslevel'] . '")';

mysql_query($query);

header("Location: index.php?page=" . $_POST['returnpage']);
?>