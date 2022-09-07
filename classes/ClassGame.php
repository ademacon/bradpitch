<?php

class Game {

	public $date;

	public function __construct() {
		$this->date = date('Y-m-d');
	}

	public function connect($dateConnect = false) {

		$databaseId = "**************************************";
		$url = "https://api.notion.com/v1/databases/$databaseId/query"; //api endpoint
		$token = '**************************************';
		$version = '****-**-**';

		$data_array =
		['filter' => 
			[
				"property"=>"date",
				"date"=>["equals"=>$dateConnect]
			]
		];

	$data = json_encode($data_array);

	$ch = curl_init();

	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_POST, true);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token,
		'Notion-Version: '.$version, 'Content-type: application/json'));

	$resp = curl_exec($ch);
	if($e = curl_error($ch))
	{
		echo $e;
		return $e;
	} else
	{
		$decoded = json_decode($resp, true);
		return $decoded['results'][0]['properties'];
	}
	curl_close($ch);
}

public function getRandomGame() {
	return date('Y-m-d', mt_rand(strtotime('2022-08-08'), time()));
}

public function pitchOfTheDay($dateConnect = false) {
	if($dateConnect) {
		$dateConnect = date('Y-m-d', strtotime($dateConnect));
	} else {
		$dateConnect = $this->date;
	}
	$properties = $this->connect($dateConnect);
	return $properties['pitch']['rich_text'][0]['text']['content'];
}

public function responseOfTheDay($dateConnect = false) {
	if($dateConnect) {
		$dateConnect = date('Y-m-d', strtotime($dateConnect));
	} else {
		$dateConnect = $this->date;
	}
	$properties = $this->connect($dateConnect);
	return $properties['response']['title'][0]['text']['content'];
}

public function getMention($dateConnect = false) {
	if($dateConnect) {
		$dateConnect = date('Y-m-d', strtotime($dateConnect));
	} else {
		$dateConnect = $this->date;
	}
	$properties = $this->connect($dateConnect);
	if(!empty($properties['mention-name']['rich_text'][0]['text']['content'])) {
		return '<br/><br/><a class="black-link" target="_blank" href="'.$properties['mention-url']['url'].'">@'.$properties['mention-name']['rich_text'][0]['text']['content'].'</a>';
	}
}

public function ISO($str) {
	$str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);
	$str = strtolower($str);
	return $str;
}

public function similarity($play, $game) {
	similar_text($play, $game, $perc);
	return $perc;
}

}