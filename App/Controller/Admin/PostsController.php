<?php
namespace App\Controller\Admin;
use App\HTML\BootstrapForm;
use \App;


/**
 * Description of ControllerArticle
 * controlleur de l'administration des articles
 * @author loich
 */
class PostsController extends AdminController{
    
   public function __construct() {
       // appelle le constructeur de la classe parent AdminController
       parent::__construct();
       // génere le modèle faisant l'interface avec la table articles
       $this->loadModel('Posts');
       // génere le modèle faisant l'interface avec la table categories
       $this->loadModel('Categories');
       // génere le modèle faisant l'interface avec la table comments
       $this->loadModel("Comments");
   }
   /**
    * controleur pour la page index de l'administration des articles
    */
   public function index()
   { 
        // modifie le titre de la page, ainsi que le titre et le sous titre de la bannière
        App::getInstance()->setTitle('Articles | Admin');
        App::getInstance()->setPageTitle('Adminstration');
        App::getInstance()->setPageSubtitle('Articles');
        // modifie le variable stockant le nombre de commentaires signalés
        App::getInstance()->setNbCommentsFlagged($this->Comments->countFlagged());
        // récupère tous les articles et les stocke dans un tableau pour être transmis à l'afficheur
        $posts = $this->Posts->all();
        // génere l'affichage de la page d'accueil de l'administration des articles
        $this->render('Admin.Posts.index', compact('posts'));
   }
   /**
    * controleur pour la page edit de l'administration des articles
    */
   public function edit() 
   {
        //initialise res dans le cas d'un formulaire vide
        $res = null;
        // teste si le titre envoyé dans le formulaire n'est pas vide
        if(!empty($_POST)) {
            // teste si les champs du formulaire ne sont pas vide
            if($_POST['title'] !='' && $_POST['content'] !='' && $_POST['category_id'] !='') {
                // met a jour l'article
                $res = $this->Posts->update($_GET['id'],
                        array(
                            'title' => $_POST['title'],
                            'content' => $_POST['content'],
                            'category_id' => $_POST['category_id']
                        ));
            } else {
                // modifie la valeur de res pour indiquer une erreur 
                $res = false;
            }
        }
        // récupère l'article demandé et le stocke dans un tableau pour être transmis à l'afficheur
        $post = $this->Posts->find($_GET['id']);
        // récupère la liste des catégories et la stocke dans un tableau pour être transmis à l'afficheur
        $categories = $this-> Categories->getList('id', 'title');
        // modifie le titre de la page, ainsi que le titre et le sous titre de la bannière
        App::getInstance()->setTitle($post->title . ' | Admin');
        App::getInstance()->setPageTitle('Adminstration');
        App::getInstance()->setPageSubtitle('Article : '.$post->title);
        // modifie le variable stockant le nombre de commentaires signalés
        App::getInstance()->setNbCommentsFlagged($this->Comments->countFlagged());
        // initialise un formulaire contenant les valeurs de l'article
        $form = new BootstrapForm($post);
        // génere l'affichage de la page d'édition d'un article
        $this->render('Admin.Posts.edit', compact('post', 'categories', 'res', 'form'));
   }
   /**
    * controleur pour la page add de l'administration des articles
    */
    public function add()
    {
        //initialise la variable indiquant a l'afficheur si il y a une erreur
        $error = false;
        //teste si la supervariable POST n'est pas vide
        if(!empty($_POST)) {
            // teste si les champs du formulaire ne sont pas vide
            if($_POST['title'] !='' && $_POST['content'] !='' && $_POST['category_id'] !='') {
                // ajoute l'article a la table
                $res = $this->Posts->create(array(
                            'title' => $_POST['title'],
                            'content' => $_POST['content'],
                            'category_id' => $_POST['category_id'],
                            'publication_date' => $this->now()
                        ));
                // teste la valeur de res est vraie
                if ($res) {
                    // redirige vers la page d'accueil de l'administration des articles
                    header('location:?page=admin.posts.edit&id='.App::getInstance()->getDb()->lastInsertId());
                } else {
                    // modifie la variable error pour indiquer une erreur
                    $error = true; 
                }
            } else {
                // modifie la valeur de res pour indiquer une erreur 
                $res = false;
            }
        }
        // récupère la liste des catégories et la stocke dans un tableau pour être transmis à l'afficheur
        $categories = $this->Categories->getList('id', 'title');
        // modifie le titre de la page, ainsi que le titre et le sous titre de la bannière
        App::getInstance()->setTitle('Ajouter un article | Admin');
        App::getInstance()->setPageTitle('Adminstration');
        App::getInstance()->setPageSubtitle('Ajouter un article');
        // modifie le variable stockant le nombre de commentaires signalés
        App::getInstance()->setNbCommentsFlagged($this->Comments->countFlagged());
        // initialise un formulaire permettant de créer un article
        $form = new BootstrapForm($_POST);
        // génere l'affichage de la page d'ajout d'un article
        $this->render('Admin.Posts.add', compact('error', 'categories', 'form'));
    }
    /**
     * controleur pour l'action supprimer depuis la page d'accueil de l'administration des articles
     */
    public function delete()
    {
        //initialise la variable indiquant a l'afficheur si il y a une erreur
        $error = false;
        //teste si la supervariable POST n'est pas vide
        if(!empty($_POST)) {
            //supprime l'article
            $res = $this->Posts->delete($_POST['id']);
            // teste la valeur de res est vraie
            if ($res) {
                // redirige vers la page d'accueil de l'administration des articles
                header('location:index.php?page=admin.posts.index');
            } else {
                // modifie la variable error pour indiquer une erreur
                $error = true;
            }
            // génere l'affichage de la page d'erreur de supression d'un article
            $this->render('Admin.Posts.delete', compact('error'));
        }
    }
}
