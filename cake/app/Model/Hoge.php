<?php
class Hoge extends Model{
	public $name = 'Hoge';
	public $useTable = false;

	public function handan($jikan){
		if($jikan == '朝'){
			$mes = 'おはよう';
		}elseif($jikan == '夜'){
			$mes = 'こんばんわ';
		}else{
			$mes = 'こんにちは';
		}
		return $mes;
	}
}
?>