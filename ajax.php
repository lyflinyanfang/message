<?php

$function = $_POST['function'];

$log = array();

switch($function){
	/*get state case*/
	case('getState'):
		/*check file available or not*/
		if(file_exists('data.txt')){
			$lines = file('data.txt');
		}
		$log['state'] = count($lines);
		break;

	/*update case*/
	case('update'):
	$state = $_POST['state'];
	if(file_exists('data.txt')){
		$lines = file('data.txt');
	}
	$count = count($lines);
	if($state == $count){
		/*if state & count are equal*/
		$log['state'] = $state;
		$log['text'] = false;
	}else{
		$text = array();
		$log['state'] = $state + count($lines) - $state;
		foreach($lines as $line_num => $line){
			if($line_num >= $state){
				$text[] = $line = str_replace("\n", "", $line);
			}
		}
		$log['text'] = $text;
	}
	break;

	case('send'):
		$nickname = htmlentities(strip_tags($_POST['nickname']));
		$reg_exUrl = "/(http|http|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
		$message = htmlentities(strip_tags($_POST['message']));
		if(($message) != "\n"){
			if(preg_match($reg_exUrl, $message, $url)){
				$message = preg_replace($reg_exUrl, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $message);
			}
			fwrite(fopen('data.txt', 'a'), "<span>".$nickname ."</span>", $message = str_replace("\n", "", $messgae) . "\n")
		}
		break;	
}
echo json_encode($log);

?>