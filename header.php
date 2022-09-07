<?php 
include 'classes/ClassGame.php';
$game = new game();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" lang="fr">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🍿</text></svg>">
	<title>Brad Pitch</title>
	<link rel="stylesheet" type="text/css" href="https://bradpitch.antoine.world/dist/css/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet"> 
</head>
<body>
	<header class="header">
		<a class="menu" href="#menu">☰</a>
		<a href="/"><h1 class="logo">B<span class="over">r</span>ad Pitch <span class="emoji">🍿</span></h1></a>
		<a class="infos" href="#infos">ⓘ</a>
	</header>
	<div class="header-overlay"></div>
	<div class="menu-header">
		<div class="menu-header-flex">
			<a class="button-link-black" href="/?date=<?php echo date('Y-m-d', time()-3600*24*1); ?>">Celui d'hier</a>
			<a class="button-link-black" href="?date=<?php echo $game->getRandomGame(); ?>">Aléatoire<small>Bientôt dispo</small></a>
			<a class="button-link-black" href="/resultats">Voir mes résultats</a>
			<a class="button-link-black" href="#close-menu" id="close-menu">Fermer le menu</a>
		</div>
	</div>
	<div class="menu-infos">
		<div class="menu-infos-flex">
			<div class="menu-infos-translate">
				Les règles du jeu sont simples&#8239;: <br/><br/>

				Devinez le titre d’un film associé à un mauvais pitch&#8239;! Vous avez 3 guess&#8239;: pour chaque guess, le jeu vous montre le pourcentage de similitude entre votre réponse et le titre du film recherché.<br/>

				Par ex&#8239;: pour deviner "Shining", "The Shinning" est correct à 78%, et "Shinning" est correct à 93%. Soyez précis 🤓<br/><br/>
				S'il s'agit d'une saga, il faut trouver le nom de celle-ci et pas le nom de l'épisode. Par ex&#8239;: "Harry Potter" et non "Harry Potter et la chambre des secrets".
				<br/><br/>
				Un nouveau Brad Pitch tous les jours à  minuit&#8239;!
				<br/><br/>

				Pour toute question ou proposition, contactez moi par mail ✍️ à&#8239;: <a class="underlined" href="mailto:couscous@antoine.world">couscous@antoine.world</a><br/><br/>
				<a class="button-link-black" href="#close-menu" id="close-infos">Fermer les infos</a>
			</div>
		</div>
	</div>