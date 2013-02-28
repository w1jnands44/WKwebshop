<?php
	session_start();
	
	if (isset($_POST['username']) AND isset($_POST['password'])) {

		$connect_host = "localhost";
		$connect_username = "root";
		$connect_pass = "";
		$connect_name = "wkwebshop";
				
		$connect = mysql_connect("$connect_host", "$connect_username", "$connect_pass") or die ("Could not connect to MySQL!");
		mysql_select_db("$connect_name") or die ("Could not connect to database!");
				
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);
				
		//$username = md5($username);
		//$password = md5($password);
				
		$sql = mysql_query("SELECT * FROM users WHERE user_name='$username'");
		while ($data = mysql_fetch_array($sql)) 
		{
			$db_user_id = $data['user_id'];
			$db_username = $data['user_name'];
			$db_password = $data['user_password'];
			$db_acceslevel = $data['user_acceslevel'];
			$db_voornaam = $data['user_voornaam'];
			$db_achternaam = $data['user_achternaam'];
		}
				
		mysql_close($connect);
				
		if (empty($db_username)) {
			echo 'Gebruiker niet gevonden';
		}
		else 
		{
			if ($db_password == $password) 
			{
				$_SESSION['user_id'] = $db_user_id;
				$_SESSION['user_acceslevel'] = $db_acceslevel;
				$_SESSION['user_voornaam'] = $db_voornaam;
				$_SESSION['user_achternaam'] = $db_achternaam;
				$_SESSION['logged'] = true;
				header("Location: " . $_POST['returnpage']);
			}
			
			echo 'Wachtwoord incorrect';
		}
	}
?>