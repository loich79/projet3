<?php
//gere le déclenchement des pages
// défini un mot clé ROOT pour l'adresse absolu des pages
define('ROOT', dirname(__DIR__));
require ROOT.'/App/App.php';
App::load();
// definition de la page à appeler
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'home';
}
//gestionnaire d'affichage des différente pages
\App\Controller\Router::route($page);
