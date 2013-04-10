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
					<a href="index.php?page=admin&action=1" style="text-decoration:none;">
						<img src="images/layout/default_image_product.png" style="width:120px;height:120px;"/>
						Gebruikers
					</a>
				</div>
				<div style="width:120px;height:140px;text-align:center;font-weight:bold;color:black;margin-top:110px;">
					<a href="index.php?page=admin&action=2" >
						<img src="images/layout/default_image_product.png" style="width:120px;height:120px;"/></a>
						Artikelen
					</a>
				</div>
			</div>
			<div style="width:120px;height:380px;float:right;">
				<div style="width:120px;height:140px;text-align:center;font-weight:bold;color:black;">
					<a href="index.php?page=admin&action=3" >
						<img src="images/layout/default_image_product.png" style="width:120px;height:120px;"/></a>
						Merken
					</a>
				</div>
				<div style="width:120px;height:140px;text-align:center;font-weight:bold;color:black;margin-top:110px;">
					<a href="index.php?page=admin&action=4" >
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
			$connect = mysql_connect('localhost', 'root');
			mysql_select_db('wkwebshop',$connect) or die (mysql_error());
			
			if(isset($_GET['searchvalues']))
			{
				echo '<div class="confirm_message"><a href="' . $_SERVER['PHP_SELF'] . '?page=admin&action=1" style="color:black;">Terug naar overzicht.</a></div>';
			}
			
			if(isset($_GET['annuleer']))
			{
				if($_SESSION['sorting'] == "1")
				{
					$_SESSION['sorting'] = "0";
				}
				else
				{
					$_SESSION['sorting'] = "1";
				}
			}
			
			if(isset($_GET['edit']))
			{
				if ($_SESSION['sorting'] == "1")
				{
					$_SESSION['sorting'] = "0";
				}
				else
				{
					$_SESSION['sorting'] = "1";
				}
				echo '<input type="hidden" value="' . $_SESSION['sorting'] . '" name="sorting">';
			}
			
			if(isset($_GET['addvalues']))
			{	
				$connect = mysql_connect('localhost', 'root');
				mysql_select_db('wkwebshop',$connect) or die (mysql_error());
	
				$sessionid = session_id();
				
				$voornaam = $_GET['voornaam'];
				$achternaam = $_GET['achternaam'];
				$kamer = $_GET['kamer'];
				$salaris = $_GET['salaris'];
				$commentaar = $_GET['commentaar'];
				$query = 'INSERT INTO werknemers (`voornaam`, `achternaam`, `kamer`, `salaris`, `commentaar`, `sessienummer`) VALUES ("' . $voornaam . '", "' . $achternaam. '", ' . $kamer . ', ' . $salaris . ',"' . $commentaar . '", "' . $sessionid . '")';

				mysql_query($query);
				
				echo "<div class='confirm_message'><p style='padding-top:10px;'>Record toegevoegd.</p></div>";
			}
			
			if(isset($_GET['deleteconfirm']) && $_GET['deleteconfirm'] == "Ja")
			{
				$connect = mysql_connect('localhost', 'root');
				mysql_select_db('wkwebshop',$connect) or die (mysql_error());
				
				$query = 'DELETE FROM werknemers WHERE id=' . $_SESSION["deleteid"];

				mysql_query($query);
				
				echo "<div class='confirm_message'><p style='padding-top:10px;'>Record verwijderd.</p></div>";
			}
			
			if(isset($_GET['editconfirm']) && $_GET['editconfirm'] == "Ja")
			{
				$connect = mysql_connect('localhost', 'root');
				mysql_select_db('wkwebshop',$connect) or die (mysql_error());
				
				$voornaam = $_SESSION['voornaam'];
				$achternaam = $_SESSION['achternaam'];
				$kamer = $_SESSION['kamer'];
				$salaris = $_SESSION['salaris'];
				$commentaar = $_SESSION['commentaar'];
				
				$query = 'UPDATE werknemers 
				SET voornaam = "' . $voornaam . '", 
				achternaam = "' . $achternaam. '", 
				kamer = ' . $kamer . ', 
				salaris = ' . $salaris . ', 
				commentaar = "' . $commentaar . '" 
				WHERE id=' . $_SESSION["editid"];
				
				mysql_query($query);
				
				echo "<div class='confirm_message'><p style='padding-top:10px;'>Record gewijzigd.</p></div>";
			}
			
			if(isset($_GET['delete']))
			{
				$_SESSION['deleteid'] = $_GET['delete'];
				
				?>
				<div class='confirm_message'><p style='padding-top:10px;'>Weet u zeker dat u deze record wilt verwijderen?</p>
					<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
						<input type="submit" name="deleteconfirm" value="Nee" class="confirm_button">
						<input type="submit" name="deleteconfirm" value="Ja" class="confirm_button">
					</form>
				</div>
				<?php
			}
			
			if(isset($_GET['editvalues']))
			{
				$_SESSION['voornaam'] = $_GET['voornaam'];
				$_SESSION['achternaam'] = $_GET['achternaam'];
				$_SESSION['kamer'] = $_GET['kamer'];
				$_SESSION['salaris'] = $_GET['salaris'];
				$_SESSION['commentaar'] = $_GET['commentaar'];
				$_SESSION['editid'] = $_GET['id'];
				
				?>
				<div class='confirm_message'><p style='padding-top:10px;'>Weet u zeker dat u deze record wilt wijzigen?</p>
					<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
						<input type="submit" name="editconfirm" value="Nee" class="confirm_button">
						<input type="submit" name="editconfirm" value="Ja" class="confirm_button">
					</form>
				</div>
				<?php
			}
			
			if(isset($_GET['searchvalues']))
			{
				$query = 'SELECT * FROM werknemers WHERE voornaam LIKE "%' . $_GET['voornaam'] . '%" AND achternaam LIKE "%' . $_GET['achternaam'] . '%" AND kamer LIKE "%' . $_GET['kamer'] . '%" AND salaris LIKE "%' . $_GET['salaris'] . '%" AND commentaar LIKE "%' . $_GET['commentaar'] . '%"';
			}
			else if(!isset($_GET['sort']))
			{
				$query = 'SELECT * FROM werknemers';
				$_SESSION['sorting'] = "0";
			}
			else if($_GET['sort'] == "voornaam")
			{
				if($_SESSION['sorting'] == "0")
				{
					$query = 'SELECT * FROM werknemers ORDER BY voornaam DESC';
					$_SESSION['sorting'] = "1";
				}
				else
				{
					$query = 'SELECT * FROM werknemers ORDER BY voornaam';
					$_SESSION['sorting'] = "0";
				}
			}
			else if($_GET['sort'] == "achternaam")
			{
				if($_SESSION['sorting'] == "0")
				{
					$query = 'SELECT * FROM werknemers ORDER BY achternaam DESC';
					$_SESSION['sorting'] = "1";
				}
				else
				{
					$query = 'SELECT * FROM werknemers ORDER BY achternaam';
					$_SESSION['sorting'] = "0";
				}
			}
			else if($_GET['sort'] == "kamer")
			{
				if($_SESSION['sorting'] == "0")
				{
					$query = 'SELECT * FROM werknemers ORDER BY kamer DESC';
					$_SESSION['sorting'] = "1";
				}
				else
				{
					$query = 'SELECT * FROM werknemers ORDER BY kamer';
					$_SESSION['sorting'] = "0";
				}
			}
			else if($_GET['sort'] == "salaris")
			{
				if($_SESSION['sorting'] == "0")
				{
					$query = 'SELECT * FROM werknemers ORDER BY salaris DESC';
					$_SESSION['sorting'] = "1";
				}
				else
				{
					$query = 'SELECT * FROM werknemers ORDER BY salaris';
					$_SESSION['sorting'] = "0";
				}
			}
			else if($_GET['sort'] == "commentaar")
			{
				if($_SESSION['sorting'] == "0")
				{
					$query = 'SELECT * FROM werknemers ORDER BY commentaar DESC';
					$_SESSION['sorting'] = "1";
				}
				else
				{
					$query = 'SELECT * FROM werknemers ORDER BY commentaar';
					$_SESSION['sorting'] = "0";
				}
			}
			
			$resultaat = mysql_query($query);
			
			$data = array();
			
			while($row=mysql_fetch_array($resultaat))
				{
					$data[]=$row;
				}
			?>
			<table border="0px">
				<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
					<tr>
						<td><a href="<?php $_SERVER['PHP_SELF'] ?>?sort=voornaam&sorting=<?php echo $_SESSION['sorting'] ?>" class="sort_link">Voornaam</a></td>
						<td><a href="<?php $_SERVER['PHP_SELF'] ?>?sort=achternaam&sorting=<?php echo $_SESSION['sorting'] ?>" class="sort_link">Achternaam</a></td>
						<td><a href="<?php $_SERVER['PHP_SELF'] ?>?sort=kamer&sorting=<?php echo $_SESSION['sorting'] ?>" class="sort_link">Kamer</a></td>
						<td><a href="<?php $_SERVER['PHP_SELF'] ?>?sort=salaris&sorting=<?php echo $_SESSION['sorting'] ?>" class="sort_link">Salaris</a></td>
						<td><a href="<?php $_SERVER['PHP_SELF'] ?>?sort=commentaar&sorting=<?php echo $_SESSION['sorting'] ?>" class="sort_link">Functie</a></td>
					
						<?php
						if(!isset($_GET['edit']) && !isset($_GET['add']) && !isset($_GET['search']))
						{
						?>
							<!--<td style="text-align:center;"><a href="<?php $_SERVER['PHP_SELF'] ?>?search=yes" class="search_button"></a></td>
							<td style="text-align:center;"><a href="<?php $_SERVER['PHP_SELF'] ?>?add=yes" class="add_button"></a></td>-->
							<td style="text-align:center;"><input class="search_button" type="submit" name="search" value="yes"></td>
							<td style="text-align:center;"><input class="add_button" type="submit" name="add" value="yes"></td>
						<?php
						}
						?>
					</tr>
				</form>
				<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
				<?php
				if(isset($_GET['add']))
				{
					echo '<tr>';
					echo '<td><input type="text" name="voornaam"</td>';
					echo '<td><input type="text" name="achternaam"</td>';
					echo '<td><input type="text" name="kamer"</td>';
					echo '<td><input type="text" name="salaris"</td>';
					echo '<td><input type="text" name="commentaar"</td>';
					echo '<td colspan="2" style="background-color:white;"><input style="text-align:center;height:25px;width:70px;" type="submit" name="addvalues" value="Voeg toe"></td>';
					echo '<td colspan="2" style="background-color:white;"><input style="text-align:center;height:25px;width:70px;" type="submit" name="annuleer" value="Annuleer"></td>';
					echo '</tr>';
				}
					
				if(isset($_GET['search']))
				{
					echo '<tr>';
					echo '<td><input type="text" name="voornaam"</td>';
					echo '<td><input type="text" name="achternaam"</td>';
					echo '<td><input type="text" name="kamer"</td>';
					echo '<td><input type="text" name="salaris"</td>';
					echo '<td><input type="text" name="commentaar"</td>';
					echo '<td colspan="2" style="background-color:white;"><input style="text-align:center;height:25px;width:70px;" type="submit" name="searchvalues" value="Zoeken"></td>';
					echo '<td colspan="2" style="background-color:white;"><input style="text-align:center;height:25px;width:70px;" type="submit" name="annuleer" value="Annuleer"></td>';
					echo '</tr>';
				}
						
				foreach($data as $gegevens)
				{
					echo '<tr>';
					if(isset($_GET['edit']) && $gegevens['id'] == $_GET['edit'])
					{
						echo '<td><input type="text" name="voornaam" value="' . $gegevens['voornaam'] . '"</td>';
						echo '<td><input type="text" name="achternaam" value="' . $gegevens['achternaam'] . '"</td>';
						echo '<td><input type="text" name="kamer" value="' . $gegevens['kamer'] . '"</td>';
						echo '<td><input type="text" name="salaris" value="' . $gegevens['salaris'] . '"</td>';
						echo '<td><input type="text" name="commentaar" value="' . $gegevens['commentaar'] . '"</td>';
						echo '<td colspan="2" style="background-color:white;"><input style="text-align:center;height:25px;width:50px;" type="submit" name="editvalues" value="Wijzig"></td>';
						echo '<td colspan="2" style="background-color:white;"><input style="text-align:center;height:25px;width:70px;" type="submit" name="annuleer" value="Annuleer"></td>';
						echo '<input type="hidden" name="id" value="' . $gegevens['id'] . '">';
					}
					else
					{
						echo '<td>' . $gegevens['voornaam'] . '</td>';
						echo '<td>' . $gegevens['achternaam'] . '</td>';
						echo '<td>' . $gegevens['kamer'] . '</td>';
						echo '<td>' . $gegevens['salaris'] . '</td>';
						echo '<td>' . $gegevens['commentaar'] . '</td>';
					}
						
					if(!isset($_GET['edit']) && !isset($_GET['add']) && !isset($_GET['search']))
					{
						echo '<td><input type="submit" name="edit" value="' . $gegevens['id'] . '" class="edit_button"></td>';
						echo '<td><input type="submit" name="delete" value="' . $gegevens['id'] . '" class="delete_button"></td>';
					}
					echo '</tr>';
				}
					
				if (isset($_GET['sort']))
				{
					echo '<input type="hidden" value="' . $_GET['sort'] . '" name="sort">';
				}
					
				mysql_close($connect);
				?>
				</form>
			</table>
		<?php
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