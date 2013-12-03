<?php
echo $this->Form->create('asc',array(//昇順に並び替え
				'type' => 'post',
				'url' => 'search'
				));
echo $this->Form->hidden('search.num',array('value' => $num));
echo $this->Form->hidden('search.word',array('value' => $word));
echo $this->Form->submit('昇順',array('name'=>'asc','div'=>false));
echo $this->Form->create('des',array(//降順に並び替え
				'type' => 'post',
				'url' => 'search'
				));
echo $this->Form->submit('降順',array('name'=>'des','div'=>false));
echo $this->Form->end();
$name = $this->Session->read('myname');
foreach($data as $value){
	$id = $value['Board']['id'];
	echo $value['Board']['comment'].' ';
	echo $value['Board']['created'].' ';
	foreach($user as $key){
		if($value['Board']['user_id'] == $key['User']['id']){
	 		echo $key['User']['name'].' ';
	 		echo $key['User']['email'].' ';
		 	if($name == $key['User']['name']){
			echo $this->html->link('編集','/Boards/edit/'.$id,array('escape'=>false));
			echo $this->html->link('×','/Boards/delete/'.$id,array('escape'=>false));
			}
		}
	}
	echo $this->html->tag('br ');
}
echo $this->Form->create('return',array(//ログアウト
				'type' => 'post',
				'url' => 'index'
				));
echo $this->Form->submit('戻る',array('name'=>'return','div'=>false));
echo $this->Form->end();
?>