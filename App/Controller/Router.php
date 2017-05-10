<?php

namespace App\Controller;

/**
 * Description of Router
 *
 * @author loich
 */
class Router {
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
        }
    }
}
