<!DOCTYPE html>
<html>

<head>
	<title>Constellations</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>



</head>



<body>



<?php

	// Connects to your Database
	mysql_connect("mysql.azusakobayashi.com", "azusa_nt", "ank698") or die(mysql_error()) ;
	mysql_select_db("azusakobayashi_nt") or die(mysql_error()) ;

	if (!empty($_POST)) {

		//This is the directory where images will be saved
		$target = "imgs/";
		$target = $target . basename( $_FILES['photo']['name']);

		//This gets all the other information from the form
		$pic=($_FILES['photo']['name']);

		$timestamp = time();
		//echo $timestamp;

		$position = rand(0, 90);

		//Writes the information to the database
		mysql_query("INSERT INTO constellation (timestamp,position,imageurl)
		VALUES ('$timestamp', '$position', '$pic')") ;

		//Writes the photo to the server
		if(move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {

			//Tells you if its all ok
			//echo basename( $_FILES['photo']['name']);

			//echo "<img src='imgs/" . basename( $_FILES['photo']['name']). "' />";

		} else {

			//Gives and error if its not
			echo "Sorry, there was a problem uploading your file.";
		
		}
	}

	$result = mysql_query("SELECT * FROM constellation ORDER BY id");

	while($row = mysql_fetch_array($result)) {
	  	echo "<img src='imgs/" . $row['imageurl'] . "' style='position:fixed; top:" . $row['position'] . "%; left:" . $row['position'] . "%;' class='circle' />";
	}
?>

<div id="uploader">
	<form method="post" action="process.php" enctype="multipart/form-data">
		<input type="hidden" name="size" value="350000">
		<input type="file" name="photo"> 
		<input TYPE="submit" name="upload" title="add" value="add"/>
	</form>
</div>

</body>


</html>