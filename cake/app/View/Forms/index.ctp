<?php
	$url = 'http://b.hatena.ne.jp/o_shida/rss';
	$api = simplexml_load_file($url);
	var_dump($api);
	echo  $this->html->tag('h2',$this->html->link($api->channel->title,$api->channel->link));
 	echo "<br />";
 	foreach($api->item as $get){
 		echo $this->html->tag('h3',$get->title);
 		echo $this->html->tag('h4',$this->html->link($get->link,$get->link));
 		echo $this->html->tag('h4',$get->description);
 	}