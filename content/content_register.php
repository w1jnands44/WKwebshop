<form action="register.php" method="POST" enctype="multipart/form-data">
	<table border="0px;">
		<tr><td>Gebruikersnaam:</td><td><input type="text" name="username" maxlength="12"/></td></tr>
		<tr><td>Wachtwoord:</td><td><input type="password" name="password" maxlength="30"/></td></tr>
		<tr><td>Voornaam:</td><td><input type="text" name="voornaam" maxlength="20"/></td></tr>
		<tr><td>Achternaam:</td><td><input type="text" name="achternaam" maxlength="30"/></td></tr>
		<tr><td>Telefoon nummer:</td><td><input type="text" name="telefoon" maxlength="30"/></td></tr>
		<tr><td>Straat:</td><td><input type="text" name="straat" maxlength="30"/></td></tr>
		<tr><td>Plaats:</td><td><input type="text" name="plaats" maxlength="30"/></td></tr>
		<tr><td>Postcode:</td><td><input type="text" name="postcode" maxlength="6"/></td></tr>
		<tr><td>Email:</td><td><input type="email" name="email" maxlength="45"/></td></tr>
		<tr><td>Avatar:</td><td><input type="file" name="image"/></td></tr>
		<tr><td colspan="2" style="text-align:center;"><input type="submit" value="Registreer"/></td></tr>
	</table>
	<input type="hidden" name="acceslevel" value="1"/>
	<input type="hidden" name="returnpage" value="home"/>
</form>
<?php
	if(isset($_GET['error']))
	{
		$error = "";
		
		switch ($_GET['error']) {
			case 3:
				$error = "Email adres is niet correct.";
				break;
		}
		
		echo '<div style="text-align:center;color:red;">'. $error . '</div>';
	}
?>