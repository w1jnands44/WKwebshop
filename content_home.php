<div class="content">
	<pre>
	text text text text
	text text text text
	text text text text
	text text text text
	text text text text
	text text text text
	text text text text
	text text text text
	text text text text
	text text text text
	</pre>
</div>
<div class="side_info">
	<div class="login_box">
	<?php
		if(!isset($_SESSION['logged']))
		{
		?>
			<form action="login.php" method="POST">
				<table class="login_form">
					<tr><td>Gebruikersnaam:</td><td><input type="text" name="username"/></td></tr>
					<tr><td>Wachtwoord:</td><td><input type="password" name="password"/></td></tr>
					<tr><td colspan="2" style="text-align:center;"><input type="submit" value="Inloggen"/></td></tr>
					<input type="hidden" name="returnpage" value="<?php echo $_SERVER['PHP_SELF'] . "?" . $_GET['page'] ?>">
				</table>
			</form>
		<?php
		}
		else
		{
			echo '<div class="login_message"><p>Welkom <a href="details.php">' . $_SESSION['user_voornaam'] . " " . $_SESSION['user_achternaam'] . '</a>.<a href="logout.php?returnpage=' . $_SERVER['PHP_SELF'] . '">Uitloggen.</a></p></div>';
		}
	?>
	</div>
</div>