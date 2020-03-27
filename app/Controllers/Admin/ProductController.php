<?php

require_once VENDOR.'/framework/Controller.php';
require_once VENDOR.'/framework/Helper.php';
require_once MODELS.'/Category.php';
require_once MODELS.'/Product.php';
require_once MODELS.'/Brand.php';
require_once MODELS.'/Picture.php';

class ProductController extends Controller
{
    /**
     * Просмотр всех товаров
     * @return bool
    */
    public function index()
    {
        $products = Product::all();
        $title = 'Products List Page';
        $this->render('admin/products/index', compact('title', 'products'), 'admin');
    }

    private function check_file_array($file) {
        return isset($file['error'])
            && !empty($file['name'])
            && !empty($file['type'])
            && !empty($file['tmp_name'])
            && !empty($file['size']);
    }

    /**
     * Добавление товара
     *
     * @return bool
    */
    public function create()
    {
        if (isset($_POST) and !empty($_POST)) {
            $product = new Product();
            $product->name = $this->sanitizeInput($_POST['name']);
            $product->status = (int)isset($_POST['status']);
            $product->price = $this->sanitizeInput($_POST['price']);
            
            $product->brand_id = $_POST['brand_id'];
            $product->category_id = $_POST['category_id'];

            $product->description = $this->sanitizeInput($_POST['description']);
            $product->is_new = (int)isset($_POST['is_new']);

            $product->store();
            // Если массив файлов не пустой
            if (!empty($_FILES['images'])) {
                $files = $_FILES['images'];
                // Директория назначения должна существовать
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR.'assets/images/products';
                // Цикл по всем загруженным файлам
                for ($i = 0; $i < count($files["name"]); $i++) {
                    $file["name"] = $files["name"][$i];
                    $file["tmp_name"] = $files["tmp_name"][$i];
                    $file["size"] = $files["size"][$i];
                    $file["type"] = $files["type"][$i];
                    $file["error"] = $files["error"][$i];
                    // Если нет ошибок

                    if($this->check_file_array($file)) {
                        // Проверяем загружен ли файл
                        if(is_uploaded_file($file["tmp_name"])) {
           
                            // Если файл загружен успешно
                            // Генерируем уникальное имя файла

                            // mt_rand — Генерирует случайное значение методом с помощью генератора простых чисел на базе Вихря Мерсенна
                            // uniqid() - Генерирует уникальный идентификатор с префиксом, основанный на текущем времени в микросекундах.
                            // sha1 — Возвращает SHA1-хеш строки, вычисленный по алгоритму US Secure Hash Algorithm 1.

                            $filename = sha1(mt_rand(1, 9999) . $file['name'] . uniqid()) . time();
                            
                            $uploaded = $uploadDir .'/'. $filename;

                            // перемещаем файл из временной директории в конечную
                            move_uploaded_file($file["tmp_name"], $uploaded);
                            // Регистрируем файл в таблице изображений
                            $picture = new Picture();
                            $picture->filename = $filename;
                            $picture->resource_id = (int)Product::lastId();
                            $picture->resource = Product::getResource();
                            $picture->store();
                            
                        } else {
                            throw new Exception('Upload: Can\'t upload file.');
                        }
                    }
                    else {
                        throw new Exception('Upload: Can\'t upload file.');
                    }
 
                }    
            }

            Helper::redirect('/admin/products');
        }
        $title = 'Add New Product ';
        $categories = Category::all();
        $brands = Brand::all();
        $this->render('admin/products/create', compact('title', 'categories', 'brands'), 'admin');
    }
}