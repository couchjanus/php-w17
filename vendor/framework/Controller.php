<?php
require_once VENDOR.'/framework/View.php';
require_once VENDOR.'/framework/Response.php';

class Controller
{
    /**
     * view
     *
     * @var View
     */
    protected $view;

    /**
     * response
     *
     * @var Response
     */
    public $response;

   /**
     * Constructor
     *
     * @param Response $response
    */
    public function __construct(Response $response = null){
        $this->response     =  $response ?? new Response();
        $this->view         =  new View($this);
    }
    
    protected function render($template, $data = null, $layout='app', $error = false)
    {
        echo $this->view->render($template, $data, $layout, $error);
    }

    protected function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
