<?php
// CategoryController.php
require_once VENDOR.'/framework/Controller.php';
require_once VENDOR.'/framework/Helper.php';
require_once MODELS.'/Brand.php';

class BrandController extends Controller
{
    /**
     * Главная страница управления категориями
     *
     * @return bool
     */
    public function index()
    {
        $brands = Brand::all();
        $title = 'Brand List Page';
        $this->render('admin/brands/index', compact('title', 'brands'), 'admin');
    }

    /**
     * Добавление категории
     *
     * @return bool
     */
    public function create()
    {
        if (isset($_POST) and !empty($_POST)) {
            $brand = new Brand();
            $brand->name = $this->sanitizeInput($_POST['name']);
            $brand->description = $this->sanitizeInput($_POST['description']);
            $brand->status = (int)isset($_POST['status']);
            $brand->store();
            
            Helper::redirect('/admin/brands');
        }

        $title = 'Add New Brand ';
        $this->render('admin/brands/create', compact('title'), 'admin');
    }

}
