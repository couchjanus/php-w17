<?php
// CategoryController.php
require_once VENDOR.'/framework/Controller.php';
require_once VENDOR.'/framework/Helper.php';
require_once MODELS.'/Category.php';

class CategoryController extends Controller
{
    /**
     * Главная страница управления категориями
     *
     * @return bool
     */
    public function index()
    {
        $categories = (new Category())::all();
        $title = 'Category List Page ';
        $this->render('admin/categories/index', compact('title', 'categories'), 'admin');
    }

    /**
     * Добавление категории
     *
     * @return bool
     */
    public function create()
    {
        if (isset($_POST) and !empty($_POST)) {
            $category = new Category();
            $category->name = $this->sanitizeInput($_POST['name']);
            $category->status = (int)isset($_POST['status']);
            $category->store();
            
            Helper::redirect('/admin/categories');
        }

        $title = 'Admin Category Add New Category ';
        $this->render('admin/categories/create', compact('title'), 'admin');
    }
}
