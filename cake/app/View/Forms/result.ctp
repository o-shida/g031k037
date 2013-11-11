<?php
if(isset($this->request->data['input'])){
	echo $this->html->tag('h2','この情報で登録して大丈夫ですか？');
echo $this->Form->create('Userdata',array(
	'type' => 'post',
	'url' => 'result'
	));

echo "名字：". $this->request->data['touroku']['myouji'];
echo "<br />";
echo "名前:". $this->request->data['touroku']['name'];
echo "<br />";
echo "性別:";
if($this->request->data['touroku']['sex'] == '0'){
	echo "男性";
}elseif( $this->request->data['touroku']['sex']){
	echo "女性";
}
echo "<br />";
echo "学年:";
if( $this->request->data['touroku']['gakunen'] == '0'){
	echo "学部1年";
}elseif( $this->request->data['touroku']['gakunen'] == '1'){
	echo "学部2年";
}elseif( $this->request->data['touroku']['gakunen'] == '2'){
	echo "学部3年";
}elseif( $this->request->data['touroku']['gakunen'] == '3'){
	echo "学部4年";
}
echo "<br />";
echo "好きなもの：";
foreach ( $this->request->data['touroku']['check'] as $key) {
	if($key != '0'){
		echo $key;
	}
}
echo "<br />";
echo "コメント：".$this->request->data['touroku']['comment'];
echo "<br />";
echo "パスワード:".$this->request->data['touroku']['password'];
echo "<br />";
echo "投稿時間：".$this->request->data['touroku']['time'];
echo "<br />";
echo "<br />";
echo $this->Form->submit('登録',array('name'=>'reg','div'=>false));
// echo $this->Form->submit();
echo $this->Form->end();
}elseif(isset($this->request->data['reg'])){
	echo $this->html->tag('h2','ありがとうございました');
	echo $this->html->link('最初に戻る','/Forms/nyuryoku',array('escape'=>false));
}

