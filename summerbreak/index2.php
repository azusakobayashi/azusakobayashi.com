<!DOCTYPE html>
<head>
  <title>F E E L S  L I K E ***</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile.structure-1.1.1.min.css" />

</head>
<body>
<div class="bg"><div class="horiz"></div></div>
<div class="info">Loading...</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script>
jQuery(document).ready(function($) {
  $.ajax({
    url : "http://api.wunderground.com/api/63885e241b5ba717/conditions/astronomy/geolookup/tide/q/CA/Santa_Monica.json",
    dataType : "jsonp",
    success : function(parsed_json) {
      var location = parsed_json['location']['city'];
      var setHour = parsed_json['moon_phase']['sunset']['hour'];
      var setMinute = parsed_json['moon_phase']['sunset']['minute'];
      var age = parsed_json['moon_phase']['ageOfMoon'];
      var illuminated = parsed_json['moon_phase']['percentIlluminated'];
      var feelsLikeF = parsed_json['current_observation']['feelslike_f'];

      
      if (feelsLikeF <= 32) {
          var tempClass = 1;
        }

      if (feelsLikeF > 32 && feelsLikeF <= 65) {
          var tempClass = 2;
        }

      if (feelsLikeF > 65) {
          var tempClass = 2;
        }


     
    
      $('.info').html("The sun will set at " + setHour + ":" + setMinute + " today in " + location + ". It feels like " + feelsLikeF +"F." );
      $(".bg").addClass("bg-" + tempClass );
    }

  });

});



</script>




</body>
</html>