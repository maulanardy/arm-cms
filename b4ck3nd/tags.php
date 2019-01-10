<?php 
include("../bootstrap.php");

// ob_end_clean();
if(!$ARM->admin->isLoged()){
    header("Location: ".BASE.BACKEND."/login.php");
}

$tags = new \Ma\Model\Posts\Tags();
$query = $tags->find("all", array("conditions" => array("name like ?", "%" . $_GET['term'] . "%"))); 

foreach ($query as $key => $value) {
	$res[] = $value->name;
}

echo json_encode($res);

?>