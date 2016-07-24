$('body').kinetic();

// var gotop = Math.floor(Math.random()*($(document).height()-$(window).height()));
// var goleft = Math.floor(Math.random()*($(document).width()-$(window).width()));

var goleft = Math.floor(Math.random()*3000);
var gotop = Math.floor(Math.random()*6000);

$('img').attr('draggable', false);

$(window).load(function() {

    $(".info").click(function(e) {
    e.preventDefault();
    	 $(".info-overlay").fadeIn();
		});
		
		$(".info-overlay").click(function(e) {
		 e.preventDefault();
    	 $(".info-overlay").fadeOut();
		});
		
		

$(".loader").fadeOut(function(){
$(".fadein").fadeIn(function() {
$(window).scrollLeft(goleft);
$(window).scrollTop(gotop);
});
});

});
