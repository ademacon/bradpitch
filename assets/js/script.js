$(document).ready(function(){

	console.log($('.pitch').text().replace(/\s/g, ''));


	if($('.pitch').text().replace(/\s/g, '') === "Oupsiln'yarienici") {
		$('.game-keyboard').hide();
	}

	if($('.resultats').length === 0) {

		const queryString = window.location.search;
		const urlParams = new URLSearchParams(queryString);

		var today = new Date();
		var date;

		if(urlParams.get('date')) {
			date = urlParams.get('date');
		} else {
			var month = today.getMonth()+1;
			var day = today.getDate();
			date = ('0'+day).slice(-2)+'/'+('0'+month).slice(-2)+'/'+today.getFullYear();
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

		function setCookie(name,value,days) {
			if(getCookie('cookie-auth') === "yes") {
				var expires = "";
				if (days) {
					var date = new Date();
					date.setTime(date.getTime() + (days*24*60*60*1000));
					expires = "; expires=" + date.toUTCString();
				}
				document.cookie = name + "=" + (value || "")  + expires + "; path=/";
			}
		}
		
		function eraseCookie(name) {   
			document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
		}

		function copy() {
			if(window.clipboardData) {
				window.clipboardData.clearData();
				window.clipboardData.setData("Text", 'coucou');
			} 
		}

		$('#close').click(function(){
			$('.game-overlay').fadeOut();
		});

		if(getCookie(date)) {
			var repsonses = getCookie(date).split('&');
			repsonses = repsonses.filter((a) => a);
			console.log(repsonses);

			for(var i = 0; i < repsonses.length; i++) {
				$('.try:nth-child('+ (i+1) +')').css('visibility', 'visible');
				$('.try:nth-child('+ (i+1) +') .try-percentage-res').text(repsonses[i] + ' %');
				$('.try:nth-child('+ (i+1) +') .try-percentage').css({
					'right' : ~(repsonses[i] - 100)+'%',
					'background-color' : '#00a063'
				});
			}
			if(repsonses.length < 3 || repsonses[repsonses.length-1] === '100') {
				$('.game-overlay_content_result').text("C'est gagné ! 🥳");
				$('.game-overlay_content_result').addClass('won');
			} else {
				$('.game-overlay_content_result').text("C'est perdu ! 😩");
				$('.game-overlay_content_result').addClass('lost');
			}

			$('.game-overlay').delay(1000).fadeIn(200);
			var auth = $('#validate').attr('data-auth');
			var response = $('#response').val();
			$.ajax({
				method: "POST",
				url: "function/response.php",
				data: { 
					auth: auth,
					response: response,
					date: date
				}
			})
			.done(function( msg ) {
				$('.today-title').text(msg);
				$('#response').val(msg);
				$('#validate_response').addClass('off').attr('id', '').text('Reviens demain !');
			});
		}


		function nbemojis(content) {
			if(content < 20) {
				return '🟩⬛️⬛️⬛️⬛️ '+content+' %\n';
			} else if( content < 40) {
				return '🟩🟩⬛️⬛️⬛️ '+content+' %\n'
			} else if( content < 60) {
				return '🟩🟩🟩⬛️⬛️ '+content+' %\n'
			} else if( content < 80) {
				return '🟩🟩🟩🟩⬛️ '+content+' %\n'
			} else {
				return '🟩🟩🟩🟩🟩 '+content+' %\n'
			}
		}

		$('#share').click(function(){

			var repsonses = getCookie(date).split('&');
			repsonses = repsonses.filter((a) => a);
			var content = "Mes resultats pour le Brad Pitch de la journée : \n";

			for(var i = 0; i < repsonses.length; i++) {
				content += nbemojis(repsonses[i]);
			}

			content += "et toi tu vas le trouver ? \n";

			var url = 'https://361b-2a01-cb08-8a5e-7800-65e3-bed7-69a3-17d0.eu.ngrok.io/bradpitch/';

			if(urlParams.get('date')) {
				url += '?date=' + urlParams.get('date');
			}

			if (navigator.share) {
				navigator.share({
					title: 'Brad Pitch 🍿',
					text: content,
					url: url,
				})
				.then(() => console.log('Successful share'))
				.catch((error) => console.log('Error sharing', error));
			} else {
				navigator.clipboard
				.writeText('Brad Pitch 🍿 \n' + content + url)
				.then(
					success => $('.copy').fadeIn().delay(1000).fadeOut(), 
					err => console.log("error copying text")
					);
			}
		});

		var entpress = 0;
		function game() {
			var auth = $('#validate').attr('data-auth');
			var response = $('#response').val();

			$.ajax({
				method: "POST",
				url: "function/auth.php",
				data: { 
					auth: auth,
					response: response,
					date: urlParams.get('date')
				}
			})
			.done(function( msg ) {
				if(entpress > 3) {

				} else {
					entpress += 1;

					var similarity = Math.round(msg);
					var percentage = 100 - similarity;

					$('.try:nth-child('+entpress+')').css('visibility', 'visible');
					$('.try:nth-child('+entpress+') .try-percentage').css({
						'right' : percentage+'%',
						'background-color' : '#00a063'
					});
					$('.try:nth-child('+entpress+') .try-percentage-res').text(similarity+' %');

					if(msg === 'won') {
						$('#validate_response').addClass('off').attr('id', '').text('Reviens demain !');
						$('.try:nth-child('+entpress+') .try-percentage').css('right', '0');
						$('.try:nth-child('+entpress+') .try-percentage-res').text('100 %');
						var tried = '';
						setTimeout(function(){
							$('.try').each(function(){
								if($(this).find($('.try-percentage-res')).text() != '') {
									tried += $(this).find($('.try-percentage-res')).text().replace(' %', '') + '&';
								}
							});
							setCookie(date, tried, 30);
						}, 1000);

						$('.game-overlay_content_result').text("C'est gagné ! 🥳");
						$('.game-overlay_content_result').addClass('won');
						$.ajax({
							method: "POST",
							url: "function/response.php",
							data: { 
								auth: auth,
								response: response,
								date: urlParams.get('date')
							}
						})
						.done(function( msg ) {
							$('.today-title').text(msg);
							$('#response').val(msg);
						});
						$('.game-overlay').delay(1000).fadeIn(200);
					}
					if(entpress === 3 && msg != 'won') {
						var tried = 
						$('.try:nth-child(1) .try-percentage-res').text().replace(' %', '') + '&' +  
						$('.try:nth-child(2) .try-percentage-res').text().replace(' %', '') + '&' +  
						$('.try:nth-child(3) .try-percentage-res').text().replace(' %', '');
						setCookie(date, tried, 30);

						$('.game-overlay_content_result').text("C'est perdu ! 😩");
						$('.game-overlay_content_result').addClass('lost');
						$.ajax({
							method: "POST",
							url: "function/response.php",
							data: { 
								auth: auth,
								response: response,
								date: urlParams.get('date')
							}
						})
						.done(function( msg ) {
							$('.today-title').text(msg);
							$('#response').val(msg);
							$('#validate_response').addClass('off').attr('id', '').text('Reviens demain !');
						});
						$('.game-overlay').delay(1000).fadeIn(200);
					}
				}
				console.log(msg);

			});
		}

		$("#response").on('keyup', function (e) {
			if (e.key === 'Enter' || e.keyCode === 13) {
				game();
			}
		});
		$('#validate_response').click(function(){
			game();
		});
	}
});