<div class="resultats">
	<h1>Mes rÃ©sultats :</h1>
	<?php 
	function formatResult($data) {
		if($data <= 20) {
			return 'ð©â¬ï¸â¬ï¸â¬ï¸â¬ï¸ '.$data.' %';
		}
		if($data <= 40) {
			return 'ð©ð©â¬ï¸â¬ï¸â¬ï¸ '.$data.' %';
		}
		if($data <= 60) {
			return 'ð©ð©ð©â¬ï¸â¬ï¸ '.$data.' %';
		}
		if($data <= 99) {
			return 'ð©ð©ð©ð©â¬ï¸ '.$data.' %';
		}
		if($data <= 100) {
			return 'ð©ð©ð©ð©ð© '.$data.' %';
		}
	}
	if(!empty($_COOKIE)) {
		foreach($_COOKIE as $key => $result) {
			if($key != "cookie-auth") {
				$data = explode('&', $result);
				echo '<div class="resultats-days">';
				echo '<p>'.$key.'</p>';
				echo '<h2>'.$game->responseOfTheDay(date('Y-m-d', strtotime($key))).'</h2>';
				foreach($data as $value) {
					if($value != "") {
						echo '<div class="resultats-days-data">'.formatResult($value).'</div>';
					}
				}
				echo '</div>';
			}
		}
	}
	?>
</div>