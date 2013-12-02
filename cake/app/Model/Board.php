<?php
	class Board extends Model{
		public $name = 'Board';
		  // public $belongsTo = array(
                // 'User' => array(
                //     'className' => 'User',
                //     'foreignKey' => 'user_id'
                // ));
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