<?php
require realpath(__DIR__).'/../vendor/autoload.php'; //this autoloads everything

require_once realpath(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config').DIRECTORY_SEPARATOR.'app.php';

function init() {
    // Устанавливаем временную зону по умолчанию
    if (function_exists('date_default_timezone_set')) {
        date_default_timezone_set('Europe/Kiev');   
    }

    setlocale(LC_ALL, '');
    // Установка ukraine локали
    setlocale(LC_ALL, 'uk_UA');
}

/**
 * Set error reporting
 */
function setErrorLogging(){
    if (APP_ENV == 'local'){
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL | E_ERROR | E_WARNING | E_PARSE | E_NOTICE| E_DEPRECATED);
        ini_set('display_errors', "1");
    } else{
        error_reporting(E_ALL);
        ini_set('display_errors', "0");
    }
    ini_set('log_errors', "1");
    ini_set('error_log',  LOGS . '/error_log.php');
}


function conf($mix) {
    $url = CONFIG."/".$mix.".json";
    try{
        $jsonFile = file_get_contents($url);
        if($jsonFile === false){
            throw new Exception('Could not open json file!');
        }
        return json_decode($jsonFile, TRUE);
    } 
    catch (Exception $ex) {
        echo $ex->getMessage();
        return false;
    }
}

setErrorLogging();
init();

// spl_autoload_register(function($class) {
// 	$file = CORE."/".$class.EXT;
// 	if(is_file($file)) {
// 		require_once $file;
// 	}
	
// 	// $filename = MODELS . $class . EXT;

// 	// if (file_exists($filename)) {
// 	// 	include_once $filename;
// 	// }
// });

// spl_autoload_register(function($class) {
// 	$file = ROOT.'/'.str_replace('\\', '/', $class).'.php';
// 	var_dump($file);
// 	if(is_file($file)) {
// 		require_once $file;
// 	}
// });

// use core\App;

// $app = new App();
// $app->init();

require_once VENDOR.'/framework/Helper.php';
// require_once VENDOR.'/framework/Request.php';
// require_once VENDOR.'/framework/Router.php';

$router = new \Core\Router();
$router->direct(\Core\Request::uri());