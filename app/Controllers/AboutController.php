<?php
// AboutController.php
require_once VENDOR.'/framework/Controller.php';
class AboutController extends Controller
{
   public function index()
   {
       $title = 'About Our Cats Members';
       $this->view->render('about/index', compact('title'));
   }
}
