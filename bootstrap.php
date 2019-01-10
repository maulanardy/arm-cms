<?php
ob_start();
session_start();

define('DOMAIN'         , 'http://'.$_SERVER ['SERVER_NAME'].'/');
define('FOLDER'         , 'armcms/');
define('BASE'           , DOMAIN.FOLDER);
define('BACKEND'        , 'b4ck3nd');
define('ROOT'           , $_SERVER['DOCUMENT_ROOT'].'/');
define('PATH'           , ROOT.FOLDER);
define('SYSTEM'         , PATH.'system/');
define('MEDIA'          , PATH.'media/');
define('UPLOAD'         , BASE.'media/upload/');
define('THUMBS'         , BASE.'media/thumbs/');
define('RESUME'         , BASE.'media/resume/');
define('SQUARE'         , THUMBS.'square/');
define('WIDE'           , THUMBS.'wide/');
define('LANG'           , (!empty($_SESSION["lang"]) ? $_SESSION["lang"] : 1) );
define('TIMEZONE'       , 'Asia/Jakarta');
define('ENVIRONMENT'    , 'production');
define('BASECODEKEY'    , 'm4ul4n4rdy');
define('IG_TOKEN'       , "1449189807.74b4a20.3bc8bdada6a646a8a12174eccf398822");


if (defined('ENVIRONMENT')) {
    switch (ENVIRONMENT) {
        case 'development':
            ini_set('display_errors', 1);
            ini_set('display_startup_errors',0);
            error_reporting(E_ALL);
        break;
    
        case 'preview':
            ini_set('display_errors', 1);
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
        break;
        case 'production':
            ini_set('display_errors', 0);
        break;

        default:
            exit('The application environment is not set correctly.');
    }
}



if (version_compare(phpversion(), '5.3', '<=')) {
    echo 'Sorry, This project requires PHP version > 5.3, you\'re currently running: ' . phpversion();
    exit();
}

if(function_exists('date_default_timezone_set')) date_default_timezone_set( TIMEZONE ); 

include SYSTEM."config/database.php";

include SYSTEM."config/constant.php";

require 'Autoload.php';



$database = array(
    'connection' => 'development',
    'development' => 'mysql://'.$config['dbuser'].':'.$config['dbpassword'].'@'.$config['dbhost'].'/'.$config['dbname'].'?charset=utf8',
);

ActiveRecord\Config::initialize(function($config) use ($database) {
    $config->set_connections($database);
    $config->set_default_connection($database['connection']);
});

/*
 * --------------------------------------------------------------------
 * LOAD THE BRAIN . . .
 * --------------------------------------------------------------------
 *
 * 
 *
 */
require_once PATH.'system/core/brain.php';
?>