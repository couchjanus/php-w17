<?php
// DashboardController.php
require_once VENDOR.'/framework/Controller.php';

class DashboardController extends Controller
{
   public function index()
   {
        $title = 'Dashboard';
        $this->render('admin/index', ['title'=>$title], 'admin');
   }
}
