<!DOCTYPE html>
<head>
  <title>in high tide or in low tide, i'll be by ur side</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile.structure-1.1.1.min.css" />

</head>
<body>
<div id="sb_logo">
  <a href="http://thesummerbreak.tumblr.com" target="blank"><img src="SB2_Icon_white.png"></a>
</div>
<div class="bg"><div class="horiz"></div></div>
<div class="info">Loading...</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script>
jQuery(document).ready(function($) {
  $.ajax({
    url : "http://api.wunderground.com/api/63885e241b5ba717/conditions/astronomy/geolookup/rawtide/tide/q/CA/Santa_Monica.json",
    dataType : "jsonp",
    success : function(parsed_json) {
      var location = parsed_json['location']['city'];
      var setHour = parsed_json['sun_phase']['sunset']['hour'];
      var setMinute = parsed_json['sun_phase']['sunset']['minute'];
      //var age = parsed_json['moon_phase']['ageOfMoon'];
      //var illuminated = parsed_json['moon_phase']['percentIlluminated'];
      var feelsLikeF = parsed_json['current_observation']['feelslike_f'];
      var tideType = parsed_json['tide']['tideSummary']['0']['data']['type'];
      var tideHeight = parsed_json['tide']['tideSummary']['0']['data']['height'];

      // convert time to non-military time
      if (setHour > 12) {
        setHour = (setHour - 12);
      }

      // determine background color depending on feels like temperature
      if (feelsLikeF <= 50) {
          var tempClass = 1;
        }
      if (feelsLikeF > 50 && feelsLikeF <= 70) {
          var tempClass = 2;
        }
      if (feelsLikeF > 70) {
          var tempClass = 3;
        }
    
      // $('.info').html("The sun will set at " + setHour + ":" + setMinute + "pm today in " + location + ".<br />It's currently at " + tideType + " and the tide is " + tideHeight + " high.<br />It feels like " + feelsLikeF +"F." );

      // if Low Tide or High Tide, print tidal information and change horizon height accordingly
      if (tideType == "High Tide") {
        $('.info').html("The sun will set at " + setHour + ":" + setMinute + "pm today in " + location + ".<br />It's currently at " + tideType + " and the tide is " + tideHeight + " high.<br /><div class='updown'>We're like the waves. We have our ups and downs.</div>");
        $('.horiz').addClass("horizHigh");
      } if (tideType == "Low Tide") {
        $('.info').html("The sun will set at " + setHour + ":" + setMinute + "pm today in " + location + ".<br />It's currently at " + tideType + " and the tide is " + tideHeight + " high.<br /><div class='updown'>We're like the waves. We have our ups and downs.</div>");
        $('.horiz').addClass("horizLow");
      } else {
        $('.info').html("The sun will set at " + setHour + ":" + setMinute + "pm today in " + location + ".<br /><div class='updown'>We're like the waves. We have our ups and downs.</div>");
        $('.horiz').addClass("horizMed");
      }

      // set background color
      $(".bg").addClass("bg-" + tempClass );
      $(".updown").addClass("color-" + tempClass);


    }

  });

});


</script>




</body>
</html>