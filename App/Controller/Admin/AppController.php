<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\Admin;

use \App;
use App\Model\Auth\DBAuth;

/**
 * Description of ControllerApp
 *
 * @author loich
 */
class AppController extends \App\Controller\Controller{

    protected $template = "default"; 
     
    public function __construct()
    {
        parent::__construct();
        $app = App::getInstance();
        $auth = new DBAuth($app->getDb());
        if(!$auth->logged()) {
            header('location:index.php?page=users.login');
        }
    }
    protected function loadModel($modelName)
    {
        $this->$modelName = App::getInstance()->getTable($modelName);
    }
     
}
