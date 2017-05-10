<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

/**
 * Description of CommentsController
 *
 * @author loich
 */
class CommentsController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->loadModel('Comments');
    }
    protected function render($view, $variables = [])
    {
        extract($variables);
        require $this->viewPath . str_replace('.', '/', $view) . '.php';
    }
    public function show() {
        
    }
}