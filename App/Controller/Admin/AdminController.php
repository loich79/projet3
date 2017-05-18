<?php
namespace App\Controller\Admin;

use \App;
use App\Model\Auth\DBAuth;

/**
 * Description of AdminController
 * Controleur générique pour l'administration
 * @author loich
 */
class AdminController extends \App\Controller\Controller{
    /**
     * initialise la valeur template avec le nom de la page servant de template pour l'administration
     * @var type  string
     */
    protected $template = "default_admin"; 
    /**
     * contructeur pour le controleur générique pour l'administration
     */
    public function __construct()
    {
        // appelle le constructeur du parent Controller
        parent::__construct();
        // récupere l'instance de la classe app
        $app = App::getInstance();
        // crée une instance de DBauth (modele pour l'acces a la table users
        $auth = new DBAuth($app->getDb());
        // teste si l'utilisateur n'est pas connecté
        if(!$auth->logged()) {
            // si c'est le cas, on affiche la page de connexion 'login'
            header('location:index.php?page=users.login');
        }
    }
    /**
     * génère le modele faisant l'interface avec la table $modelName
     * @param type $modelName
     */
    protected function loadModel($modelName)
    {
        $this->$modelName = App::getInstance()->getTable($modelName);
    }
     
}
