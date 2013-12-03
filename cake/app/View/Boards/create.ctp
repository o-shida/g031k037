<?php
	if(empty($data)){ //indexで投稿ボタンが押されたら	
		if($action === 'edit'){	//移動する前のアクションがeditならば（編集するとき）
			echo $this->Form->create('edit',array(
				'type' => 'post',
				'url' => 'compile'
				));
			echo $this->Form->label('edit.comment','編集内容');
			echo $this->Form->text('edit.comment', array(
				'value' => $id_data['Board']['comment'],
				'required' => 'required'
				));	
			echo $this->Form->hidden('edit.id',array('value' => $id_data['Board']['id']));
			echo $this->Form->submit('投稿する',array('name'=>'point','div'=>false));
			echo $this->Form->end();
		}else{ //移動する前のアクションがedit以外、ここではcreateならば（コメントを投稿するとき）
			echo $this->Form->create('create',array(
				'type' => 'post',
				'url' => 'create'
				));
			echo $this->Form->label('create.contribution','投稿内容');
			echo $this->Form->text('create.contribution',array(
				'required' => 'required'
				));
			echo $this->Form->submit('投稿する',array('name'=>'reg','div'=>false));
			echo $this->Form->end();
		}
	}elseif(isset($this->request->data['create'])){//createの配列ににデータが入っていれば
		echo $this->Form->create('entry',array(
		'type' => 'post',
		'url' => 'entry'
		));
		echo $this->html->tag('h2',$data);
		echo $this->Form->hidden('create.contribution',array(
		));
		echo 'この内容で投稿してよろしいですか？';
		echo $this->html->tag('br ');
		echo $this->Form->submit('確定する',array('name'=>'decision','div'=>false));
		echo $this->Form->end();
	}
?>

