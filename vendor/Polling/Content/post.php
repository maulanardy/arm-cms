<?php 
$pollingAnswer = new \Polling\Answer();

if(Io::param("polling_val")){
	$pollingAnswer->save();
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>