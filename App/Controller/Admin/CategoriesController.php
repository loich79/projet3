<?php
namespace App\Controller\Admin;
use App\HTML\BootstrapForm;
use \App;


/**
 * Description of ControllerCategorie
 *
 * @author loich
 */
class CategoriesController  extends AdminController{
    
   public function __construct() {
       // appelle le constructeur de la classe parent AdminController
       parent::__construct();
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
        App::getInstance()->setTitle('Categories | Admin');
        App::getInstance()->setPageTitle('Adminstration');
        App::getInstance()->setPageSubtitle('Catégories');
        // modifie le variable stockant le nombre de commentaires signalés
        App::getInstance()->setNbCommentsFlagged($this->Comments->countFlagged());
        // récupère toutes les catégories et les stocke dans un tableau pour être transmis à l'afficheur
        $categories = $this->Categories->all();
        // génere l'affichage de la page d'accueil de l'administration des catégories
        $this->render('admin.categories.index', compact('categories'));
   }
   /**
    * controleur pour la page edit de l'administration des articles
    */
   public function edit() 
   {
        //initialise res dans le cas d'un formulaire vide
        $res = null;    
        //teste si la supervariable POST n'est pas vide
        if(!empty($_POST)) {
            // teste si le titre envoyé dans le formulaire n'est pas vide
            if($_POST['title'] !='') {
                // mets à jour la catégorie
                $res = $this->Categories->update($_GET['id'],
                        array(
                            'title' => $_POST['title']
                        ));
            } else {
                // modifie la valeur de res pour indiquer une erreur 
                $res = false;
            }
        }
        // récupère la catégorie demandée et la stocke dans un tableau pour être transmis à l'afficheur
        $categorie = $this->Categories->find($_GET['id']);
        // modifie le titre de la page, ainsi que le titre et le sous titre de la bannière
        App::getInstance()->setTitle($categorie->title . ' | Admin');
        App::getInstance()->setPageTitle('Adminstration');
        App::getInstance()->setPageSubtitle('Catégorie : '.$categorie->title);
        // modifie le variable stockant le nombre de commentaires signalés
        App::getInstance()->setNbCommentsFlagged($this->Comments->countFlagged());
        // initialise un formulaire contenant les valeurs de la catégorie
        $form = new BootstrapForm($categorie);
        // génere l'affichage de la page d'édition d'une catégorie
        $this->render('admin.categories.edit', compact('categorie', 'res', 'form'));
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
            // teste si le titre envoyé dans le formulaire n'est pas vide
            if($_POST['title'] !='') {
                // ajoute une catégorie a la table 
                $res = $this->Categories->create(array(
                            'title' => $_POST['title']
                        ));
                // teste la valeur de res est vraie
                if ($res) {
                    // redirige vers la page d'accueil de l'administration des catégories
                    header('location:?page=admin.categories.index');
                } else {
                    // modifie la variable error pour indiquer une erreur
                    $error = true; 
                }
            } else {
                // modifie la valeur de res pour indiquer une erreur 
                $res = false;
            }            
        }
        // modifie le titre de la page, ainsi que le titre et le sous titre de la bannière
        App::getInstance()->setTitle('Ajouter une catégorie | Admin');
        App::getInstance()->setPageTitle('Adminstration');
        App::getInstance()->setPageSubtitle('Ajouter une catégorie');
        // modifie le variable stockant le nombre de commentaires signalés
        App::getInstance()->setNbCommentsFlagged($this->Comments->countFlagged());
        // initialise un formulaire permettant de créer une catégorie
        $form = new BootstrapForm($_POST);
        // génere l'affichage de la page d'ajout d'une catégorie
        $this->render('admin.categories.add', compact('error', 'form'));
    }
    /**
     * controleur pour l'action supprimer depuis la page d'accueil de l'administration des catégories
     */
    public function delete()
    {
        //initialise la variable indiquant a l'afficheur si il y a une erreur
        $error = false;
        //teste si la supervariable POST n'est pas vide
        if(!empty($_POST)) {
            //supprime la catégorie
            $res = $this->Categories->delete($_POST['id']);
            // teste la valeur de res est vraie
            if ($res) {
                // redirige vers la page d'accueil de l'administration des catégories
                header('location:index.php?page=admin.categories.index');
            } else {
                // modifie la variable error pour indiquer une erreur
                $error = true;
            }
        }
        // génere l'affichage de la page d'erreur de supression d'une catégorie
        $this->render('admin.categories.delete', compact('error'));
    }
}
