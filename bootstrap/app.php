<?php

// echo '<h3>DIRECTORY_SEPARATOR (string): '.DIRECTORY_SEPARATOR.'</h3>';
// echo '<h3>PATH_SEPARATOR (string): '.PATH_SEPARATOR.'</h3>';
// echo '<h3>SCANDIR_SORT_ASCENDING (integer): '. SCANDIR_SORT_ASCENDING.'</h3>';   
// echo '<h3>SCANDIR_SORT_DESCENDING (integer): '. SCANDIR_SORT_DESCENDING.'</h3>';   
// echo "<h3>SCANDIR_SORT_NONE (integer): " . SCANDIR_SORT_NONE.'</h3>';

// var_dump(__DIR__);
// var_dump(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config/app.php');
// var_dump(realpath(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config'));

require_once realpath(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config').DIRECTORY_SEPARATOR.'app.php';

// var_dump(APP);

// Получить URI текущей страницы

// function getURI(){
//     return $_SERVER['REQUEST_URI'];
// }

// function getURI()
// {
//     if (isset($_SERVER['REQUEST_URI'])) {
//         return $_SERVER['REQUEST_URI'];
//     }
// }

// function getURI() 
// {
//     if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])){
//         return $_SERVER['REQUEST_URI'];
//     }
// }

// function getURI()
// {
//     if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])){
//         // var_dump(debug_backtrace());
//         debug_print_backtrace();
//         return trim($_SERVER['REQUEST_URI'], '/');
//     }
// }
// получаем строку запроса
// $uri = getURI();
// echo "<pre>";
// print_r($uri);
// echo "</pre>";
// // выведет примерно следующее: Friday
// echo date("l");


// // выведет примерно следующее: Friday 6th of March 2020 04:19:37 PM
// echo date('l jS \of F Y h:i:s A');

// // выведет: July 1, 2020 is on a Wednesday
// echo "July 1, 2020 is on a " . date("l", mktime(0, 0, 0, 7, 1, 2020));

// // выведет примерно следующее: Fri, 06 Mar 20 16:19:37 +0200
// echo date(DATE_RFC822);

// // выведет примерно следующее: 2019-09-28T00:00:00+03:00
// echo date(DATE_ATOM, mktime(0, 0, 0, 9, 28, 2019));

// // Получение временной зоны по умолчанию
// echo "<h2>Get date default timezone</h2>";
// echo date_default_timezone_get();

// // Получение временной зоны по умолчанию
// echo "<h2>Get date timezone from php.ini</h2>";

// if (ini_get('date.timezone')) {
//     echo 'date.timezone: ' . ini_get('date.timezone');
// }

// // Получение временной зоны по умолчанию
// echo "<h2>Set date default timezone</h2>";
// date_default_timezone_set('Europe/Kiev');

// if (date_default_timezone_get()) {
//     echo 'date_default_timezone_set: ' . date_default_timezone_get();
// }

// // Устанавливаем временную зону по умолчанию
// if (function_exists('date_default_timezone_set')) {
//     date_default_timezone_set('Europe/Kiev');   
// }

// setlocale(LC_ALL, '');
// // Установка ukraine локали
// setlocale(LC_ALL, 'uk_UA');

function init() {

    // Устанавливаем временную зону по умолчанию
    if (function_exists('date_default_timezone_set')) {
        date_default_timezone_set('Europe/Kiev');   
    }

    setlocale(LC_ALL, '');
    // Установка ukraine локали
    setlocale(LC_ALL, 'uk_UA');
    
}

// 
// echo "<h2>Get display errors</h2>";

// echo ini_get('display_errors');
  
// echo "<h2>Set display errors</h2>";

// if (!ini_get('display_errors')) {
//     ini_set('display_errors', '1');
// }   

// echo ini_get('display_errors');



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

setErrorLogging();
init();
// error_log("Hello Log!");

function render($template, $data = null) {
    if ( $data ) {
        extract($data);
    }
    $template .= '.php';
    include VIEWS."/layouts/app.php";  
}


require_once VENDOR.'/framework/Router.php';