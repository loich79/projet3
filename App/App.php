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
     * stocke le titre de la page pour le bandeau
     * @var type string
     */
    private $pageTitle = "Jean Forteroche";
    /**
     * stocke le sous-titre de la page pour le bandeau
     * @var type string
     */
    private $pageSubtitle = "Acteur et écrivain";
    /**
     * stocke la connexion a la bdd
     * @var type PDO
     */
    private $db;
    /**
     * stocke le nombre de commentaires signalés
     * @var type string
     */
    private $nbCommentsFlagged;
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
     * getter pour le titre du bandeau
     * @return type string
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }
    /**
     * getter pour le sous-titre du bandeau
     * @return type string
     */
    public function getPageSubtitle()
    {
        return $this->pageSubtitle;
    }
    /**
     * getter pour le nombre de commentaires signalés
     * @return type string
     */
    public function getNbCommentsFlagged()
    {
        return $this->nbCommentsFlagged;
    }
    /**
     * setter pour le titre
     * @param type $title string
     */
    public function setTitle($title)
    {
        $this->title = $title . ' | ' . $this->title;
    }
    /**
     * setter pour le titre du bandeau
     * @param type $pageTitle string
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;
    }
    /**
     * setter pour le soustitre du bandeau
     * @param type $pageSubtitle string
     */
    public function setPageSubtitle($pageSubtitle)
    {
        $this->pageSubtitle = $pageSubtitle;
    }
    /**
     * setter pour le nombre de commentaires signalés
     * @param type $title string
     */
    public function setNbCommentsFlagged($nbCommentsFlagged)
    {
        $this->nbCommentsFlagged = $nbCommentsFlagged;
    }
    /**
     * renvoie l'instance de l'objet PDO et le crée si nécessaire
     * @return type objet PDO
     */
    public function getDb()
    {
        if($this->db === null ){
            $config = Config::getInstance(ROOT.'/Config/config.php');
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
    }
   
   
}
