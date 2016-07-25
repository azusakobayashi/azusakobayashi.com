<html>
<head>
	<title>HashTag Retrieval</title>
	<script src="jquery.js" type="text/javascript" charset="utf-8"></script>
<style>
	.tweet {
		margin:5px auto;
		border-radius:3px;
		background:white;
		width:900px;
	}
	
	#result {
		margin:0 auto;
		width:1000px;
		background:#CCC;
		border-radius:5px;
	}

	#tweetText{
		vertical-align:top;
	}
</style>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$('#trigger_but').click(function(){
			$.getJSON("http://search.twitter.com/search.json?rpp=100&callback=?&q=%23"+$('#hash_tag_input').val(),function(data){
				for(var i=0;i<data.results.length;i++){
					$('#result').prepend('<div class="tweet"><img src="'+data.results[i].profile_image_url+'" width="50" height="60"/><span id="tweetText">'+data.results[i].text+'</span></div>');    
        		}
 			});
   		}); 
	});
</script>
</head>

<body>
	<input type="text" id="hash_tag_input" size="40" />
	<input type="button" id="trigger_but" value="Fetch Tweets" />
	<div id="result"></div>
</body>
<html>

