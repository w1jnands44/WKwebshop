
<script type="text/javascript" src="jquery-2.0.2.min.js"></script>

<script type="text/javascript">
	
	var currentimgid = 1;
	$(function(){
	$('#volgende').click(function()
	{
		$('#imgid1').css("display", "none");
		$('#imgid2').css("display", "none");
		$('#imgid3').css("display", "none");
		
		if(currentimgid == 1)
		{
			$('#imgid2').css("display", "block");
			currentimgid = 2;
		}
		else if( currentimgid == 2)
		{
			$('#imgid3').css("display", "block");
			currentimgid = 3;
		}
		else
		{
			$('#imgid1').css("display", "block");
			currentimgid = 1;
		}
	});
	});
</script>
<?php 

if(!isset($_POST['bestellen']))
{
	if(isset($_GET['artikel_id']))
	{
		include 'connect.php';

		$id = $_GET['artikel_id'];

		$query = "SELECT * FROM artikelen WHERE artikel_id LIKE '$id'";

		$resultaat = mysql_query($query) or die (mysql_error()) ;

		while ($row = mysql_fetch_array($resultaat)) 
		{
			if($row['artikel_image1'] == null || $row['artikel_image1'] == "")
			{
				$image1 = "images/layout/default_image_user.png";
			}
			else
			{
				$image1 = $row['artikel_image1'];
			}
			
			if($row['artikel_image2'] == null || $row['artikel_image2'] == "")
			{
				$image2 = "images/layout/default_image_user.png";
			}
			else
			{
				$image2 = $row['artikel_image2'];
			}
			
			if($row['artikel_image3'] == null || $row['artikel_image3'] == "")
			{
				$image3 = "images/layout/default_image_user.png";
			}
			else
			{
				$image3 = $row['artikel_image3'];
			}
?>
			<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
				<div class="winkelwagen">
					<!--<table>
						<tr>
							<td width="150px"><b>Afbeelding</b></td>
							<td width="100px"></td>
							<td width="100px"><b>Naam</b></td>
							<td width="100px"><b>Beschrijving</b></td>
							<td width="100px"><b>Prijs<b></td>
							<td width="100px"><b>Aantal<b></td>
						</tr>
						<tr>
							<td colspan="6">
								<hr />
							</td>
						</tr>

						<tr>
							<td>
							<div id="imgid1">
								<img width="150px" height="100px" alt="afbeelding1" src="<?php echo $image1 ?>"/>
							</div>
							<div id="imgid2" style="display:none">
								<img width="150px" height="100px"  alt="afbeelding2" src="<?php echo $image2 ?>"/>
							</div>
							<div id="imgid3" style="display:none">
								<img width="150px" height="100px"  alt="afbeelding3" src="<?php echo $image3 ?>"/>
							</div>
							</td>
							<td>
								<input type="button" value="Volgende" id="volgende">
							</td>
							<td>
								<?php echo $row['artikel_naam']; ?>
							</td>
							<td>
								<?php echo $row['artikel_beschrijving']; ?>
							</td>
							<td>
								<?php echo $row['artikel_prijs']; ?>
							</td>
							<td>
								<input type="number" value="1" name="aantal" min="1" max="99">
							</td>

						</tr>
					</table>-->
					<h1 style="margin-left:35px;"><?php echo $row['artikel_naam']; ?></h1>
					<div style="width:700px;height:150px;">
						<div id="imgid1" style="float:left;margin-left:35px;">
							<img width="150px" height="150px" alt="afbeelding1" src="<?php echo $image1 ?>"/>
						</div>
						<div id="imgid2" style="display:block;float:left;margin-left:25px;">
							<img width="150px" height="150px"  alt="afbeelding2" src="<?php echo $image2 ?>"/>
						</div>
						<div id="imgid3" style="display:block;float:left;margin-left:25px;">
							<img width="150px" height="150px"  alt="afbeelding3" src="<?php echo $image3 ?>"/>
						</div>
					</div>
					<div style="margin-top:35px;margin-left:35px;">
						<table border="0px">
							<tr>
								<td>
									Beschrijving:
								</td>
								<td>
									<?php echo $row['artikel_beschrijving']; ?>
								</td>
							</tr>
							<tr>
								<td>
									Prijs:
								</td>
								<td>
									<?php echo $row['artikel_prijs']; ?>
								</td>
							</tr>
							<tr>
								<td>
									Aantal:
								</td>
								<td>
									<input type="number" value="1" name="aantal" min="1" max="99">
								</td>
							</tr>
						</table>
					</div>
				</div> 
				<input type="submit" name="bestellen" value="Toevoegen aan winkelwagen" style="margin-left:35px;margin-top:35px;"/>
			</form>
	
<?php 
		}
	}

	else
	{
		echo 'Er zitten nog geen producten in uw winkelwagen, klik <a href="?page=artikelen">hier</a> om naar een product te zoeken.';
	}
}
else
{
	$expire = time()+3600 ;
	$aantal = $_POST['aantal'];
	$artikelid = $_GET['artikel_id'];
	$username = $_SESSION['user_name'];

	if(!isset($_COOKIE["wkwebshop_$username"]))
	{
		setcookie("wkwebshop_$username", $artikelid .";". $aantal, $expire);
	}
	else
	{
		setcookie("wkwebshop_$username", $_COOKIE["wkwebshop_$username"].";". $artikelid .";". $aantal, $expire);
	}

	header("Location: index.php?page=winkelwagen");
} 
?>
