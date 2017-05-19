<?php
//gere le déclenchement des pages
// définit un mot clé ROOT pour l'adresse absolu des pages
define('ROOT', dirname(__DIR__));
// définit un mot clé MAX_COMMENT_LEVEL pour le niveau maximum de réponses autorisé
define('MAX_COMMENT_LEVEL', 3);
// définit un mot clé NB_POSTS_PER_PAGE pour le nombre d'article par page
define('NB_POSTS_PER_PAGE', 5);
require ROOT.'/App/App.php';
App::load();
// definition de la page à appeler
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'home';
}
//appelle du gestionnaire d'affichage des différentes pages
\App\Controller\Router::route($page);
