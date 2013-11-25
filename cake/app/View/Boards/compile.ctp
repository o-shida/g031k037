<?php
		//投稿を確認する画面
		echo $this->Form->create('entry',array(
		'type' => 'post',
		'url' => 'last'
		));
		echo $this->html->tag('h2',$id_data['comment']);
		echo $this->Form->hidden('entry.comment',array('value' => $id_data['comment']));
		echo $this->Form->hidden('entry.id',array('value' => $id_data['id']));
		echo 'この内容で編集してよろしいですか？';
		echo $this->html->tag('br ');
		echo $this->Form->submit('確定する',array('name'=>'change','div'=>false));
		echo $this->Form->end();

?>