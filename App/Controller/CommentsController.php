<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

/**
 * Description of CommentsController
 * controleur des commentaires
 * @author loich
 */
class CommentsController extends Controller {
    /**
     * contructeur pour le controleur des commentaires
     */
    public function __construct() {
        // appelle le contructeur du parent Controller
        parent::__construct();
        // génère le modele pour l'interface avec la table comments
        $this->loadModel('Comments');        
    }/**
     * redéfinition de la fonction render qui génère l'affichage
     * @param type $view string
     * @param type $variables array
     */
    protected function render($view, $variables = [])
    {
        extract($variables);
        require $this->viewPath . str_replace('.', '/', $view) . '.php';
    }
    /**
     * fonction permettant de creer le nom du tableau contenant les enfants
     * @param type $id int
     * @return type int
     */
    protected function arrayChild($id)
    {
        return $name = 'ChildOfComment'.$id;
    }
    /**
     * génère l'affichage des commentaire en fonction de l'id de l'article
     * @param type $post_id
     */
    public function show($postId) 
    {
        // initialise la variable message pour qu'elle n'affiche rien si il n'y a pas d'erreur ou d'information à afficher
        $message = '';
        //ajout du commentaire dans la base de données
        if(!empty($_POST)) {
            $res = $this->Comments->create(array(
                        'post_id' => $_POST['post_id'],
                        'authorname' => $_POST['authorname'],
                        'email' => $_POST['email'],
                        'comment' => $_POST['comment'],
                        'parent_id' => $_POST['parent_id'],
                        'level' => $_POST['level'],
                        'comment_date' => $this->now()
                    ));
            // affiche un message d'erreur si l'enregistrement du commentaire dans la base de données ne s'est pas fait
            if (!$res) {
                $message = '<p>Erreur lors de l\'enregistrement du commentaire</p>'; 
            }
        }
        // $comments récupere les commentaires associé a l'article (trié par ID)
        $comments = $this->Comments->allForPost($postId);
        
        // s'il n'y a pas de commentaire on affiche un message l'indiquant
        if (empty($comments)) {
            $message = "<p class=\"text-center\">Aucun commentaire. </p> <p class=\"text-center\">Soyez le premier à commenter cette article !</p>";
        }


        // ***organise les commentaires*** 
        /// tableau stockant tous les parent_id qui ont des enfants
        $arrayOfUsedParentId = []; 
        // tableau stockant tous les tableaux d'enfant
        $arrayOfArrayOfChild = [];
        // parcourt $comments
        foreach ($comments as $comment) :
        //  | teste si parent_id === 0
            if ($comment->parent_id == 0) {
        //  |  | crée tableau pour les enfants de ce commentaires ($childOf{id}
                ${$this->arrayChild($comment->id)} = [];
        //  | sinon
            } else {

        //  |  | teste si $childOf{parent_id) existe
                if (isset(${$comment->arrayChild($comment->parent_id)})) {

        //  |  |  | stocke les infos du commentaire actuelle dans $childOf{parent_id}
                    ${$this->arrayChild($comment->parent_id)}[] = $comment;
        //  |  |  | teste si le parent_id n'est pas déja dans le tableau alors on stocke le parent_id dans le tableau
                    if (!in_array($comment->parent_id, $arrayOfUsedParentId)) {
                        $arrayOfUsedParentId[] = $comment->parent_id; 
                    }
        //  |  | sinon
                } else {
        //  |  |  | crée tableau $childOf{parent_id}
                    ${$this->arrayChild($comment->parent_id)} = [];
        //  |  |  | stocke les infos du commentaire actuelle dans $childOf{parent_id}
                    ${$this->arrayChild($comment->parent_id)}[] = $comment;
        //  |  |  | teste si le parent_id n'est pas déja dans le tableau alors on stocke le parent_id dans le tableau 
                    if (!in_array($comment->parent_id, $arrayOfUsedParentId)) {
                        $arrayOfUsedParentId[] = $comment->parent_id; 
                    }
        //  |  | fin test
                }
        //  | fin test
            }
        // fin parcours $comments
        endforeach;
        // remplit le tableau contenant tout les tableau enfant pour le passer en parametre de la fonction render
        foreach ($arrayOfUsedParentId as $parent_id) : 
            $arrayOfArrayOfChild[$this->arrayChild($parent_id)] = ${$this->arrayChild($parent_id)};
        endforeach;
        $this->render('posts.comments', compact("message", "comments", "arrayOfArrayOfChild", "postId"));
    }
    /**
     * gère la fonction de signalement
     * incrémente le champ flag pour le commentaire concerné 
     */
    public function flag()
    {
        // recupère le commentaires qui a été signalé
        $comment = $this->Comments->find($_GET['id']);
        // crée la nouvelle valeur du champ flag (+1)
        $flag = $comment->flag +1; 
        // met a jour le commentaire dans la table comments
        $this->Comments->update($_GET['id'], array(
            "flag" => $flag
        ));
        // redirige vers la page de l'article
        header('location:index.php?page=posts.show&id='.$comment->post_id);
    }
}