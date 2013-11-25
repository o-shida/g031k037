<?php
	class Board extends Model{
		public $name = 'Board';
	
		//create,save等はModelの中で既に定義されているため、function createなどするとエラーがでる
		public function toukou($data){
			$inputdata['comment'] = $data['create']['contribution'];
			$this->save($inputdata);
		}

		public function end($id){
			$inputdata['Board']['id'] = $id['id'];
			$inputdata['Board']['comment'] = $id['comment'];
			$this->save($inputdata);
		}
	}
?>