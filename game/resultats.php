<div class="resultats">
	<h1>Mes résultats :</h1>
	<?php 
	function formatResult($data) {
		if($data <= 20) {
			return '🟩⬛️⬛️⬛️⬛️ '.$data.' %';
		}
		if($data <= 40) {
			return '🟩🟩⬛️⬛️⬛️ '.$data.' %';
		}
		if($data <= 60) {
			return '🟩🟩🟩⬛️⬛️ '.$data.' %';
		}
		if($data <= 99) {
			return '🟩🟩🟩🟩⬛️ '.$data.' %';
		}
		if($data <= 100) {
			return '🟩🟩🟩🟩🟩 '.$data.' %';
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