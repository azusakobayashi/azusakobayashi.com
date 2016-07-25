<!DOCTYPE html>  
<html>  
<head>  
	<title>Standard State</title>
	<meta name="viewport" content="width=1280px, initial-scale=1.0, minimum-scale=0.5"> 
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile.structure-1.1.1.min.css" />
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<style>
	<?php 
	
	for ($j = 1; $j<= 6; $j++) {
		$alphas = range('A', 'Z');
		for ($i = 1; $i<= 8; $i++) {
			$rotate = rand(1, 359);
			echo "." . $alphas[$j-1] . $i . " {
				-webkit-transform: rotate(". $rotate . "deg); 
    			-moz-transform:    rotate(". $rotate . "deg); 
    			-ms-transform:     rotate(". $rotate . "deg); 
    			-o-transform:      rotate(". $rotate . "deg); 
    		}";
		}
	}
	?>
	</style>
  </head>  

<body>  

<div id="title1" style="<? $titlerotate = rand(-16, 16);
echo "-webkit-transform: rotate(". $titlerotate . "deg); -moz-transform: rotate(". $titlerotate . "deg); -ms-transform: rotate(". $titlerotate . "deg); -o-transform: rotate(". $titlerotate . "deg); ";
    			?>">Standard</div>

<div id="title2" style="<? $titlerotate = rand(-16, 16);
echo "-webkit-transform: rotate(". $titlerotate . "deg); -moz-transform: rotate(". $titlerotate . "deg); -ms-transform: rotate(". $titlerotate . "deg); -o-transform: rotate(". $titlerotate . "deg); ";
    			?>">
	State
</div>

<div id="puzzle">

<?php 
	
	$background = array("bg_drugs.jpg", "bg_hair.jpg", "bg_drinks.jpg", "bg_music.jpg", "bg_food.jpg");
	shuffle($background);
	$bg_url = $background[0];
	
	for ($j = 1; $j<= 6; $j++) {
		$alphas = range('A', 'Z');
		for ($i = 1; $i<= 8; $i++) {
		$rotclass = "";
		if (rand(0, 1)==1) { $rotclass = " class='" . $alphas[$j-1] . $i . "'"; };
			echo "<div id='" . $alphas[$j-1] . $i . "' class='puzzsq'><img src='" . $bg_url . "' id='i" . $alphas[$j-1] . $i . "'" . $rotclass . " style='top:" . ($j-1)*(-116) . "px; left:" . ($i-1)*(-116) . "px;'></div>
			
			";
		}
	}
?>



</div>

<div id="overlay">
	<div id="overlaytext">
		Standard<div style="display: inline-block;" class="oscillate2">&#10677;</div>State<br />
		<p>"As you are falling,...<br/>the horizon quivers in a maze of collapsing lines and you may lose any sense of above and below, of before and after, of yourself and your boundaries. While falling, people may sense themselves as being things, while things may sense that they are people."
		<p><span style="font-size: 14px">Hito Steyerl<br /><i>In Free Fall: A Thought Experiment<br />on Vertical Perspective</i></span></p>
		<p>&#8212;These photos were taken in Tokyo in March 2011, immediately after a Magnitude 9.0 earthquake and subsequent tsunami hit northern Japan. It may be possible to set these photos right again, or it may not be. For more photos from this series, please see <i>DIARY, a photographic anadrome</i>.</p>
	</div>
</div>	

<div id="overlaybtn" class="oscillate">
	&#10677;
</div>
<div id="whispersbtn">
	<a href="http://www.azusakobayashi.com/whispers/" target="blank">//</a>
</div>

<script>
	
	$(document).ready(function() {

$(".puzzsq").click(function() {
		
		// change adjacent L + R squares
		base = this.id.charAt(0);
		curr = this.id.charAt(1);
		nextnum = parseInt(curr)+1;
		prevnum = parseInt(curr)-1;
		nextid= "#i" + base + nextnum;
		previd= "#i" + base + prevnum;
		nextclass= base + nextnum;
		prevclass= base + prevnum;
		$(nextid).toggleClass(nextclass);
		$(previd).toggleClass(prevclass);

	// change top / bottom squares
	
	above = String.fromCharCode(base.charCodeAt(0) - 1); // 'a'
	below = String.fromCharCode(base.charCodeAt(0) + 1); // 'a'
		aboveid= "#i" + above + curr;
		belowid= "#i" + below + curr;
		aboveclass= above + curr;
		belowclass= below + curr;
		$(aboveid).toggleClass(aboveclass);
		$(belowid).toggleClass(belowclass);
	});
	
	
	$("#overlay").click(function() {
$(this).fadeOut();
	});
	
		$("#overlaybtn").click(function() {
$("#overlay").fadeIn();
	});
	
	
	
});



	</script>
</body>  

</html>  