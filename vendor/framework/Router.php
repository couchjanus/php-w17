<?php

function getURI()
{
    if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI'])) {
        return trim($_SERVER['REQUEST_URI'], '/');
    }
}

$result = null;

// Подключаем файл routes
$filename = CONFIG.'/routes'.EXT;
if (file_exists($filename)) {
    $routes = include_once $filename;
} else {
    echo "Файл $filename не существует";
}

// Проверить наличие запроса в routes

foreach ($routes as $route => $path) {
    //Сравниваем route и $uri
    if ($route == getURI()) {
        $controller = $path;
        //Подключаем файл контроллера
        $controllerFile = CONTROLLERS . "/" . $controller . EXT;
        if (file_exists($controllerFile)) {
            include_once $controllerFile;
            $result = true;
            break;
        } 
    }
}

// ===================method_exists==============================
// foreach ($routes as $route => $path) {
//     if ($route == getURI()) {
//         $controller = $path;
//         $action = 'index';

//         //Подключаем файл контроллера
//         $controllerFile = CONTROLLERS . "/" . $controller . EXT;
        
//         if (file_exists($controllerFile)) {
//             include_once $controllerFile;
//             $controller = new $controller;

//             if (method_exists($controller, $action)) {
//                 $controller->$action();
//             }
//             $result = true;
//             break;
//         }
//     } 
// }

// if ($result === null) {
//     include_once CONTROLLERS.'/ErrorController.php';
// }

// ===================action==============================

// foreach ($routes as $route => $path) {
//     if ($route == getURI()) {
//         list($controller, $action) = explode('@', $path);
//         //Подключаем файл контроллера
//         $controllerFile = CONTROLLERS . "/" . $controller . EXT;
        
//         if (file_exists($controllerFile)) {
//             include_once $controllerFile;
//             $controller = new $controller;
//             if (method_exists($controller, $action)) {
//                 $controller->$action();
//             }
//             $result = true;
//             break;
//         }
//     }  
// }

if ($result === null) {
    include_once CONTROLLERS.'/ErrorController.php';
}
