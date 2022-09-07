<?php  
include 'classes/ClassAuth.php';
$obj = new shuffle();
$shuf = $obj->shuf();
$seed = $obj->seed();
$shuffled = implode($obj->seeded_shuffle($shuf, $seed));
?>

<!-- Game -->
<div class="game">
	<h2 class="pitch">
		<?php 
		if(!empty($_GET["date"])){
			echo $game->pitchOfTheDay($_GET["date"]); 
			echo $game->getMention($_GET["date"]); 
		} else {
			if($game->pitchOfTheDay() != "") {
				echo $game->pitchOfTheDay(); 
				echo $game->getMention();
			} else {
				echo "Désolé je n'ai plus d'idée pour le moment.<br/>Vous pouvez m'aider en m'envoyant vos propositions par mail à <a class='black-link' href='mailto:couscous@antoine.world'>couscous@antoine.world</a>";
			}
		}
		?>
	</h2>
	<div class="game-keyboard">
		<input class="input" placeholder="Alors, c'est quoi ce film ?" id="response" type="text"/>
		<div class="result-response">
			<div class="try"><div class="try-percentage-res"></div><div class="try-percentage"></div></div>
			<div class="try"><div class="try-percentage-res"></div><div class="try-percentage"></div></div>
			<div class="try"><div class="try-percentage-res"></div><div class="try-percentage"></div></div>
		</div>
		<button id="validate_response">Valider</button>
	</div>
	<input type="hidden" id="validate" data-auth="<?php echo $shuffled; ?>">
</div>

<?php include 'gameoverlay.php'; ?>