<?php
echo $this->html->link('投稿する','/Boards/create',array('name'=>'and'));
echo $this->html->tag('br ');
foreach($data as $value){
	$id = $value['Board']['id'];
	echo $value['Board']['comment'].' ';
	echo $value['Board']['timestamp'].' ';
	echo $this->html->link('編集','/Boards/edit/'.$id,array('escape'=>false));
	echo $this->html->link('×','/Boards/delete/'.$id,array('escape'=>false));
	echo $this->html->tag('br ');
	// var_dump($id);
}
?>