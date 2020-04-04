<?php
/**
 * UserController.php
 * Контроллер для управления users
 */
require_once VENDOR.'/framework/Admin.php';
require_once VENDOR.'/framework/Helper.php';
require_once MODELS.'/User.php';
require_once MODELS.'/Role.php';

class UserController extends Admin
{
    private $costs = [
        'cost' => 12,
    ];

    public function __construct()
    {
        parent::__construct();

        if ($this->isAdmin() !== true) {
            Helper::redirect('/profile');
        }
    }

    /**
     * Главная страница управления users
     *
     * @return bool
     */
    public function index()
    {
        $users = User::all();
        $title = 'User List Page';
        $this->render('admin/users/index', compact('users', 'title'), 'admin');
    }

    /**
     * Добавление user
     *
     * @return bool
     */

    public function create()
    {
        if (isset($_POST) and !empty($_POST)) {
            $user = new User();
            $user->name = $this->sanitizeInput($_POST['name']);
            $user->email = $this->sanitizeInput($_POST['email']);
            $user->role_id = $_POST['role_id'];
            $hash = password_hash($this->sanitizeInput($_POST['password']), PASSWORD_BCRYPT, $this->costs);
            $user->password = $hash;
            $user->store();
            Helper::redirect('/admin/users');
        }
        $title = 'Create User';
        $roles = Role::all();
        $this->render('admin/users/create', compact('title', 'roles'), 'admin');
    }

    public function edit($vars)
    {
        extract($vars);
        $user = User::getByPrimaryKey($id);
        if (isset($_POST) and !empty($_POST)) {
            $user->name = $this->sanitizeInput($_POST['name']);
            $user->email = $this->sanitizeInput($_POST['email']);
            $hash = password_hash($this->sanitizeInput($_POST['password']), PASSWORD_BCRYPT, $this->costs);
            $user->password = $hash;
            $user->role_id = (int)$_POST['role_id'];
            $user->status = (int)isset($_POST['status']);
            $user->store();
            Helper::redirect('/admin/users');
        }
        $title = 'Edit User Page ';
        $roles = Role::all();
        $this->render('admin/users/edit', compact('user', 'title', 'roles'), 'admin');
    }
    
    public function delete($vars)
    {
        extract($vars);
        $user = User::getByPrimaryKey($id);
        if (isset($_POST['submit'])) {
            $user->destroy();
            Helper::redirect('/admin/users');
        } elseif (isset($_POST['reset'])) {
            Helper::redirect('/admin/users');            
        }
        $title = 'Delete user';
        $this->render('admin/users/delete', compact('title', 'user'), 'admin');
    }
}