<?php 

if($userController->isLogin()){
	$event = new Event\Main();
	if($event->addVisitor($userController->id)){
		header("Location: ".\Io::param('event_url'));
	} else {
		header("Location: ".BASE);
	}
}