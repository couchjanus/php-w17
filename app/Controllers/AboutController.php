<?php
// AboutController.php
// require_once VENDOR.'/framework/Controller.php';

namespace App\Controllers;

use Core\Controller;

class AboutController extends Controller
{
   public function index()
   {
       $title = 'About Our Cats Members';
       $this->render('about/index', compact('title'));
   }
}
