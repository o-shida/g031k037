<?php
App::import('Vendor','facebook',array('file' => 'facebook'.DS.'src'.DS.'facebook.php'));
 
	//AppControllerという関数を呼び出している。関数の名前ですでにあるものを定義していしまうとエラーが出る。
	class BoardsController extends AppController {
		public $name = 'Boards';
		public $uses = array('Board','User','NewUser');
		public $components = array(
            'DebugKit.Toolbar', //デバッグきっと
            'TwitterKit.Twitter', //twitter
            'RequestHandler',//MobileでみているかPC上でみているかを判断する
            'Auth' => array( //ログイン機能を利用する
                'authenticate' => array(
                    'Form' => array(
                        'userModel' => 'User',
                        'fields' => array('username' => 'name','password' => 'password')
                    )
                ),
                //ログイン後の移動先
                'loginRedirect' => array('controller' => 'boards', 'action' => 'index/'),
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
            //許可
		 	$this->Auth->allow('m_index','login','logout','useradd','twitter_login','oauth_callback','index','facebook','fbpost','createFacebook');//ログインしないで、アクセスできるアクションを登録する
		 	$this->set('user_a',$this->Auth->user()); // ctpで$userを使えるようにする 
		}

        public function twitter_login(){//twitterのOAuth用ログインURLにリダイレクト
            $this->redirect($this->Twitter->getAuthenticateUrl(null, true));
        }
 

        public function oauth_callback() {
            if(!$this->Twitter->isRequested()){//認証が実施されずにリダイレクト先から遷移してきた場合の処理
                $this->flash(__('invalid access.'), '/', 5);
                return;
            }
            $this->Twitter->setTwitterSource('twitter');//アクセストークンの取得を実施
            $token = $this->Twitter->getAccessToken();
            $data = $this->NewUser->signin($token); //ユーザ登録
            $this->Auth->login($data); //CakePHPのAuthログイン処理
            $this->redirect($this->Auth->loginRedirect); //ログイン後画面へリダイレクト
        }


        function showdata(){//トップページ
            $facebook = $this->createFacebook(); //セッション切れ対策 (?)
            $myFbData = $this->Session->read('mydata');//facebookのデータ
            //$myFbData_kana = $this->Session->read('fbdata_kana'); //フリガナ
            //pr($myFbData_kana); //フリガナデータ表示
            pr($myFbData);//表示
            // $this->fbpost("hello world");//facebookに投稿
        }
     
        public function facebook(){//facebookの認証処理部分
            $this->autoRender = false;
            $this->facebook = $this->createFacebook();
            $user = $this->facebook->getUser();//ユーザ情報取得
            if($user){//認証後
                $me = $this->facebook->api('/me','GET',array('locale'=>'ja_JP'));//ユーザ情報を日本語で取得
                $this->Session->write('mydata',$me);//fbデータをセッションに保存
                $data = $this->NewUser->signinfb($this->Session->read('mydata'));
                if ($this->Auth->login($data))
                    return $this->redirect($this->Auth->redirect());
                //フリガナを取得する．
                //$me_kana = $this->facebook->api('/fql?q=SELECT+first_name%2C+sort_first_name%2C+last_name%2C+sort_last_name%2Cname+FROM+user+WHERE+uid+%3D+'.$me['id'].'&locale=ja_JP');//ふりがな
                //if(!empty($me_kana)){//フリガナ設定をしているユーザのみ
                // mb_convert_variables('UTF-8', 'auto', $me_kana);
                // $this->Session->write('fbdata_kana',$me_kana);//フリガナデータをセッションに保存
            //}
                // $this->redirect('showdata');
        }else{//認証前
            $url = $this->facebook->getLoginUrl(array(
            'scope' => 'email,publish_stream,user_birthday'
            ,'canvas' => 1,'fbconnect' => 0));
            $this->redirect($url);
        }
        }
     
        private function createFacebook() {//appID, secretを記述
            return new Facebook(array(
                'appId' => '1438742749671249',
                'secret' => 'a92d5b25a8795cda2c618f6767f9a2c3'
            ));
        }
     
        public function fbpost($postData) {//facebookのwallにpostする処理
            $facebook = $this->createFacebook();
            $attachment = array(
                'access_token' => $facebook->getAccessToken(), //access_token入手
                'message' => $postData,
                'name' => "test",
                'link' => "http://twitter.com/gak_rak",
                'description' => "test",
            );
            $facebook->api('/me/feed', 'POST', $attachment);
        }

		public function login(){//ログイン
            if($this->RequestHandler->isMobile()){
                $this->layout = 'jq_m';
            }
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
 
        public function logout(){//ログアウト
            $this->Auth->logout();
            $this->Session->destroy(); //セッションを完全削除
            $this->Session->setFlash(__('ログアウトしました'));
            $this->redirect(array('action' => 'login'));
        }
 
		public function useradd(){//新規登録
            if($this->RequestHandler->isMobile()){
                $this->layout = 'jq_m';
            }
            if($this->request->is('post')) {
                if ($this->request->data['User']['password'] === $this->request->data['User']['pass_check']){//パスワードが一致するか
                    $data = $this->request->data;
                    $data['User']['password'] = AuthComponent::password($data['User']['password']);
                    // $data['User']['pass_check'] = AuthComponent::password($data['User']['pass_check']);
                    $this->User->create();//ユーザーの作成

                    if ($this->User->save($data)){//バリデーションを呼び出して成功ならば
                        $mes = '新規ユーザーを追加しました';
                        $this->Session->setFlash(__($mes));   
                        $this->redirect(array('action' => 'login'));//リダイレクト    
                    }else{//失敗ならば
                        $mes = '登録できませんでした。やり直して下さい';
                    }
                }else{//パスワードの値が一致しなかった場合
                    $mes = "パスワードの値が一致しません。";
                }
                $this->Session->setFlash(__($mes));   
            }
        }

		public function index(){
            if($this->RequestHandler->isMobile()){
                $this->layout = 'jq_m';
            }
             $this->set("action",$this->action);
            // $this->set('name',$this->request->data['User']['name']);
            if(isset($this->request->data['asc'])) {
                $this->set('data',$this->Board->find('all',array('order' => 'Board.id ASC')));
            }else{
		         $box = $this->set('data',$this->Board->find('all',array('order' => 'Board.id DESC')));
            }
			$this->set('user',$this->User->find('all',array()));
		}
        //引数を$idのみにするとエラーが出てしまうため今のところ引数を　$id = null で記述しています
        	public function create($id = null){
            if($this->RequestHandler->isMobile()){
                $this->layout = 'jq_m';
            }
			$this->set("action",$this->action);
			if(isset($this->request->data['create']['contribution'])){//コメント投稿する場合
				$this->set('data',$this->request->data['create']['contribution']); 
			}elseif($id != null){//編集する場合
				$this->set('id_data',$this->request->data['edit']); }
		}

		public function entry(){//コメントを保存
            if($this->RequestHandler->isMobile()){
                $this->layout = 'jq_m';
            }
			$this->Board->toukou($this->request->data);
            $this->request->data['Board']['user_id'] = $this->Auth->user('id');
            $this->Board->save($this->request->data);
            $this->redirect('index');
			// $this->redirect(array('action' => 'index'));
		}

		public function compile($id = null){//コメントを編集
            if($this->RequestHandler->isMobile()){
                $this->layout = 'jq_m';
            }
			if($id == null){
				$this->set('id_data',$this->request->data['edit']);
			}
		}

		public function last(){//編集結果を保存
            if($this->RequestHandler->isMobile()){
                $this->layout = 'jq_m';
            }
			$this->Board->end($this->request->data['entry']);
			$this->redirect(array('action' => 'index'));
		}

		public function edit($id){//編集画面に移る
            if($this->RequestHandler->isMobile()){
                $this->layout = 'jq_m';
            }
			$this->set("action",$this->action);
			$this->set('id_data',$this->Board->findById($id));
			$this->render('create');
		}

		public function delete($id){//削除
			$this->Board->delete($id);
			$this->redirect(array('action' => 'index'));
		}
        public function search(){//検索
            if($this->RequestHandler->isMobile()){
                $this->layout = 'jq_m';
            }
            $num = $this->request->data['search']['num'];
            $word = $this->request->data['search']['word'];
            $this->set('num',$num);
            $this->set('word',$word);
             // var_dump($word);
            if(isset($this->request->data['search'])) {
                if(isset($this->request->data['asc'])) {//昇順が押されたとき
                $this->set('data',$this->Board->find('all',array('limit' => $num ,'order' => 'Board.id ASC',
                'conditions' => array('Board.comment like' => '%'. $word. '%'))));
                 }else{//初期状態と降順が押されたとき
                $this->set('data',$this->Board->find('all',array('limit' => $num ,'order' => 'Board.id DESC',
                'conditions' => array('Board.comment like' => '%'. $word. '%'))));
                }
                $this->set('user',$this->User->find('all',array()));
             }
    	}
    }
