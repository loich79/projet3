<?php

use App\Config;
use App\Model\Database\MySqlDatabase;
/**
 * Description of App
 * singleton servant de factory pour la connexion a la bdd et pour les objets tables
 * sert également a la gestion du titre des pages
 * @author loich
 */
class App {
    /**
     * stocke l'instance de l'objet app
     * @var type objet app
     */
    private static $instance;
    /**
     * stocke le titre de la page
     * @var type string
     */
    private $title = "Jean Forteroche";
    /**
     * stocke la connexion a la bdd
     * @var type PDO
     */
    private $db;
    /**
     * renvoie l'instance de l'objet app (singleton)
     * @return type objet de type app
     */
    public static function getInstance()
    {
        if(is_null(self::$instance)) {
            self::$instance = new App();
        }
        return self::$instance;
    }
    
    /**
     * getter pour le titre
     * @return type string
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * setter pour le titre
     * @param type $titre string
     */
    public function setTitle($titre)
    {
        $this->title = $titre . ' | ' . $this->title;
    }
    /**
     * renvoie l'instance de l'objet PDO et le crée si nécessaire
     * @return type objet PDO
     */
    public function getDb()
    {
        if($this->db === null ){
            $config = Config::getInstance(ROOT.'/config/config.php');
            $this->db = new MySqlDatabase($config->get('dbName'), $config->get('dbUser'), $config->get('dbPwd'), $config->get('dbHost'));  
        }
        return $this->db;
    }
    /**
     * permet de créer un objet correspondant a la table demandée en parametre
     * @param type $name string : nom de la table dont on veut un objet
     * @return \app\className objet correspondant à la table demandée
     */
    public function getTable($name)
    {
        $className = '\\App\\Model\\Table\\'.ucfirst($name).'Table' ;
        return new $className($this->getDb());
    }
    /**
     * permet d'initialiser les autoloaders et la session
     */
    public static function load()
    {
        session_start();
        require ROOT.'/App/Autoloader.php';
        app\Autoloader::register();
        /*require ROOT.'/core/Autoloader.php';
        core\Autoloader::register();*/
    }
   
   
}
