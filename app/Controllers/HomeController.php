<?php

// HomeController.php

// class HomeController {
//     public function index()
//     {
//         $title = 'Our Best Cats Members Home Page';
//         $this->render('home/index', compact('title'));
//     }

//     public function render($template, $data = null, $layout='app') 
//     {
//         if ( !empty($data) ) {  extract($data); }
//         $template .= '.php';
//         return require VIEWS."/layouts/${layout}.php";
//     }
// }

// require_once VENDOR.'/framework/View.php';

// class HomeController extends View
// {
//     public function index()
//     {
//         $title = 'Our Best Cats Members Home Page';
//         $this->render('home/index', compact('title'));
//     }
// }

require_once VENDOR.'/framework/Controller.php';

class HomeController extends Controller
{
   public function index()
   {
       $title = 'Our Best Cats Members Home Page';
       $this->view->render('home/index', compact('title'));
   }
}