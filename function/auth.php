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
$dateresponse = date('d/m/Y');
$ip = $_SERVER['REMOTE_ADDR'];

if(!empty($date)) {
	$dateresponse = $date;
}

if(file_get_contents('dbusers.json')) {
	$actual = file_get_contents('dbusers.json');
	$actual = json_decode($actual, true);
	array_push($actual, array($ip => array($dateresponse, date('H:i'), $response)));
	$resultcontent = $actual;
} else {
	$resultcontent = array(array($ip => array($dateresponse, date('H:i'), $response)));
}

file_put_contents('dbusers.json', json_encode($resultcontent));


include '../classes/ClassGame.php';
$game = new game();
$responseToday = $game->responseOfTheDay($date);
$PlayIso = $game->ISO($response);
$GameIso = $game->ISO($responseToday);

if($PlayIso === $GameIso) {
	echo 'won';
} else {
	echo $game->similarity($PlayIso, $GameIso);
}

