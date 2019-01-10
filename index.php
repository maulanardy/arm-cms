<?php
include "bootstrap.php";

// /* LOAD ACTIVE TEMPLATE */
$TEMPLATEFOLDER = Ma\Controller\Setting\Main::get('active_template_folder');



define('THEMES'     , BASE.'themes/'.$TEMPLATEFOLDER.'/');
define('TITLE_APP'     , Ma\Controller\Setting\Main::get('default_web_title'));

$dictionary = $ARM->language->getCodeById(LANG);

/* TEMPLATE LOADER */

$first = helper::uri(1);
$second = helper::uri(2);

$userController = new User\Main();

if(Ma\Controller\Setting\Main::get('web_offline_status') == "YES"){
		include "themes/$TEMPLATEFOLDER/offline.php"; 
} else {

	if(!empty($first)){
		if(file_exists("themes/$TEMPLATEFOLDER/$first.php")){ 
			include "themes/$TEMPLATEFOLDER/$first.php"; 
		}else if(is_dir("themes/$TEMPLATEFOLDER/$first/")){
			if(!empty($second)){
				include "themes/$TEMPLATEFOLDER/$first/$second.php"; 
			}else{
				include "themes/$TEMPLATEFOLDER/$first/index.php"; 
			}
		}else if($first == "home"){
			include "themes/$TEMPLATEFOLDER/index.php"; 
		}else if(Ma\Model\Posts\Category::find("all", array("conditions" => array("slug = ?", $first)))){
			include "themes/$TEMPLATEFOLDER/post.php"; 
		}else{
			include "themes/$TEMPLATEFOLDER/content.php"; 
		}
	}else{ 
		 include "themes/$TEMPLATEFOLDER/index.php";
	}
}

//echo "$load $slug $mid";

?>