<?php
// DashboardController.php
require_once VENDOR.'/framework/Controller.php';
class DashboardController
{
   public function index()
   {
        $title = 'Dashboard';
        render('admin/index', ['title'=>$title], 'admin');
   }
}
