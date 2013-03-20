<?php
	if(!isset($_SESSION['logged']) || $_SESSION['user_acceslevel'] < 1)
	{
		header("Location: index.php?page=home");
	}
	
	if(!isset($_GET['action']) || $_GET['action'] == "0")
	{
		?>
		<table>
			<tr><td colspan="2" style="text-align:center;"><a href="index.php?page=details&action=1">Wachtwoord wijzigen?</a></td></tr>
			<tr><td colspan="2" style="text-align:center;"><a href="index.php?page=details&action=2">Avatar wijzigen?</a></td></tr>
			<tr><td colspan="2" style="text-align:center;"><a href="index.php?page=winkelwagen">Naar winkelwagen gaan.</a></td></tr>
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

				echo '<p>Wachtwoord veranderd. <a href="index.php?page=details">Terugkeren.</a></p>';
			}
		}
	}
	else if($_GET['action'] == "2")
	{
		if(!isset($_GET['state']) || $_GET['state'] == "0")
		{
		?>
			<h3>Avatar wijzigen</h3>
			
			<form action='index.php?page=details&action=2&state=1' method="POST" enctype="multipart/form-data">
				<table border="0px;">
					<tr><td>Huide avatar:</td><td><img style="width:150px;height:150px;" alt="can\'t load image." src="<?php echo $_SESSION['user_image']; ?>"/></td></tr>
					<tr><td>Nieuwe avatar:</td><td><input type="file" name="image"/></td></tr>
					<tr><td colspan="2" style="text-align:center;"><input type="submit" value="Aanpassen"/></td></tr>
				</table>
			</form>
			
			<a href="index.php?page=details">Annuleren</a>
		<?php
		}
		else if($_GET['state'] == "1")
		{
			if($_FILES['image']['name'] != null)
			{
				include 'save_image.php';
				$target_path = save_image("images/user/" . $_SESSION['user_name']);
				
				$_SESSION['user_image'] = $target_path;
			}
			else
			{
				$target_path = null;
				
				$_SESSION['user_image'] = "images/layout/default_image_user.png";
			}
			
			include 'connect.php';
			
			$query = 'UPDATE users SET `user_image` = "' . $target_path . '" WHERE user_id = ' . $_SESSION['user_id'];
			
			mysql_query($query);
			
			header("Location: index.php?page=details&action=2&state=2");
		}
		else if($_GET['state'] == "2")
		{
			echo '<p>Avatar aangepast. <a href="index.php?page=details">Terugkeren.</a></p>';
		}
	}
?>

