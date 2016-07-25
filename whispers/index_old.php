<!DOCTYPE html>  
<html>  
  <head>  
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
	<!--
		<link rel="stylesheet" href="test.css" />
        <link rel="stylesheet" href="themes/test.min.css" />
      -->
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile.structure-1.1.1.min.css" />
		<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script><!--

		<script src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>
-->
		<script src="spin.js"></script>
		<script src="yqlgeo.js"></script>
  <script>  


$(window).load(function () {
   initiate_geolocation();
   


});
    
    function initiate_geolocation() {  
        if (navigator.geolocation)  
        {  
            navigator.geolocation.getCurrentPosition(handle_geolocation_query, handle_errors);  
        }  
        else  
        {  
            yqlgeo.get('visitor', normalize_yql_response);  
        }  
    }  
    
    
    
	var watchProcess = null;  
	function initiate_watchlocation() {  
		if (watchProcess == null) {  
			watchProcess = navigator.geolocation.watchPosition(handle_geolocation_query, handle_errors);  
		}  
	}  
	function stop_watchlocation() {  
		if (watchProcess != null) {  
			navigator.geolocation.clearWatch(watchProcess);  
			watchProcess = null;  
		}  
	}  
    function handle_errors(error) {  
        switch(error.code) {  
			case error.PERMISSION_DENIED: alert("user did not share geolocation data");  
			break;  
			case error.POSITION_UNAVAILABLE: alert("could not detect current position");  
			break;  
			case error.TIMEOUT: alert("retrieving position timedout");  
			break;  
			default: alert("unknown error");  
			break;  
        }  
    }  
    function normalize_yql_response(response) {  
        if (response.error) {  
            var error = { code : 0 };  
            handle_error(error);  
            return;  
        }  
        var position = {  
            coords :  
            {  
                latitude: response.place.centroid.latitude,  
                longitude: response.place.centroid.longitude  
            },  
            address :  
            {  
                city: response.place.locality2.content,  
                region: response.place.admin1.content,  
                country: response.place.country.content  
            }  
        };  
        handle_geolocation_query(position);  
    }  
    
    function handle_geolocation_query(position){  
		//alert('Lat: '+position.coords.latitude+' '+'Lon: '+position.coords.longitude); 
		
		//$("#lat").val(position.coords.latitude);
		//$("#long").val(position.coords.longitude);
		
		var tweets_url = "tweets.php?lat="+position.coords.latitude+"&long="+position.coords.longitude;
		$('#tweets').load(tweets_url);
		
		//var weather_url = "http://api.wunderground.com/api/63885e241b5ba717/conditions/forecast/alert/q/"+position.coords.latitude+","+position.coords.longitude+".json";
		/*

		console.log(weather_url);
		$('#weather').load(weather_url);
*/
		
	spinner.stop();
	  $('#spinspin').remove();

	}  

</script>  
</head>  
<body>  
<div id="spinspin" style="height:500px;"></div>
<div id="weather"></div>
<div id="tweets"></div>
<script>
  
     var opts = {
  lines: 11, // The number of lines to draw
  length: 0, // The length of each line
  width: 4, // The line thickness
  radius: 12, // The radius of the inner circle
  corners: 1, // Corner roundness (0..1)
  rotate: 0, // The rotation offset
  color: '#000', // #rgb or #rrggbb
  speed: 1, // Rounds per second
  trail: 72, // Afterglow percentage
  shadow: false, // Whether to render a shadow
  hwaccel: false, // Whether to use hardware acceleration
  className: 'spinner', // The CSS class to assign to the spinner
  zIndex: 2e9, // The z-index (defaults to 2000000000)
  top: 'auto', // Top position relative to parent in px
  left: 'auto' // Left position relative to parent in px
};
	var target = document.getElementById('spinspin');
	var spinner = new Spinner(opts).spin(target);
	</script>
</body>  
</html>  