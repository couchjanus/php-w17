<?php
/**
 * RoleController.php
 * Контроллер для управления roles
 */
require_once VENDOR.'/framework/Controller.php';
require_once VENDOR.'/framework/Helper.php';
require_once MODELS.'/Role.php';

class RoleController extends Controller
{
    /**
     * Главная страница управления roles
     *
     * @return bool
     */
    public function index()
    {
        $roles = Role::all();
        $title = 'Roles List Page ';
        $this->render('admin/roles/index', compact('title', 'roles'), 'admin');
    }

    /**
     * Добавление role
     *
     * @return bool
     */
    public function create()
    {
        if (isset($_POST) and !empty($_POST)) {
            $role = new Role();
            $role->name = $this->sanitizeInput($_POST['name']);
            $role->store();
            Helper::redirect('/admin/roles');
        }
        $this->render('admin/roles/create', ['title'=> 'Add New Role '], 'admin');
    }

    public function edit($vars)
    {
        extract($vars);
        $role = Role::getByPrimaryKey($id);
        if (isset($_POST) and !empty($_POST)) {
            $role->name = $this->sanitizeInput($_POST['name']);
            $role->store();
            Helper::redirect('/admin/roles');
        }
        $title = 'Edit Role Page';
        $this->render('admin/roles/edit', compact('title', 'role'), 'admin');
    }
    
    public function delete($vars)
    {
        extract($vars);
        $role = Role::getByPrimaryKey($id);
        if (isset($_POST['submit'])) {
            $role->destroy();
            Helper::redirect('/admin/roles');
        } elseif (isset($_POST['reset'])) {
            Helper::redirect('/admin/roles');            
        }
        $title = 'Delete Role';
        $this->render('admin/roles/delete', compact('title', 'role'), 'admin');
    }
}