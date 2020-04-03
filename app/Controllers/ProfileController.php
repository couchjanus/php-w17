<?php

require_once MODELS.'/User.php';
require_once VENDOR.'/framework/Session.php';
require_once VENDOR.'/framework/Controller.php';
require_once VENDOR.'/framework/Helper.php';

/**
 * ProfileController.php
 * Контроллер для authetication users
 */
class ProfileController extends Controller
{
    private $user;
    
    public function __construct()
    {
        parent::__construct();
        Session::init();
        $userId = Session::get('userId');
        if ($userId) {
            $this->user = User::getByPrimaryKey($userId);
        } else {
            $this->user = null;
        }
    }
     
    /**
     * страница index
     *
     * @return bool
     */
    public function index()
    {
        if (!$this->user) {
            Helper::redirect('/login');
        }

        $user = $this->user;
        if ($this->user->role_id == 1) {
            $title = 'Admin Profile';
            $this->render('admin/index', compact('user',  'title'), 'admin');
        } else {
            $title = 'My Profile';
            $instance = User::getByPrimaryKey($this->user->id);
            if (isset($_POST) and !empty($_POST)) {
                $instance->name = $this->sanitizeInput($_POST['name']);
                $instance->phone_number = $this->sanitizeInput($_POST['phone_number']);
                $instance->first_name = $this->sanitizeInput($_POST['first_name']);
                $instance->last_name = $this->sanitizeInput($_POST['last_name']);
                $instance->store();
                Helper::redirect('/profile');
            }
            $this->render('profile/index', compact('title', 'user'));
        }
    }

        /**
     * Просмотр истории заказов пользователя
     *
     * @return bool
    */

    public function ordersList()
    {
        
    }

    public function ordersView($vars)
    {
        
    }

}