<?php
/**
  * PHP version 7.4
  * 
  * @category Php
  * @package  Php_Project
  * @author   Janus Nic <couchjanus@gmail.com>
  * @license  MIT License https://github.com/couchjanus/php-w17/LICENSE
  * @link     https://github.com/couchjanus/php-w17
  **/

// Это единая точка входа для нашего приложения.
// На этот файл будут переадресованы все запросы нашего сайта.

// var_dump($GLOBALS);
// var_dump($GLOBALS['_COOKIE']);

// var_dump(__DIR__); // string(30) "/home/janus/www/php-w17/public" 

// define('ROOT', dirname(__DIR__));
// var_dump(ROOT);

// Подключаем файл, где храниться автозагрузчик

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'bootstrap/app.php';
