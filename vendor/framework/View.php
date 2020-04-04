<?php
namespace Core;

use Core\Controller;
/**
 * The view class.
 *
 * Responsible for rendering files as HTML with some helper methods
 *
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author     Janus Nic <couchjanus@gmail.com>
 */

// require_once VENDOR.'/framework/Controller.php';

class View {
    /**
     * controller object that instantiated view object
     *
     * @var object
     */
    public $controller;

    /**
     * Constructor
     *
     * @param Controller $controller
     */
    public function __construct(Controller $controller){
        $this->controller = $controller;
    }

    private function render_template($data, $layout, $template ){
		ob_start();
        
        if(!empty($data)) {
            extract($data);
        }
        
        include_once VIEWS."/layouts/${layout}.php";
		return ob_get_clean();
	}

    /**
     * Renders and returns output for the given file with its array of data.
     *
     * @param  string  $template
     * @param  string  $layout
     * @param  array   $data
     * @return string  Rendered output
     *
     */
        
    public function render($template, $data = null, $layout='app', $error = false)
    {
        $template .= '.php';
        
        if ( file_exists(VIEWS."/".$template) ) {
            $rendered = $this->render_template($data, $layout, $template);
        } else {
            throw new Exception('You need to set the app template.');
        }

        $this->controller->response->setContent($rendered);
        return $rendered;
    }
} 
