<?php
require_once VENDOR.'/framework/View.php';
require_once VENDOR.'/framework/Response.php';

// class Controller
// {
//    protected $view;

//    function __construct()
//    {
//        $this->view = new View();
//    }
// }


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
}
