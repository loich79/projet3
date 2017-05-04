<?php
namespace App\Controller;
use \App;
/**
 * Description of Controller
 *
 * @author loich
 */
class Controller {
    protected $viewPath;
    protected $template = "default"; 


    public function __construct()
    {
        $this->viewPath = ROOT . '/app/views/';
    }
    protected function render($view, $variables = [])
    {
        ob_start();
        extract($variables);
        require $this->viewPath . str_replace('.', '/', $view) . '.php';
        $content = ob_get_clean();
        require $this->viewPath . 'Templates/' . $this->template . '.php';
    }
    protected function loadModel($modelName)
    {
        $this->$modelName = App::getInstance()->getTable($modelName);
    }
    protected function now() 
    {
        date_default_timezone_set('Europe/Paris');      
        $datetime = new \DateTime('');  
        $date = date("Y-m-d H:i:s");
        return $date;
    }
    /**
     * redirige vers la page 404.php
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
