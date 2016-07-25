var page = require('webpage').create();
page.open('http://www.azusakobayashi.com/constellation/index.php', function () {
	page.render('constellation.png');
	phantom.exit();
});
