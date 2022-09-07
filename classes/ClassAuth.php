<?php

class shuffle {

	private $user;
	private $pass;
	private $date;
	private $shuf;
	private $seed;

	public function __construct() {
		$this->user = str_split(md5("*******"));
		$this->pass = str_split(md5("*******"));
		$this->date = str_split(md5(date('dmY', time())));
	}

	public function shuf() {
		return $this->shuf = array_merge($this->user, $this->pass, $this->date);
	}

	public function seed() {
		return $this->seed = ***;
	}


	public function seeded_shuffle(array &$items, $seed = false) {
		$items = array_values($items);
		mt_srand($seed);
		for ($i = count($items) - 1; $i > 0; $i--) {
			$j = mt_rand(0, $i);
			list($items[$i], $items[$j]) = array($items[$j], $items[$i]);
		}
		return $items;
	}

	public function seeded_unshuffle(array &$items, $seed) {
		$items = array_values($items);

		mt_srand($seed);
		$indices = [];
		for ($i = count($items) - 1; $i > 0; $i--) {
			$indices[$i] = mt_rand(0, $i);
		}

		foreach (array_reverse($indices, true) as $i => $j) {
			list($items[$i], $items[$j]) = [$items[$j], $items[$i]];
		}
		return $items;
	}

}

?>