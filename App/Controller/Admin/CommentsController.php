<?php

namespace App\Controller\Admin;
use App\HTML\BootstrapForm;
use \App;

/**
 * Description of CommentsController
 * controlleur de l'administration des commentaires
 * @author loich
 */
class CommentsController extends AdminController{
    /**
     * contructeur pour le controlleur de l'administration des commentaires
     */
    public function __construct() {
        // appelle le constructeur de la classe parent AdminController
        parent::__construct();
        // génere le modèle faisant l'interface avec la table comments
        $this->loadModel("Comments");
    }
    /**
     * génère l'affichage de la page de modération des commentaires
     */
    public function index()
    {
        //récupère le nombres de commentaires signalés et le stocke dans une variable pour etre transmis à l'afficheur
        $countCommentsFlagged = $this->Comments->countFlagged();
        // modifie le titre de la page, ainsi que le titre et le sous titre de la bannière
        App::getInstance()->setTitle('Commentaires | Admin');
        App::getInstance()->setPageTitle('Adminstration');
        App::getInstance()->setPageSubtitle('Commentaires');
        // modifie le variable stockant le nombre de commentaires signalés
        App::getInstance()->setNbCommentsFlagged($countCommentsFlagged);
        // récupère tous les commentaires et les stocke dans un tableau pour être transmis à l'afficheur
        $comments = $this->Comments->all();
        // génere l'affichage de la page de modération des commentaires
        $this->render('admin.comments.index', compact('comments', 'countCommentsFlagged'));
    }
    /**
     * supprime un commentaire et ses réponses si il y en a 
     */
    public function delete()
    {
        //initialise la variable indiquant a l'afficheur si il y a une erreur
        $error = false;
        // remplit le tableau de commentaires a supprimer
        if(!empty($_POST )) {
            // récupère le commentaire qu'on doit supprimer
            $commentSelected = $this->Comments->find($_POST['id']);
            // ajoute le commentaire initial au tableau de commentaire à supprimer
            $CommentsToDelete[] = $commentSelected;
            // teste si le level est inférieur ou égal à niveau max de reponses autorisé
            if($commentSelected->level <= MAX_COMMENT_LEVEL) {
                // recherche les enfants de $commentSelected
                $CommentsChild1 = $this->Comments->findChild($commentSelected->id);
                //parcours le tableau des enfants de $commentSelected
                foreach ($CommentsChild1 as $child1) {
                    // ajoute le commentaire enfant $child1 au tableau de commentaire à supprimer
                    $CommentsToDelete[] = $child1;
                    // teste si le level $child1 est inférieur ou égal à niveau max de reponses autorisé
                    if($child1->level <= MAX_COMMENT_LEVEL) {
                        // recherche les enfants de $child1
                        $CommentsChild2 = $this->Comments->findChild($child1->id);
                        //parcours le tableau des enfants de $child1
                        foreach ($CommentsChild2 as $child2) {
                            // ajoute le commentaire enfant $child2 au tableau de commentaire à supprimer
                            $CommentsToDelete[] = $child2;
                            // teste si le level de $child2 est inférieur ou égal à niveau max de reponses autorisé
                            if($child2->level <= MAX_COMMENT_LEVEL) {
                                // recherche les enfants de $child2
                                $CommentsChild3 = $this->Comments->findChild($child2->id);
                                //parcours le tableau des enfants de $child2
                                foreach ($CommentsChild3 as $child3) {
                                    // ajoute le commentaire enfant $child3 au tableau de commentaire à supprimer
                                    $CommentsToDelete[] = $child3;
                                }
                            }
                        }
                    }
                    
                }
            }
            // supprime les commentaires contenu dans le tableau $commentToDelete
            // parcourt le tableau $commentToDelete
            foreach ($CommentsToDelete as $commentToDelete) {
                // supprime le commentaire $commentToDelete
                $res = $this->Comments->delete($commentToDelete->id);
                // teste le résultat de la requete
                if ($res) {
                    // si la requete a abouti on redirige vers l'index de l'admin des commentaires
                    header('location:index.php?page=admin.comments.index');
                } else {
                    // sinon indique que la variable $error vaut true
                    $error = true;
                }
            }
        } else {
            // sinon indique que la variable $error vaut true
            $error = true;
        }
        // génere l'affichage de la page erreur pour la suppression des commentaires
        $this->render('admin.comments.delete', compact('error'));
    }
    /**
     * retire les signalements
     */
    public function unflag()
    {
        // initialise la variable $error servant a signaler une erreur avec false
        $error = false;
        // teste si il y a bien des éléments dans la supervariable post
        if(!empty($_POST) ) {
            // met a jour le commentaire en indiquant que le champ flag du commentaire vaut 0
            $res = $this->Comments->update($_POST['id'], array("flag" => 0));
            // teste le résultat de la requete
            if ($res) {
                // si la requete a abouti on redirige vers l'index de l'admin des commentaires
                header('location:index.php?page=admin.comments.index');
            } else {
                // sinon indique que la variable $error vaut true
                $error = true;
            }
        }
        // génere l'affichage de la page erreur pour le retrait du signalement
        $this->render('admin.comments.unflag', compact('error'));
    }
}
