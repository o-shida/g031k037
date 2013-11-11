<h2>今の時間帯は？？</h2>
<?php
	echo $this->Form->create('Aisatsu', array(
		'type' => 'post',
		'url' => 'show'
	));

	echo $this->Form->input('Aisatshi.jikan',array(
		'label' => "時間帯"
	));

	echo $this->Form->submit();
	echo $this->Form->end();
?>