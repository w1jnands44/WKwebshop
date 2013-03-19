<?php
function save_image($path)
{
	$extension = end(explode(".", $_FILES['image']['name']));

	$target_path = $path . "." . $extension;
	
	if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
		echo "The file " . basename( $_FILES['image']['name']) . " has been uploaded";
	} 
	else
	{
		echo "There was an error uploading the file, please try again!";
	}
	
	return $target_path;
}
?>