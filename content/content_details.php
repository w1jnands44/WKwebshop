<?php
	if(!isset($_SESSION['logged']) || $_SESSION['user_acceslevel'] < 1)
	{
		header("Location: index.php?page=home");
	}
	
	if(!isset($_GET['action']) || $_GET['action'] == "0")
	{
		?>
		<table>
			<tr><td>Gebruikersnaam:</td><td><?php echo $_SESSION['user_name'] ?></td></tr>
			<tr><td colspan="2" style="text-align:center;"><a href="index.php?page=details&action=1">Wachtwoord wijzigen?</a></td></tr>
			<tr><td colspan="2" style="text-align:center;"><a href="index.php?page=details&action=2">Avatar wijzigen?</a></td></tr>
		</table>
		<?php
	}
	else if($_GET['action'] == "1")
	{
		if(!isset($_GET['state']) || $_GET['state'] == "0")
		{
		?>
			<form action="index.php?page=details&action=1&state=1" method="POST">
				<table>
					<tr><td>Huidige wachtwoord:</td><td><input type="password" name="currentpassword"/></td></tr>
					<tr><td>Nieuwe wachtwoord:</td><td><input type="password" name="newpassword"/></td></tr>
					<tr><td colspan="2" style="text-align:center;"><input type="submit" value="Veranderen"/></td></tr>
				</table>
			</form>
			
			<a href="index.php?page=details">Annuleren</a>
		<?php
		}
		else if($_GET['state'] == "1")
		{
			include 'encrypt.php';

			$currentpassword = encrypt($_POST['currentpassword'], $_SESSION['user_name']);
			
			if($currentpassword != $_SESSION['user_password'])
			{
				echo '<p>Wachtwoorden komen niet overeen. <a href="index.php?page=details&action=1">Terugkeren.</a></p>';
			}
			else
			{
				include 'connect.php';
				
				$newpassword = encrypt($_POST['newpassword'], $_SESSION['user_name']);
				
				$query = 'UPDATE users SET `user_password` = "' . $newpassword . '" WHERE user_id = ' . $_SESSION['user_id'];
			
				mysql_query($query);

				echo '<p>Wachtwoord gewijzigd. <a href="index.php?page=details">Terugkeren.</a></p>';
			}
		}
	}
	else if($_GET['action'] == "2")
	{
		?>
		
		<?php
	}
?>

