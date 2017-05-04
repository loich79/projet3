<?php
namespace App\Controller;
use \App;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PostController
 *
 * @author loich
 */
class PostsController extends Controller{
    public function __construct() {
        parent::__construct();
        $this->loadModel('Posts');
        $this->loadModel('Categories');
    }

    public function index()
    {
        $posts = $this->Posts->last();
        $categoriesList = $this->Categories->all();
        $this-> render('posts.index', compact("posts","categoriesList"));
    }
    public function show()
    {
        // génere le contenu des pages articles
        $post = $this->Posts->find($_GET['id']);
        // test si l'article existe
        if($post === false) {
            $this->notFound();
        }
        // défini le titre de la page
        App::getInstance()->setTitle($post->title);
        $categoriesList = $this->Categories->all();
        $this-> render('posts.show', compact("post","categoriesList"));
    }
    public function category()
    {
        // génere le contenu des pages catégories
        $category = $this->Categories->find($_GET['id']);
        // test si l'article existe
        if($category === false) {
            $this->notFound();
        }
        // défini le titre de la page
        App::getInstance()->setTitle($category->title);
        $posts = $this->Posts->lastByCategory($_GET['id']);
        $categoriesList = $this->Categories->all();
        $this-> render('posts.category', compact("posts","categoriesList", "category"));
    }
}
