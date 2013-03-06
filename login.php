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

		include 'encrypt.php';
		
		$password = create_hash($password);
				
		$sql = mysql_query("SELECT * FROM users WHERE user_name='$username'");
		while ($data = mysql_fetch_array($sql))
		{
			$db_user_id = $data['user_id'];
			$db_user_name = $data['user_name'];
			$db_password = $data['user_password'];
			$db_acceslevel = $data['user_acceslevel'];
		}
				
		mysql_close($connect);
				
		if (empty($db_user_name)) {
			echo 'Gebruiker niet gevonden';
		}
		else 
		{
			if (validate_password($password, $db_password)) 
			{
				$sql = mysql_query("SELECT * FROM klanten WHERE klant_id='$db_user_id'");
				while ($data = mysql_fetch_array($sql))
				{
					$_SESSION['klant_id']= $data['klant_id'];
					$_SESSION['klant_voornaam'] = $data['klant_voornaam'];
					$_SESSION['klant_achternaam'] = $data['klant_achternaam'];
					$_SESSION['klant_email']= $data['user_acceslevel'];
				}
				
				$_SESSION['user_id'] = $db_user_id;
				$_SESSION['user_name'] = $db_user_name;
				$_SESSION['user_acceslevel'] = $db_acceslevel;
				$_SESSION['logged'] = true;
				header("Location: " . $_POST['returnpage']);
			}
			
			echo 'Wachtwoord incorrect';
		}
	}
?>