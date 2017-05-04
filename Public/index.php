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

if ($page === 'home'){
    $controller = new \App\Controller\PostsController();
    $controller->index();
} elseif ($page === 'posts.show') {
    $controller = new \App\Controller\PostsController();
    $controller->show();
} elseif ($page === 'posts.category') {
    $controller = new \App\Controller\PostsController();
    $controller->category();
} elseif ($page === 'users.login') {
    $controller = new \App\Controller\UsersController();
    $controller->login();
} elseif ($page === 'users.logout') {
    $controller = new \App\Controller\UsersController();
    $controller->logout();
} elseif ($page === 'admin.posts.index') {
    $controller = new \App\Controller\Admin\PostsController();
    $controller->index();
} elseif ($page === 'admin.posts.edit') {
    $controller = new \App\Controller\Admin\PostsController();
    $controller->edit();
} elseif ($page === 'admin.posts.add') {
    $controller = new \App\Controller\Admin\PostsController();
    $controller->add();
} elseif ($page === 'admin.posts.delete') {
    $controller = new \App\Controller\Admin\PostsController();
    $controller->delete();
} elseif ($page === 'admin.categories.index') {
    $controller = new \App\Controller\Admin\CategoriesController();
    $controller->index();
} elseif ($page === 'admin.categories.edit') {
    $controller = new \App\Controller\Admin\CategoriesController();
    $controller->edit();
} elseif ($page === 'admin.categories.add') {
    $controller = new \App\Controller\Admin\CategoriesController();
    $controller->add();
} elseif ($page === 'admin.categories.delete') {
    $controller = new \App\Controller\Admin\CategoriesController();
    $controller->delete();
}