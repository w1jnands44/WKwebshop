<?php
	if(!isset($_SESSION['logged']) || $_SESSION['user_acceslevel'] < 3)
	{
		header("Location: index.php?page=home");
	}

	if(!isset($_GET['action']) || $_GET['action'] == "0")
	{
		?>
		<div style="width:380px;height:380px;">
			<div style="width:120px;height:380px;float:left;">
				<div style="width:120px;height:140px;text-align:center;font-weight:bold;color:black;">
					<a href="index.php?page=admin(inprogress)&action=1" style="text-decoration:none;">
						<img src="images/layout/default_image_product.png" style="width:120px;height:120px;"/>
						Gebruikers
					</a>
				</div>
				<div style="width:120px;height:140px;text-align:center;font-weight:bold;color:black;margin-top:110px;">
					<a href="index.php?page=admin(inprogress)&action=2" >
						<img src="images/layout/default_image_product.png" style="width:120px;height:120px;"/></a>
						Artikelen
					</a>
				</div>
			</div>
			<div style="width:120px;height:380px;float:right;">
				<div style="width:120px;height:140px;text-align:center;font-weight:bold;color:black;">
					<a href="index.php?page=admin(inprogress)&action=3" >
						<img src="images/layout/default_image_product.png" style="width:120px;height:120px;"/></a>
						Merken
					</a>
				</div>
				<div style="width:120px;height:140px;text-align:center;font-weight:bold;color:black;margin-top:110px;">
					<a href="index.php?page=admin(inprogress)&action=4" >
						<img src="images/layout/default_image_product.png" style="width:120px;height:120px;"/></a>
						Categoriën
					</a>
				</div>
			</div>
		</div>
		<?php
	}
	else if($_GET['action'] == "1")
	{
		//Overzicht van gebruikers
	
		include 'connect.php';
		
		$query = "SELECT * FROM users GROUP BY user_name";

		$resultaat = mysql_query($query) or die (mysql_error()) ;
		
		echo '<table style="border-collapse:collapse;font-size:18px;font-weight:bold;text-align:center;"><tr style="border-bottom:1pt solid black;"><td>Avatar</td><td>Username</td></tr>';
		
		$t=1;
		
		while ($row = mysql_fetch_array($resultaat)) 
		{
			if($row['user_image'] == null || $row['user_image'] == "")
			{
				$image = "images/layout/default_image_user.png";
			}
			else
			{
				$image = $row['user_image'];
			}	
			
			echo '<tr style="border-bottom:1pt solid black;text-align:right;background-color:#';
			if($t%2==1) { echo 'D8E9F4;">'; } else { echo 'ECF8FF;">'; }
		?>
				<td><img style="width:50px;height:50px;border:1px solid lightblue;" alt="Can\'t load image" src="<?php echo $image; ?>"/></td>
				<td><span style="font-size:20px;font-weight:bold;"><?php echo $row['user_name']; ?></span></td>
			</tr>
		<?php 
			$t++;
		}
		
		echo '</table>';
	}
	else if($_GET['action'] == "2")
	{
		echo "Hier komt overzicht artikelen";
	}
	else if($_GET['action'] == "3")
	{
		echo "Hier komt overzicht merken";
	}
	else if($_GET['action'] == "4")
	{
		echo "Hier komt overzicht categoriën";
	}
?>