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

// function render($template, $data = null) {
//     if ( $data ) {
//         extract($data);
//     }
//     $template .= '.php';
//     include VIEWS."/layouts/app.php";  
// }

function render($template, $data = null, $layout='app') 
{
	if ( !empty($data) ) {
		extract($data);
	}
	$template .= '.php';
	require VIEWS."/layouts/${layout}.php";
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


/**
 * Simple PHP Templating function
 *
 * @param $names  - string|array Template names
 * @param $args   - Associative array of variables to pass to the template file.
 * @return string - Output of the template file. Likely HTML.
 */

 function template( $names, $args ){
    // allow for single file names
    if ( !is_array( $names ) ) { 
      $names = array( $names ); 
    }
    
    // try to find the templates
    $template_found = false;
    foreach ( $names as $name ) {
      $file = __DIR__ . '/templates/' . $name . '.php';
    //   include(VIEWS."/".$template);
      if ( file_exists( $file ) ) {
        $template_found = $file;
        // stop after the first template is found
        break;
      }
    }
    // fail if no template file is found
    if ( ! $template_found ) {
      return '';
    }
    // Make values in the associative array easier to access by extracting them
    if ( is_array( $args ) ){
      extract( $args );
    }
    // buffer the output (including the file is "output")
    ob_start();
      include $template_found;
    return ob_get_clean();
}

setErrorLogging();
init();

require_once VENDOR.'/framework/Router.php';