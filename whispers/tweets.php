<?php
	
$results = 50;
$winddir = "NONE";
class twitter_class {
  		
	function twitter_class() {
  		
		// Retrieve weather info from Weather Underground
		$jsonurl = "http://api.wunderground.com/api/63885e241b5ba717/conditions/forecast/alert/q/" . $lat = $_REQUEST['lat'] . "," . $long = $_REQUEST['long'] . ".json";
		$json = file_get_contents($jsonurl,0,null,null);
		$json_output = json_decode($json);
		global $winddir;
		
		// Parse wind direction and windspeed
		$winddir = $json_output->current_observation->wind_dir;
		$winddeg = $json_output->current_observation->wind_degrees;
		$windspeed = $json_output->current_observation->wind_kph;
		
		// If there is no wind, set windspeed to 1
		if ($windspeed == 0) {
			$windspeed = 1;
		}



  
  
		// Print wind direction and windspeed
		echo "
		  <div class='outerContainer'>
  <div class='innerContainer'>
  <div class='element'>The wind just brought whispers from the " . $winddir . " at " . $windspeed . "km/h</div>
  </div>
  </div><div class='tweetwrapper'>";

		$lat = $_REQUEST["lat"];
		$long = $_REQUEST["long"];
		//$rad = $_REQUEST["rad"];
			
		// Radius of tweets blown in set by windspeed
		$rad = $windspeed;
		
		$this->realNamePattern = '/\((.*?)\)/';
		$this->searchURL = 'http://search.twitter.com/search.atom?geocode=' . $lat . '%2C' . $long .'%2C' . $rad . 'km';
		$this->intervalNames = array('second', 'minute', 'hour', 'day', 'week', 'month', 'year');
		$this->intervalSeconds = array( 1,        60,       3600,   86400, 604800, 2630880, 31570560);
		$this->badWords = array('asdfghjkl', 'zxcvbnm');
  	}
 		
 	function getTweets($limit) {
		
		$output = '';

		// get the search result
		$ch= curl_init($this->searchURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		$response = curl_exec($ch);
		
		

		if ($response !== FALSE) {
			$xml = simplexml_load_string($response);
			print_r($xml);
			$output = '';
			$tweets = 0;

			for($i=0; $i<count($xml->entry); $i++) {
				$crtEntry = $xml->entry[$i];
				$account  = $crtEntry->author->uri;
				$image    = $crtEntry->link[1]->attributes()->href;
				$tweet    = str_replace('href=', 'target="_blank" href=', $crtEntry->content);
				//preg_match_all('/#([\p{L}\p{Mn}]+)/u',$tweet,$matches);
				// print_r($matches);
			    			
    			// skip tweets containing banned words
				$foundBadWord = false;
				foreach ($this->badWords as $badWord) {
					if(stristr($tweet, $badWord) !== FALSE) {
						$foundBadWord = true;
						break;
					}
				}
 
        		// skip this tweet containing a banned word
        		if ($foundBadWord)
         		continue;
 
				// don't process any more tweets if at the limit
				if ($tweets==$limit)
				break;
				$tweets++;

				// name is in this format "acountname (Real Name)"
				preg_match($this->realNamePattern, $crtEntry->author->name, $matches);
				$name = $matches[1];
 
				// get the time passed between now and the time of tweet, don't allow for negative
				// (future) values that may have occured if server time is wrong
				$time = 'just now';
				$secondsPassed = time() - strtotime($crtEntry->published);
				if ($secondsPassed>0) {
      				// see what interval are we in
					for($j = count($this->intervalSeconds)-1; ($j >= 0); $j--) {
						$crtIntervalName = $this->intervalNames[$j];
						$crtInterval = $this->intervalSeconds[$j];

						if ($secondsPassed >= $crtInterval) {
							$value = floor($secondsPassed / $crtInterval);
							if ($value > 1) {
								$crtIntervalName .= 's';
							}
							$time = $value . ' ' . $crtIntervalName . ' ago';
							break;
						}
					}
				}
				
				global $winddir;
	
				
				if ($winddir == "East") {
					$leftval = '3000px';
        			$topval = '0px';
/* 					echo "-----East"; */
        		}
        		
        		if ($winddir == "ENE") {
        			$leftval = '3000px';
        			$topval = '-750px';
/* 					echo "-----ENE"; */
        		}
        				
        		if ($winddir == "ESE") {
        			$leftval = '3000px';
        			$topval = '-750px';
/* 					echo "-----ESE"; */
        		}

        		if ($winddir == "NE") {
        			$leftval = '3000px';
        			$topval = '-1500px';
/* 					echo "-----NE"; */
        		}

        		if ($winddir == "NNE") {
        			$leftval = '3000px';
        			$topval = '-2250px';
/* 					echo "-----NNE"; */
        		}

        		if ($winddir == "NNW") {
        			$leftval = '-3000px';
        			$topval = '-2250px';
/* 					echo "-----NNW"; */
        		}
        		
        		if ($winddir == "North") {
        			$leftval = '0px';
        			$topval = '-3000px';
/* 					echo "-----North"; */
        		}
        				
        		if ($winddir == "NW") {
        			$leftval = '-3000px';
        			$topval = '-1500px';
/* 					echo "-----NW"; */
        		}

        		if ($winddir == "SE") {
        			$leftval = '0px';
        			$topval = '1500px';
/* 					echo "-----SE"; */
        		}

        		if ($winddir == "South") {
        			$leftval = '0px';
        			$topval = '3000px';
/* 					echo "-----South"; */
        		}

        		if ($winddir == "SSE") {
        			$leftval = '750px';
        			$topval = '3000px';
/* 					echo "-----SSE"; */
        		}
				
				if ($winddir == "SSW") {
					$leftval = '-750px';
        			$topval = '3000px';
/* 					echo "-----SSW"; */
        		}
        				
        		if ($winddir == "SW") {
        			$leftval = '-3000px';
        			$topval = '-1500px';
/* 					echo "-----SW"; */
        		}

        		if ($winddir == "West") {
        			$leftval = '-3000px';
        			$topval = '0px';
/* 					echo "-----West"; */
        		}

        		if ($winddir == "WNW") {
        			$leftval = '-3000px';
        			$topval = '-750px';
/* 					echo "-----WNW"; */
        		}

        		if ($winddir == "WSW") {
        			$leftval = '-3000px';
        			$topval = '-750px';
/* 					echo "-----WSW"; */
        		}
        		
				if ($winddir == "Variable") {
					$leftval = '0px';
        			$topval = '0px';
/* 					echo "-----Variable"; */
        		}				
     
     			$tweet = preg_replace('/(^|\s|>)#(\w*[a-zA-Z_]+\w*)/', '\1<span class="hashtag">#\2</span>', $tweet);
        				
				$output .= 
					'<div class="tweet" style="top:'.$topval.'; left:'.$leftval.';">
        				<div class="avatar">
        					<a href="' . $account . '" target="_blank"><img src="' . $image .'"></a>
        				</div>
						<div class="message"><span class="author"><a href="' . $account . '"target="_blank">' . $name . '</a></span>: ' .$tweet .'
							<div class="time">' . $time . '</div>
          				</div>
					</div>';
      		}
    	}
    
    	else
      		$output = '<div class="tweet"><span class="error">' . curl_error($ch) . '</span></div>';
    		curl_close($ch);
   			return $output;
	
  	}
}

$twitter = new twitter_class();

$output = $twitter->getTweets($results);

echo $output;

/*
// Search doc for hashtags
				$subject = $output;
				//$pattern = '/#\S+/';
				$pattern = '/#\S*\w/';
				preg_match($pattern, $subject, $hashtags, PREG_OFFSET_CAPTURE, 3);
				print_r($hashtags);
				
				$strTweet = "blablab lab <a href='#'>#test</a> bfligjflgj";
				
				$strTweet = preg_replace('/(^|\s|>)#(\w*[a-zA-Z_]+\w*)/', '\1<span class="tweet">#\2</span>', $strTweet);
				echo $strTweet;
*/

echo "</div><script>

		$('.outerContainer').click(function() {

  $(this).fadeOut('slow', function() {
  	$('.tweet').animate({
					top: 0,
					left: 0
					}, 3000, function(){
				});
  });

	
				

});

</script>"

  
?>