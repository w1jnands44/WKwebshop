<?php
function encrypt($password, $username)
{
	$salt = substr($username, -4);
	for ($i = 0; $i < 24; $i++)
	{
		$password = hash('sha512', $salt . $password);
	}
	return $password;
}

function validate_password($password, $username, $db_password)
{
	$salt = substr($username, -4);
	for ($i = 0; $i < 24; $i++)
	{
		$password = hash('sha512', $salt . $password);
	}
	
	if ($password == $db_password)
	{
		/*echo "password: " . $password;
		echo "db_password: " . $db_password;
		echo "true";*/
		return true;
	}
	else
	{
		/*echo "password: " . $password;
		echo "db_password: " . $db_password;
		echo "false";*/
		return false;
	}
}
?>