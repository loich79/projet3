<?php
namespace App\Controller;
use \App;

/**
 * Description of PostController
 * controleur des articles
 * @author loich
 */
class PostsController extends Controller{
    /**
     * contructeur pour le controleur des articles
     */
    public function __construct() {
        // appelle le contructeur du parent Controller
        parent::__construct();
        // génère le modele pour l'interface avec la table posts
        $this->loadModel('Posts');
        // génère le modele pour l'interface avec la table categories
        $this->loadModel('Categories');
    }
    /**
     * controleur pour la page d'accueil du site
     */
    public function index()
    {
        // pagination
        // récupère et stocke le nb total d'article
        $countPosts = $this->Posts->countPosts();
        // détermine le nombre de page
        $nbPages = ceil($countPosts/NB_POSTS_PER_PAGE);
        // teste le paramètre passé en get (isset et compris entre 0 et nombre de page)
        if (isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<=NB_POSTS_PER_PAGE) {
            // définit le numéro de la page actuelle
            $currentPage = $_GET['p'];
        } else {
            // définit le numéro de la page actuelle à 1 
            $currentPage = 1;
        }
        // définit la position du premier élément = (numéro page demandé-1)*NB_POSTS_PER_PAGE
        $firstPost = ($currentPage-1)*NB_POSTS_PER_PAGE;
        // récupère les articles de la liste limitée et les stocke dans un tableau pour être transmis à l'afficheur       
        $posts = $this->Posts->limitedList($firstPost); 
        // récupère la liste des catégories et la stocke dans un tableau pour être transmis à l'afficheur
        $categoriesList = $this->Categories->all();
        // génère l'affichage de la page d'accueil
        $this-> render('Posts.index', compact("posts","categoriesList", "nbPages", "currentPage"));
    }
    /**
     * controleur pour la page d'un article
     */
    public function show()
    {
        //crée le controlleur des commentaires
        $controlComment = new \App\Controller\CommentsController();
        // récupère l'article demandé et le stocke dans un tableau pour être transmis à l'afficheur
        $post = $this->Posts->find($_GET['id']);
        // test si l'article n'existe pas
        if($post === false) {
            // redirige vers la page 404
            $this->notFound();
        }
        // modifie le titre de la page, ainsi que le titre et le sous titre de la bannière
        App::getInstance()->setTitle($post->title);
        App::getInstance()->setPageTitle($post->title);
        App::getInstance()->setPageSubtitle('Catégorie : ' . $post->categorie . ' - Publié le ' . $post->date);
        // récupère la liste des catégories et la stocke dans un tableau pour être transmis à l'afficheur
        $categoriesList = $this->Categories->all();
        // génère l'affichage de la page pour un article
        $this-> render('Posts.show', compact("post","categoriesList","controlComment"));
    }
    /**
     * controlleur pour la page de la liste des articles selon la catégorie
     */
    public function category()
    {
        // génere le contenu des pages catégories
        $category = $this->Categories->find($_GET['id']);
        // test si l'article n'existe pas
        if($category === false) {
            // redirige vers la page 404
            $this->notFound();
        }
        // modifie le titre de la page, ainsi que le titre et le sous titre de la bannière
        App::getInstance()->setTitle($category->title);
        App::getInstance()->setPageTitle('Catégorie : '.$category->title);
        App::getInstance()->setPageSubtitle('');
        // pagination
        // récupère et stocke le nb total d'article
        $countPosts = $this->Posts->countPostsByCategory($_GET['id']);
        // détermine le nombre de page
        $nbPages = ceil($countPosts/NB_POSTS_PER_PAGE);
        // teste le paramètre passé en get (isset et compris entre 0 et nombre de page)
        if (isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<=NB_POSTS_PER_PAGE) {
            // définit le numéro de la page actuelle
            $currentPage = $_GET['p'];
        } else {
            // définit le numéro de la page actuelle à 1 
            $currentPage = 1;
        }
        // définit la position du premier élément = (numéro page demandé-1)*NB_POSTS_PER_PAGE
        $firstPost = ($currentPage-1)*NB_POSTS_PER_PAGE;
        // récupère les articles de la liste limitée et les stocke dans un tableau pour être transmis à l'afficheur       
        $posts = $this->Posts->limitedListByCategory($firstPost, $_GET['id']); 
         // récupère la liste des catégories et la stocke dans un tableau pour être transmis à l'afficheur
        $categoriesList = $this->Categories->all();
        // génère l'affichage de la page de la liste des articles selon la catégorie
        $this-> render('Posts.category', compact("posts","categoriesList", "category", "nbPages", "currentPage"));
    }
}
