<?php
	//AppControllerという関数を呼び出している。関数の名前ですでにあるものを定義していしまうとエラーが出る。
	class BoardsController extends AppController {
		public $name = 'Boards';
		public $uses = array('Board','User');
		public $components = array(
            'DebugKit.Toolbar', //デバッグきっと
            'Auth' => array( //ログイン機能を利用する
                'authenticate' => array(
                    'Form' => array(
                        'userModel' => 'User',
                        'fields' => array('username' => 'name','password' => 'password')
                    )
                ),
                //ログイン後の移動先
                'loginRedirect' => array('controller' => 'boards', 'action' => 'index'),
                //ログアウト後の移動先
                'logoutRedirect' => array('controller' => 'boards', 'action' => 'login'),
                //ログインページのパス
                'loginAction' => array('controller' => 'boards', 'action' => 'login'),
                //未ログイン時のメッセージ
                'authError' => 'あなたのお名前とパスワードを入力して下さい。',
            )
        );
		public $helpers = array('Html');
		public $layout = 'board';
		public function beforeFilter(){//login処理の設定
		 	$this->Auth->allow('login','logout','useradd');//ログインしないで、アクセスできるアクションを登録する
		 	$this->set('user',$this->Auth->user()); // ctpで$userを使えるようにする 。
		}

		public function login(){//ログイン
            if($this->request->is('post')){//POST送信なら
                if($this->Auth->login()){//ログイン成功なら
                	$nick = $this->request->data['User']['name'];
                	$this->Session->write('myname', $nick);
                    //$this->Session->delete('Auth.redirect'); //前回ログアウト時のリンクを記録させない
                    return $this->redirect($this->Auth->redirect()); //Auth指定のログインページへ移動
                }else{ //ログイン失敗なら
                    $this->Session->setFlash(__('ユーザ名かパスワードが違います'), 'default', array(), 'auth');
                }
            }
        }
 
        public function logout(){
            $this->Auth->logout();
            $this->Session->destroy(); //セッションを完全削除
            $this->Session->setFlash(__('ログアウトしました'));
            $this->redirect(array('action' => 'login'));
        }
 
		public function useradd(){
            if($this->request->is('post')) {
                if ($this->request->data['User']['password'] === $this->request->data['User']['pass_check']){
                    $data = $this->request->data;
                    $data['User']['password'] = AuthComponent::password($data['User']['password']);
                    $data['User']['pass_check'] = AuthComponent::password($data['User']['pass_check']);
                    $this->User->create();//ユーザーの作成

                    if ($this->User->save($data)){//バリデーションを呼び出して成功ならば
                        $mes = '新規ユーザーを追加しました';
                        $this->Session->setFlash(__($mes));   
                        $this->redirect(array('action' => 'login'));//リダイレクト    
                    }else{//失敗ならば
                        $mes = '登録できませんでした。やり直して下さい';
                    }
                }else{
                    $mes = "パスワードの値が一致しません。";
                }
                $this->Session->setFlash(__($mes));   
            }
        }

		public function index(){
            // $this->set('name',$this->request->data['User']['name']);
            if(isset($this->request->data['asc'])) {
                $this->set('data',$this->Board->find('all',array('order' => 'Board.id ASC')));
            }else{
		          $this->set('data',$this->Board->find('all',array('order' => 'Board.id DESC')));
            }
			$this->set('user',$this->User->find('all',array()));
		}
        //引数を$idのみにするとエラーが出てしまうため今のところ引数を　$id = null で記述しています
        	public function create($id = null){
			$this->set("action",$this->action);
			if(isset($this->request->data['create']['contribution'])){//コメント投稿する場合
				$this->set('data',$this->request->data['create']['contribution']); 
			}elseif($id != null){//編集する場合
				$this->set('id_data',$this->request->data['edit']); }
		}

		public function entry(){//コメントを保存
			$this->Board->toukou($this->request->data);
            $this->request->data['Board']['user_id'] = $this->Auth->user('id');
            $this->Board->save($this->request->data);
            $this->redirect('index');
			// $this->redirect(array('action' => 'index'));
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
        public function search(){
            $num = $this->request->data['search']['num'];
            $word = $this->request->data['search']['word'];
            $this->set('num',$num);
            $this->set('word',$word);
             // var_dump($word);
            if(isset($this->request->data['search'])) {
                if(isset($this->request->data['asc'])) {
                $this->set('data',$this->Board->find('all',array('limit' => $num ,'order' => 'Board.id ASC',
                'conditions' => array('Board.comment like' => '%'. $word. '%'))));
                 }else{
                  $this->set('data',$this->Board->find('all',array('limit' => $num ,'order' => 'Board.id DESC',
                'conditions' => array('Board.comment like' => '%'. $word. '%'))));
                }
                $this->set('user',$this->User->find('all',array()));
             }
    	}
    }