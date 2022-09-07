$(document).ready(function(){
	function setCookie(name,value,days) {
		var expires = "";
		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + (days*24*60*60*1000));
			expires = "; expires=" + date.toUTCString();
		}
		document.cookie = name + "=" + (value || "")  + expires + "; path=/";
	}
	function getCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	}
	function eraseCookie(name) {   
		document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
	}

	if(getCookie('cookie-auth')) {
		$('.cookie-banner').hide();
	}

	$('.cookie-banner-content a').click(function(){
		$('.cookie-banner').toggle("slide", {direction:'down'});
		if($(this).attr('id') === "cookie-yes") {
			setCookie('cookie-auth', 'yes', 30);
			location.reload();
		} else {
			setCookie('cookie-auth', 'no', 30);
			location.reload();
		}	
	});
});