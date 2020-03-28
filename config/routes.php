<?php

return [
   'contact' => 'ContactController@index',
   'about' => 'AboutController@index',
   'blog' => 'BlogController@index',
   'admin' => 'Admin\DashboardController@index',
   'admin/categories' => 'Admin\CategoryController@index',
   'admin/categories/create' => 'Admin\CategoryController@create',

   'admin/categories/show/{id}' => 'Admin\CategoryController@show',
   'admin/categories/edit/{id}' => 'Admin\CategoryController@edit',
   'admin/categories/delete/{id}' => 'Admin\CategoryController@delete',


   'admin/brands' => 'Admin\BrandController@index',
   'admin/brands/create' => 'Admin\BrandController@create',
   'admin/products' => 'Admin\ProductController@index',
   'admin/products/create' => 'Admin\ProductController@create',


   'api/shop' => 'HomeController@getProducts',
   'api/shop/{id}' => 'HomeController@getProduct',
   'api/product/{id}' => 'HomeController@getProductItem',
   'api/categories' => 'HomeController@getCategories',
   'api/category/{id}' => 'HomeController@getProductsByCategory',
   
   'index.php' => 'HomeController@index',
   '' => 'HomeController@index',
]; 