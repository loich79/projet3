<?php

namespace App\Controller;

/**
 * Description of Router
 * gerer l'appel des controlleurs et de leurs fonctions selon la page demandée
 * @author loich
 */
class Router {
    /**
     * gerer l'appel des controlleurs et de leurs fonctions selon la page demandée
     * @param type $page string
     */
    public static function route($page)
    {
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
        } elseif ($page === 'posts.flag') {
            $controller = new \App\Controller\CommentsController();
            $controller->flag();
        } elseif ($page === 'admin.comments.index') {
            $controller = new \App\Controller\Admin\CommentsController();
            $controller->index();
        } elseif ($page === 'admin.comments.delete') {
            $controller = new \App\Controller\Admin\CommentsController();
            $controller->delete();
        }  elseif ($page === 'admin.comments.unflag') {
            $controller = new \App\Controller\Admin\CommentsController();
            $controller->unflag();
        }
    }
}
