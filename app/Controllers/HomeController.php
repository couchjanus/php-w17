<?php

// HomeController.php

require_once VENDOR.'/framework/Controller.php';
require_once MODELS.'/Product.php';

class HomeController extends Controller
{
   public function index()
   {
       $title = 'Our Best Cats Members Home Page';
       $this->render('home/index', compact('title'));
   }

    public function getProducts()
    {
        $products = Product::getProducts();
        echo json_encode($products);
    }
}