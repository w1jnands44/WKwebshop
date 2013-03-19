<form action="register.php" method="POST">
	<table border="0px;">
		<tr><td>Gebruikersnaam:</td><td><input type="text" name="username" maxlenght="16"/></td></tr>
		<tr><td>Wachtwoord:</td><td><input type="password" name="password" maxlenght="30"/></td></tr>
		<tr><td>Voornaam:</td><td><input type="text" name="voornaam" maxlenght="20"/></td></tr>
		<tr><td>Achternaam:</td><td><input type="text" name="achternaam" maxlenght="30"/></td></tr>
		<tr><td>Email:</td><td><input type="email" name="email" maxlenght="45"/></td></tr>
		<tr><td>Avatar:</td><td><input type="file" name="image"/></td></tr>
		<tr><td colspan="2" style="text-align:center;"><input type="submit" value="Registreer"/></td></tr>
	</table>
	<input type="hidden" name="acceslevel" value="1"/>
	<input type="hidden" name="returnpage" value="home"/>
</form>