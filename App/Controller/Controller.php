<?php
namespace App\Controller;
use \App;
/**
 * Description of Controller
 * Controlleur générique contenant les éléments commun à tous les controlleurs
 * @author loich
 */
class Controller {
    /**
     * contient le chemin absolu des afficheurs
     * @var type string
     */
    protected $viewPath;
    /**
     * contient le nom du template générique du site
     * @var type string
     */
    protected $template = "default"; 

    /**
     * constructeur initialisant la propriétés viewPath
     */
    public function __construct()
    {
        $this->viewPath = ROOT . '/App/Views/';
    }
    /**
     * gérer l'appel de l'afficheur correspondant a la page demandée via $view
     * @param type $view string
     * @param type $variables array (facultatif)
     */
    protected function render($view, $variables = [])
    {
        // démarre la temporisation de sortie
        ob_start();
        // sort les variables du tableau passé en parametre
        extract($variables);
        // appelle la page de l'afficheur en fonction de la variables view
        require $this->viewPath . str_replace('.', '/', $view) . '.php';
        // lit le contenu courant du tampon de sortie
        $content = ob_get_clean();
        // appelle la page template
        require $this->viewPath . 'Templates/' . $this->template . '.php';
    }
    /**
     * crée une propriété contenant le modele correspondant a la table 
     * demandé dans le parametre $modelName
     * @param type $modelName
     */
    protected function loadModel($modelName)
    {
        $this->$modelName = App::getInstance()->getTable($modelName);
    }
    /**
     * crée la date et heure actuelle pour le fuseau horaire de Paris
     * au format equivalent à DATETIME en langage SQL
     * @return type
     */
    protected function now() 
    {
        date_default_timezone_set('Europe/Paris');      
        $datetime = new \DateTime('');  
        $date = date("Y-m-d H:i:s");
        return $date;
    }
    /**
     * affiche le message pour l'erreur 404
     */
    protected function notFound() 
    {
        header('HTTP/1.0 404 Not Found');
        header('Page non trouvée');
    }
    /**
     * affiche le message pour l'erreur 403
     */
    protected function forbidden()
    {
        header('HTTP/1.0 403 Forbidden');
        die('Accès interdit');
    }
}
