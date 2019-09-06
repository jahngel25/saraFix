/*
Created by Alejandro Palacios https://github.com/AlexSoicalap
*/
$(function() {
	/*Define some constants */
	const ARTICLE_TITLE =  document.title;
	const ARTICLE_URL = encodeURIComponent(window.location.href);
	const MAIN_IMAGE_URL = encodeURIComponent($('meta[property="og:image"]').attr('content'));

	$('.redF').click(function(){
		open_window('http://www.facebook.com/sharer/sharer.php?u='+ARTICLE_URL, 'facebook_share');
	});

	$('.redT').click(function () {
		open_window('http://twitter.com/share?url='+ARTICLE_URL, 'twitter_share');
	});

	$('.redG').click(function () {
		open_window('https://plus.google.com/share?url='+ARTICLE_URL, 'google_share');
	});

	$('.redP').click(function () {
		open_window('https://pinterest.com/pin/create/button/?url='+ARTICLE_URL+'&media='+MAIN_IMAGE_URL+'&description='+ARTICLE_TITLE, 'pinterest_share');
	});
	

	function open_window(url, name){
		window.open(url, name, 'height=320, width=640, toolbar=no, menubar=no, scrollbars=yes, resizable=yes, location=no, directories=no, status=no');
	}
});