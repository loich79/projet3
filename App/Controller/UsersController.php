<?php

namespace App\Controller;
use App\HTML\BootstrapForm;
use \App;
use App\Model\Auth\DBAuth;
/**
 * Description of ControllerUser
 * Controlleur pour l'acces a l'administration
 * @author loich
 */
class UsersController extends Controller {
    /**
     * controlleur pour la page de connexion a l'administration
     */
    public function login()
    {
        //initialise la variable indiquant a l'afficheur si il y a une erreur
        $errors = false;
        //teste si la supervariable POST n'est pas vide
        if (!empty($_POST)) {
            // crée l'instance modele lié a la table users
            $auth = new DBAuth(App::getInstance()->getdb());
            // teste si l'identifiant et le mot de passe sont correcte
            if($auth->login($_POST['username'], $_POST['password'])) {
                // redirige vers la page d'accueil de l'administration
                header('location:index.php?page=admin.posts.index');
            } else {
                // modifie la variable error pour indiquer une erreur
                $errors = true;
            }  
        }
        // initialise un formulaire permettant de se connecter
        $form = new BootstrapForm($_POST);
        // génere l'affichage de la page de connexion
        $this->render('Users.login', compact('form','errors'));
    }
    /**
     * controlleur pour la deconnexion de l'administration
     */
    public function logout()
    {
        // supprime la session
        session_destroy();
        // redirige a la page d'accueil
        header('location:index.php');
    }
}
