<?php 

if(isset($_POST["subscribe"])){
	
	$subscribe = new Subscribe\Subscribe();

	$subscribe->register($_POST["email"]);
}

if(isset($_POST["unsubscribe"])){
	
	$subscribe = new Subscribe\Subscribe();

	$subscribe->unregister($_POST["email"]);
}

?>