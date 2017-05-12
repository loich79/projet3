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
       parent::__construct();
       $this->loadModel('Categories');
       $this->loadModel("Comments");
   }
   /**
    * controleur pour la page index de l'administration des articles
    */
   public function index()
   { 
        $countCommentsFlagged = $this->Comments->countFlagged();
        App::getInstance()->setTitle('Categories | Admin');
        $categories = $this->Categories->all();
        $this->render('admin.categories.index', compact('categories', 'countCommentsFlagged'));
   }
   /**
    * controleur pour la page edit de l'administration des articles
    */
   public function edit() 
   {
       $res = null;    
        //update de la catégorie
        if(!empty($_POST)) {
            $res = $this->Categories->update($_GET['id'],
                    array(
                        'title' => $_POST['title']
                    ));
        }

        $categorie = $this->Categories->find($_GET['id']);

        // modifie le titre de la page
         App::getInstance()->setTitle($categorie->title . ' | Admin');

        $form = new BootstrapForm($categorie);

        $this->render('admin.categories.edit', compact('categorie', 'res', 'form'));
   }
   /**
    * controleur pour la page add de l'administration des articles
    */
    public function add()
    {
        $error = false;
        if(!empty($_POST)) {
            $res = $this->Categories->create(array(
                        'title' => $_POST['title']
                    ));
            if ($res) {
                header('location:?page=admin.categories.index');
            } else {
                $error = true; 
            }
        }
         App::getInstance()->setTitle('Ajouter une catégorie | Admin');

        $form = new BootstrapForm($_POST);
        $this->render('admin.categories.add', compact('error', 'form'));
    }
    public function delete()
    {
        $error = false;
        //supprime la catégorie
        if(!empty($_POST)) {
            $res = $this->Categories->delete($_POST['id']);
            if ($res) {
                header('location:index.php?page=admin.categories.index');
            } else {
                $error = true;
            }
        }
        $this->render('admin.categories.delete', compact('error'));
    }
}
