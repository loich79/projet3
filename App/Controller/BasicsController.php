<?php
namespace App\Controller;
use \App;

/**
 * Description of PostController
 * controleur des pages basique du site (about, contact et mentions légales
 * @author loich
 */
class BasicsController extends Controller{
    /**
     * controleur pour la page a propos
     */
    public function about()
    {
        // modifie le titre de la page, ainsi que le titre et le sous titre de la bannière
        App::getInstance()->setTitle("A propos");
        App::getInstance()->setPageTitle("Jean Forteroche");
        App::getInstance()->setPageSubtitle('A propos');
        // génère l'affichage de la page a propos
        $this-> render('Basics.about');
    }
    /**
     * controleur pour la page contact
     */
    public function contact()
    {
        // modifie le titre de la page, ainsi que le titre et le sous titre de la bannière
        App::getInstance()->setTitle("Contact");
        App::getInstance()->setPageTitle("Jean Forteroche");
        App::getInstance()->setPageSubtitle('Contact');
        // génère l'affichage de la page a propos
        $this-> render('Basics.contact');
    }
    /**
     * controleur pour la page mentions légales
     */
    public function legal()
    {
        // modifie le titre de la page, ainsi que le titre et le sous titre de la bannière
        App::getInstance()->setTitle("Mentions legales");
        App::getInstance()->setPageTitle("Jean Forteroche");
        App::getInstance()->setPageSubtitle('Mentions legales');
        // génère l'affichage de la page a propos
        $this-> render('Basics.legal');
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
        // récupère la liste des articles pour la catégorie demandée et la stocke dans un tableau pour être transmis à l'afficheur
        $posts = $this->Posts->lastByCategory($_GET['id']);
         // récupère la liste des catégories et la stocke dans un tableau pour être transmis à l'afficheur
        $categoriesList = $this->Categories->all();
        // génère l'affichage de la page de la liste des articles selon la catégorie
        $this-> render('Posts.category', compact("posts","categoriesList", "category"));
    }
}
