<?php
//Check als de file geupload is
if($_FILES['file']['error'] > 0) 
{ 
	echo 'Error during uploading, try again'; 
}

//Check welke image type beschikbaar zijn
$extsAllowed = array( 'jpg', 'jpeg', 'png', 'gif' );

//Extract extention from uploaded file
	//substr return ".jpg"
	//Strrchr return "jpg"

$extUpload = strtolower( substr( strrchr($_FILES['file']['name'], '.') ,1) ) ;
//Check als de geuploade file toegestaan is
	
if (in_array($extUpload, $extsAllowed) ) 
{ 
	//Upload de file in de server
	$name = "images/{$_FILES['file']['name']}";
	$result = move_uploaded_file($_FILES['file']['tmp_name'], $name);
	
	if($result)
	{
		header("Location: https://82737.ict-lab.nl/Club-Famiglia/galleria.php");
	}		
} 
else 
{ 
	echo 'File is not valid. Please try again'; 
}
	
?>