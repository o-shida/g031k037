<?php
	//AppControllerという関数を呼び出している。関数の名前ですでにあるものを定義していしまうとエラーが出る。
	class BoardsController extends AppController {
		public $name = 'Boards';
		public $uses = array('Board');
		public $components = array('DebugKit.Toolbar');
		public $helpers = array('Html');
		public $layout = 'board';

		public function index(){
			$this->set('data',$this->Board->find('all',array('order' => 'Board.id DESC', 'limit' => 20)));
		}
		public function create($id = null){
			$this->set("action",$this->action);
			if(isset($this->request->data['create']['contribution'])){//コメント投稿する場合
				$this->set('data',$this->request->data['create']['contribution']); 
			}elseif($id != null){//編集する場合
				$this->set('id_data',$this->request->data['edit']); }
		}

		public function entry(){//コメントを保存
			$this->Board->toukou($this->request->data);
			$this->redirect(array('action' => 'index'));
		}

		public function compile($id = null){//コメントを編集
			if($id == null){
				$this->set('id_data',$this->request->data['edit']);
			}
		}

		public function last(){//編集結果を保存
			$this->Board->end($this->request->data['entry']);
			$this->redirect(array('action' => 'index'));
		}

		public function edit($id){//編集画面に移る
			$this->set("action",$this->action);
			$this->set('id_data',$this->Board->findById($id));
			$this->render('create');
		}

		public function delete($id){//削除
			$this->Board->delete($id);
			$this->redirect(array('action' => 'index'));
		}
	}