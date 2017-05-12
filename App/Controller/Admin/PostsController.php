<?php
namespace App\Controller\Admin;
use App\HTML\BootstrapForm;
use \App;


/**
 * Description of ControllerArticle
 *
 * @author loich
 */
class PostsController extends AdminController{
    
   public function __construct() {
       parent::__construct();
       $this->loadModel('Posts');
       $this->loadModel('Categories');
       $this->loadModel("Comments");
   }
   /**
    * controleur pour la page index de l'administration des articles
    */
   public function index()
   { 
        $countCommentsFlagged = $this->Comments->countFlagged();
        App::getInstance()->setTitle('Articles | Admin');
        $posts = $this->Posts->all();
        $this->render('admin.posts.index', compact('posts', 'countCommentsFlagged'));
   }
   /**
    * controleur pour la page edit de l'administration des articles
    */
   public function edit() 
   {
    $res = null;    
    //update de l'article
        if(!empty($_POST)) {
            $res = $this->Posts->update($_GET['id'],
                    array(
                        'title' => $_POST['title'],
                        'content' => $_POST['content'],
                        'category_id' => $_POST['category_id']
                    ));
        }

        $post = $this->Posts->find($_GET['id']);
        $categories = $this-> Categories->getList('id', 'title');
        // modifie le titre de la page
         App::getInstance()->setTitle($post->title . ' | Admin');

        $form = new BootstrapForm($post);
        $this->render('admin.posts.edit', compact('post', 'categories', 'res', 'form'));
   }
   /**
    * controleur pour la page add de l'administration des articles
    */
    public function add()
    {
        $error = false;
        if(!empty($_POST)) {
            $res = $this->Posts->create(array(
                        'title' => $_POST['title'],
                        'content' => $_POST['content'],
                        'category_id' => $_POST['category_id'],
                        'publication_date' => $this->now()
                    ));
            if ($res) {
                header('location:?page=admin.posts.edit&id='.App::getInstance()->getDb()->lastInsertId());
            } else {
                $error = true; 
            }
        }

        $categories = $this->Categories->getList('id', 'title');
        // modifie le titre de la page
         App::getInstance()->setTitle('Ajouter un article | Admin');

        $form = new BootstrapForm($_POST);
        $this->render('admin.posts.add', compact('error', 'categories', 'form'));
    }
    public function delete()
    {
        $error = false;
        //supprime l'article
        if(!empty($_POST)) {
            $res = $this->Posts->delete($_POST['id']);
            if ($res) {
                header('location:index.php?page=admin.posts.index');
            } else {
                $error = true;
            }
            $this->render('admin.posts.delete', compact('error'));
        }
    }
}
