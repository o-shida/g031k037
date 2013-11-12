<?php
	$ID = 'dj0zaiZpPXBpeTBpOU9GRk1nMyZzPWNvbnN1bWVyc2VjcmV0Jng9NTE-';
	$url = 'http://b.hatena.ne.jp/o_shida/rss';
	$api = simplexml_load_file($url);
	// var_dump($api);
	echo  $this->html->tag('h2',$this->html->link($api->channel->title,$api->channel->link));
 
 	foreach($api->item as $get){
 		echo $this->html->tag('h3',$get->title);
 		echo $this->html->tag('h4',$this->html->link($get->link,$get->link));
 		echo $this->html->tag('h4',$get->description);
 		$contents = $get->title;
 		$data = simplexml_load_file('http://jlp.yahooapis.jp/KeyphraseService/V1/extract?appid='.$ID.'&sentence='.urlencode($contents).'');
 		echo $this->html->tag('h4','キーワード:'.$data->Result->Keyphrase);
 	}
// var_dump($data);