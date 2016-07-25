<!DOCTYPE html>  
<html>  
<head>  
	<title>w h  i   s    p     e      r       s    / /   i       n   \  \ \\  t     h    e   / /   /     w   i  n d</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
<!-- 	<meta http-equiv="refresh" content="60"/>
 -->	<link rel="stylesheet" href="style.css" />

	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile.structure-1.1.1.min.css" />

	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<!-- 	<script src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>	 -->
	<script src="spin.js"></script>
<!-- 	<script src="yqlgeo.js"></script> -->
</head>  

<body>  

</div>



  
  
	<div id="spinspin">
	</div>
		
	<div id="tweets">
	</div>
	
<div id="overlaybtn">
	//
</div>
<div id="standardbtn" class="oscillate">
	<a href="http://www.azusakobayashi.com/standard_state/" target="blank">&#10677;</a>
</div>



	
	<script>
	
	$(document).ready(function() {


		$(window).load(function () {
  			initiate_geolocation();
		});
    
    	function initiate_geolocation() {  
	        if (navigator.geolocation) {  
	            navigator.geolocation.getCurrentPosition(handle_geolocation_query, handle_errors);  
	        } else {  
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
            	coords : {  
                	latitude: response.place.centroid.latitude,  
                	longitude: response.place.centroid.longitude  
            	},  
            	address : {  
                	city: response.place.locality2.content,  
                	region: response.place.admin1.content,  
                	country: response.place.country.content  
            	}  
			};  
        
        	handle_geolocation_query(position);  
        }  
    
    	function handle_geolocation_query(position) {  
			console.log('Lat: '+position.coords.latitude+' '+'Lon: '+position.coords.longitude); 
		
		
			var tweets_url = "tweets.php?lat="+position.coords.latitude+"&long="+position.coords.longitude;
			console.log(tweets_url);
			$('#tweets').load(tweets_url, function() {
				spinner.stop();
	  			$('#spinspin').remove();
	  			$('#tweets').show();
	  			
/* 				$('#tweets').prepend("<div id='wind'><div id='winddir'>The wind just brought whispers from<br />" . $winddir . " at " . $windspeed . "km/h</div></div>"); */
				
		
				
			});
			
		}  
		






	// Spinner icon
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
		
		
});


		$("#overlay").click(function() {
			$(this).fadeOut();
		});
	
		$("#overlaybtn").click(function() {
			$("#overlay").fadeIn();
		});
	</script>	
	

	
</body>  

</html>  