<?php

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

// coockies

// setcookie("name", 'Anonymouse');
// setcookie("TestCookie", $value, time()+3600);  /* срок действия 1 час */

// Вывести одно конкретное значение cookie
// echo $_COOKIE["name"];

// echo 'Привет, ' . htmlspecialchars($_COOKIE["name"]) . '!';
// Вывод всех cookie
// print_r($_COOKIE);


// setcookie("TestCookie", $value, time()+3600, "/~rasmus/", "example.com", 1);

// Calculate 60 days in the future
// seconds * minutes * hours * days + current time

// $inTwoMonths = 60 * 60 * 24 * 60 + time(); 
// setcookie('lastVisit', date("G:i - m/d/y"), $inTwoMonths);

// if(isset($_COOKIE['lastVisit'])) {
//     $visit = $_COOKIE['lastVisit'];
//     echo "Your last visit was - ". $visit;
// } else
// 	echo "You've got some stale cookies!";


// echo session_name();
require_once VENDOR.'/framework/Helper.php';
require_once VENDOR.'/framework/Request.php';
require_once VENDOR.'/framework/Router.php';

$router = new Router();
$router->direct(Request::uri());