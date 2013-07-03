<?php
function save_image($path, $name, $imagenr)
{
	$var = explode(".", $name);
	$extension = end($var);

	$target_path = $path . "." . $extension;
	
	if (file_exists($target_path))
	{
		unlink($target_path);
	}
	
	if(move_uploaded_file($_FILES['image' . $imagenr]['tmp_name'], $target_path)) {
		echo "The file " . basename($name) . " has been uploaded";
	} 
	else
	{
		echo "There was an error uploading the file, please try again!";
	}
	
	return $target_path;
}

/*
function save_image2($path)
{
	$extension = end(explode(".", $_FILES['image2']['name']));

	$target_path = $path . "." . $extension;
	
	if (file_exists($target_path))
	{
		unlink($target_path);
	}
	
	if(move_uploaded_file($_FILES['image2']['name'], $target_path)) {
		echo "The file " . basename( $_FILES['image2']['name']) . " has been uploaded";
	} 
	else
	{
		echo "There was an error uploading the file, please try again!";
	}
	
	return $target_path;
}

function save_image3($path)
{
	$extension = end(explode(".", $_FILES['image3']['name']));

	$target_path = $path . "." . $extension;
	
	if (file_exists($target_path))
	{
		unlink($target_path);
	}
	
	if(move_uploaded_file($_FILES['image3']['name'], $target_path)) {
		echo "The file " . basename( $_FILES['image3']['name']) . " has been uploaded";
	} 
	else
	{
		echo "There was an error uploading the file, please try again!";
	}
	
	return $target_path;
}*/
?>