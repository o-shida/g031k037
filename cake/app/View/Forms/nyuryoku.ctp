<?php
echo $this->html->tag('h2','ユーザー登録フォーム');
echo $this->Form->create('touroku',array(
	'type' => 'post',
	'url' => 'result'
	));

//名字の入力
echo "名字";
echo $this->Form->text('touroku.myouji',array(
	));
echo "<br />";

//名前の入力
echo "名前";
echo $this->Form->text('touroku.name',array(
	));
echo "<br />";
echo "<br />";

//性別の入力
echo "性別";
echo "<br />";
echo $this->Form->radio('touroku.sex',
	array('0' => '男性','1' => '女性'),
	array('legend' => false,'value' => '1'));
echo "<br />";

//学年
echo "学年";
echo "<br />";
 // $list1 = array('0' => '学部1年', '1' => '学部2年','2' => '学部3年','3' => '学部4年');
echo $this->Form->select('touroku.gakunen',array(
	'0' => '学部1年', 
	'1' => '学部2年',
	'2' => '学部3年',
	'3' => '学部4年'),array('value' => '1'));
echo "<br />";
echo "<br />";

//好きなもの
echo "好きなもの";
echo "<br />";
echo $this->Form->checkbox('touroku.check.0',array('value' => '運動', 'checked' => true));
echo $this->Form->label('touroku.check.0','運動');
echo $this->Form->checkbox('touroku.check.1',array('value' => '漫画', 'checked' => false));
echo $this->Form->label('touroku.check.1','漫画');
echo $this->Form->checkbox('touroku.check.2',array('value' => '女の子', 'checked' => true));
echo $this->Form->label('touroku.check.2','女の子');
echo "<br />";

//コメント
echo "コメント";
echo $this->Form->text('touroku.comment',array(
	));
echo "<br />";

//パスワード
echo "パスワード";
echo $this->Form->password('touroku.password',array(
	));
echo "<br />";

//投稿時間
$now = date("H:i:s");
echo $this->Form->hidden('touroku.time',array(
	'value' => $now
	));


echo $this->Form->submit('送信',array('name'=>'input','div'=>false));
echo $this->Form->end();
