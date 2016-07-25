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

<img class="bg-image" src="Aurora.jpg" />

<div id="uploader">
	<p>
		Set with stars, we make meaning of what we see.
	</p>
	

	<form method="post" action="index.php" enctype="multipart/form-data" >
		<input type="hidden" name="size" value="350000" class="buttony"><br />
		<input type="file" name="photo" class="buttony"> <br />
		<input TYPE="submit" name="upload" class="buttony" title="add" value="Emit"/>
	</form>
</div>

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
		
	

		$position = rand(0, 100);
		$circsize = rand(1, 3);

		//Writes the information to the database
		mysql_query("INSERT INTO constellation (timestamp,position,imageurl, circsize)
		VALUES ('$timestamp', '$position', '$pic', '$circsize')") ;

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
		$toppos = rand(0, 100);
		$leftpos = rand(0, 100);
		
		$current_time = time();
		$time_diff = $current_time - $row['timestamp'];
	
		if ($time_diff <= 5) {
			$circsize = 1;
		} else if ($time_diff > 5 && $time_diff <= 30) {
			$circsize = 2;
		} else if ($time_diff > 30 && $time_diff <= 45) {
			$circsize = 3;
		} else if ($time_diff > 45 && $time_diff <= 3600) {
			$circsize = 4;
		} else if ($time_diff > 3600) {
			$circsize = 5;
		} else {
			$circsize = 5;
		}
		
		echo "<img src='imgs/" . $row['imageurl'] . "' style='position:fixed; top:" . $toppos . "%; left:" . $leftpos . "%;' class='circle" . $circsize . "' />";
	}
	
	
?>


</body>


</html>