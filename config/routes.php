<?php

return [
   'contact' => 'ContactController@index',
   'about' => 'AboutController@index',
   'blog' => 'BlogController@index',
   'admin' => 'Admin\DashboardController@index',
   'admin/categories' => 'Admin\CategoryController@index',
   'admin/categories/create' => 'Admin\CategoryController@create',
   'admin/brands' => 'Admin\BrandController@index',
   'admin/brands/create' => 'Admin\BrandController@create',
   'admin/products' => 'Admin\ProductController@index',
   'admin/products/create' => 'Admin\ProductController@create',
   'api/shop' => 'HomeController@getProducts',
   'index.php' => 'HomeController@index',
   '' => 'HomeController@index',
]; 