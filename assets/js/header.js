$(document).ready(function(){
	$('.menu').click(function(){
		$('.header-overlay').fadeIn();
		$('.menu-header').toggle("slide", {direction:'left'});
	});
	$('#close-menu').click(function(){
		$('.header-overlay').fadeOut();
		$('.menu-header').toggle("slide", {direction:'left'});
	});
	$('.infos').click(function(){
		$('.header-overlay').fadeIn();
		$('.menu-infos').toggle("slide", {direction:'right'});
	});
	$('#close-infos').click(function(){
		$('.header-overlay').fadeOut();
		$('.menu-infos').toggle("slide", {direction:'right'});
	});
});