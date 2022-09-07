<div class="game-overlay">
	<div class="game-overlay_content">
		<h2 class="game-overlay_content_result"></h2>
		<div class="game-overlay_content_explications">
			Le titre du film était: 
			<br><span class="today-title"></span>
			<br/><br><a class="button-link-black" href="?date=<?php echo date('Y-m-d', time()-3600*24*1); ?>">Celui d'hier</a>
			<br/><a class="button-link-black" href="?date=<?php echo $game->getRandomGame(); ?>">Aléatoire<small>Bientôt dispo</small></a> 
			<br><br><a class="underlined" href="#share" id="share">Partagez vos résultats</a>
			<div class="copy">Le message a été copié dans le presse papier</div>
			<br><br><a class="button-link-black" href="#close" id="close">Fermer la fenêtre</a>
		</div>
	</div>
</div>