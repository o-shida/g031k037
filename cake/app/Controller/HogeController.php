<?php
//ここで受け取る
//hoge_cotroller スネークケース
 class HogeController extends AppController {
 	public $name = "Hogehoge";
 	public $components = array('DebugKit.Toolbar');//設定

 	public function index(){//アクション 各ページになる
 	
 	}
 	public function input(){

 	}

 	public function show(){
 		if($this->request->is('POST')){
 			$jikan = $this->request->data['Aisatsu']['jikan']
 			$mes = $this->Hoge->handan($jikan);
 			$this->set('say',$mes);
 		}else{
 			$this->flash(
 				'inputアクションからきてください',
 				array(
 					'controller' => 'hoge',
 					'action' => 'input'
 					)
 				);
 		}
 	}

 }