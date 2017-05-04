<?php

namespace App\Controller;
use App\HTML\BootstrapForm;
use \App;
use App\Model\Auth\DBAuth;
/**
 * Description of ControllerUser
 *
 * @author loich
 */
class UsersController extends Controller {
    
    public function login()
    {
        $errors = false;
        if (!empty($_POST)) {
            $auth = new DBAuth(App::getInstance()->getdb());
            if($auth->login($_POST['username'], $_POST['password'])) {
                header('location:index.php?page=admin.posts.index');
            } else {
               $errors = true;
            }  
        }
        $form = new BootstrapForm($_POST);
        $this->render('users.login', compact('form','errors'));
    }
    public function logout()
    {
        // supprime la session
        session_destroy();
        // redirige a la page d'accueil
        header('location:index.php');
    }
}
