<?php 

if($_SERVER['REQUEST_METHOD'] != 'POST') { exit("bye"); }

include '../classes/ClassAuth.php';
$obj = new shuffle();
$seed = $obj->seed();
$shuf = $obj->shuf();
$shuffled = $_POST['auth'];
$shuffled = str_split($shuffled);
$unshuffled = implode($obj->seeded_unshuffle($shuffled, $seed));

if(implode($shuf) != $unshuffled) {
	exit("bye");
} 

// Maintenant que la vérif est faite on peut faire le test de réponse

$response = $_POST['response'];
$date = $_POST['date'];


include '../classes/ClassGame.php';
$game = new game();

echo $game->responseOfTheDay($date); 

?>