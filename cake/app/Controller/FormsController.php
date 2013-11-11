<?php
//ここで受け取る
//hoge_cotroller スネークケース
 class FormsController extends AppController {
 	public $name = "Forms";//コントローラー名
 	public $components = array('DebugKit.Toolbar');//設定
 	public $helpers = array('Html');

 	public function result(){
		// $Form = $this->request->data['touroku'];
		// $this->set('Userdata',$Form);
		}
	public function kiso1(){
	}
 	public function nyuryoku(){
 	}

 }

 