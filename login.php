<?php
	session_start();
	
	if (isset($_POST['username']) AND isset($_POST['password'])) {
		
		include 'connect.php';
		
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);

		include 'encrypt.php';
	
		$sql = mysql_query("SELECT * FROM users WHERE user_name='$username'");
		while ($data = mysql_fetch_array($sql))
		{
			$db_user_id = $data['user_id'];
			$db_klant_id = $data['klant_id'];
			$db_user_name = $data['user_name'];
			$db_password = $data['user_password'];
			$db_acceslevel = $data['user_acceslevel'];
			$db_image = $data['user_image'];
		}
	
		if (empty($db_user_name)) {
			echo 'Gebruiker niet gevonden';
		}
		else 
		{
			if (validate_password($password, $username, $db_password))
			{
				if (!empty($db_klant_id)) {
					$sql = mysql_query("SELECT * FROM klanten WHERE klant_id='$db_klant_id'");
				
					$data = mysql_fetch_array($sql);
					
					$_SESSION['klant_id'] = $data['klant_id'];
					$_SESSION['klant_voornaam'] = $data['klant_voornaam'];
					$_SESSION['klant_achternaam'] = $data['klant_achternaam'];
					$_SESSION['klant_email']= $data['klant_email'];
				}

				$_SESSION['user_id'] = $db_user_id;
				$_SESSION['user_name'] = $db_user_name;
				$_SESSION['user_password'] = $db_password;
				$_SESSION['user_acceslevel'] = $db_acceslevel;
				
				if($db_image == null)
				{
					$_SESSION['user_image'] = "images/layout/default_user_image.png";
				}
				else
				{
					$_SESSION['user_image'] = $db_image;
				}

				$_SESSION['logged'] = true;
				header("Location: " . $_POST['returnpage']);
			}
			
			echo 'Wachtwoord incorrect';
		}
		
		mysql_close($connect);
	}
?>