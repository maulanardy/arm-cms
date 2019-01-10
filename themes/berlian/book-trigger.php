<?php 
$event = new Event\Main();
$visitor = $event->getNewVisitor(date("Y-m-d H:i:s", time() - 5));

$data = new stdClass();

if($visitor){
	$data->status = true;
	$data->name = $visitor->user->name;
} else {
	$data->status = false;
	$data->name = "";
}

echo json_encode($data);

