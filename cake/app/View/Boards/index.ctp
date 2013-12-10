 <?php
 // var_dump($user_a);
echo $name = 'name:'.$user_a['name'];
// $name = $this->Session->read('myname');
// echo 'name: '.$this->Session->read('myname');
echo $this->Form->create('logout',array(//ログアウト
				'type' => 'post',
				'url' => 'logout'
				));
echo $this->Form->submit('logout',array('name'=>'point','div'=>false));
echo $this->Form->end();

echo $this->html->tag('br ');
echo $this->Form->create('asc',array(//昇順に並び替え
				'type' => 'post',
				'url' => 'index'
				));
echo $this->Form->submit('昇順',array('name'=>'asc','div'=>false));
echo $this->Form->create('des',array(//降順に並び替え
				'type' => 'post',
				'url' => 'index'
				));
echo $this->Form->submit('降順',array('name'=>'des','div'=>false));
echo $this->Form->end();

echo $this->Form->create('search',array(
	'type' => 'post',
	'url' => 'search'
	));
echo $this->Form->select('search.num',array(//検索件数
	'1' => '1件', 
	'2' => '2件',
	'3' => '3件',
	'4' => '4件',
	'5' => '5件',
	'6' => '6件', 
	'7' => '7件',
	'8' => '8件',
	'9' => '9件',
	'10' => '10件'));
echo $this->Form->text('search.word',array());//検索するワード
echo $this->Form->submit('検索',array('name'=>'search','div'=>false));//検索
echo $this->Form->end();

echo $this->html->link('コメントを投稿する','/Boards/create',array('name'=>'and'));

echo $this->html->tag('br ');
foreach($data as $value){
	$id = $value['Board']['id'];
	echo $value['Board']['comment'].' ';
	echo $value['Board']['created'].' ';
	foreach($user as $key){
		if($value['Board']['user_id'] == $key['User']['id']){
	 		echo $key['User']['name'].' ';
	 		echo $key['User']['email'].' ';
		 	if($user_a['name'] == $key['User']['name']){
			echo $this->html->link('編集','/Boards/edit/'.$id,array('escape'=>false));
			echo $this->html->link('×','/Boards/delete/'.$id,array('escape'=>false));
			}
		}
	}
	echo $this->html->tag('br ');
	// var_dump($id);

}
	
?>