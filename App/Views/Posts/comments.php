<?php
//fonction retournant la date actuel au fuseau horaire de  
function now() 
{
    date_default_timezone_set('Europe/Paris');      
    $datetime = new \DateTime('');  
    $date = date("Y-m-d H:i:s");
    return $date;
}
$message = '';
//ajout du commentaire dans la base de données
if(!empty($_POST)) {
    $res = App::getInstance()->getTable('Comments')->create(array(
                'post_id' => $_POST['post_id'],
                'authorname' => $_POST['authorname'],
                'email' => $_POST['email'],
                'comment' => $_POST['comment'],
                'parent_id' => $_POST['parent_id'],
                'level' => $_POST['level'],
                'comment_date' => now()
            ));
    if (!$res) {
        $message = '<p>Erreur lors de l\'enregistrement du commentaire</p>'; 
    }
}
// récupère les commentaires associée au post actuel
$comments = App::getInstance()->getTable('Comments')->allForPost($post->id);
if (empty($comments)) {
    $message = "<p class=\"text-center\">Aucun commentaire. </p> <p class=\"text-center\">Soyez le premier à commenter cette article !</p>";
}
// $comments récupere les commentaires associé a l'article (trié par ID)
// ***organise les commentaires*** 
// fonction permettant de creer le tableau contenant les enfants
function arrayChild($id)
{
    return $name = 'ChildOfComment'.$id;
}
// parcourt $comments
foreach ($comments as $comment) :
//  | teste si parent_id === 0
    if ($comment->parent_id == 0) {
//  |  | crée tableau pour les enfants de ce commentaires ($childOf{id}
        ${arrayChild($comment->id)} = [];
//  | sinon
    } else {

//  |  | teste si $childOf{parent_id) existe
        if (isset(${arrayChild($comment->parent_id)})) {

//  |  |  | stocke les infos du commentaire actuelle dans $childOf{parent_id}
            ${arrayChild($comment->parent_id)}[] = $comment;

//  |  |  | supprime le commentaire de $comments
//  |  | sinon
        } else {
//  |  |  | crée tableau $childOf{parent_id}
            ${arrayChild($comment->parent_id)} = [];
//  |  |  | stocke les infos du commentaire actuelle dans $childOf{parent_id}
            ${arrayChild($comment->parent_id)}[] = $comment;

//  |  |  | supprime le commentaire de $comments
//  |  | fin test
        }
//  | fin test
    }
// fin parcours $comments
endforeach;
//fonction d'affichage
function showComment($comment, $compteur, $post)
{ ?>
    <div class="panel panel-default">
    <div class="panel-heading">
    <p><?= $comment->authorname ?> - <?= $comment->comment_date  ?> - ID : <?= $comment->id ?></p>
    </div>
    <div class="panel-body">
    <p>niveau du commentaire : <?=$comment->level ?></p>
    <p>id commentaire parent : <?=$comment->parent_id ?></p>
    <p><?=$comment->comment ?></p>               
    </div>
    
    <?php 
    // affiche le bouton répondre si le niveau du commentaire est inférieur ou égal à 2 
    if($comment->level <= 2) : 
        $collapseName = 'reponse'.(string)$compteur;
        $level = (int)$comment->level +1; 
        ?>
        <div class="panel-footer">
            &nbsp; <a class="pull-right" role="button" data-toggle="collapse" href="#<?=$collapseName ?>" aria-expanded="false" aria-controls="<?=$collapseName ?>">Répondre</a>
                <div class="collapse" id="<?=$collapseName ?>" >
                    <div class="well">
                        <form method="post" class="form-group">
                            <input type="hidden" name="post_id" value="<?=$post->id ?>" />
                            <input type="hidden" name="parent_id" value="<?=$comment->id ?>" />
                            <input type="hidden" name="level" value="<?=$level ?>" />
                            <label for="authorname">Votre nom : </label> 
                            <input type="text" name="authorname" id="authorname" class="form-control" required /> 
                            <label for="email">Votre adresse email : </label> 
                            <input type="email" name="email" id="email" class="form-control" required /> 
                            <label for="comment">Votre commentaire : </label> 
                            <textarea name="comment" id="comment" rows="5" required class="form-control"></textarea> 
                            <input type="submit" value="Repondre" class="btn btn-primary pull-right"/> 
                        </form> 
                    </div> 
                </div>                
            </div>
    <?php endif;?>
    </div>
    <?php
}
?>
<div>
    <h3>Commentaires</h3>
<?php
// ***affichage des commentaires***
// parcourt $comments
$compteur = 0;
foreach ($comments as $comment) : 
    $compteur++;
    if ($comment->parent_id == 0){
// | affiche le commentaire (panel)
    showComment($comment, $compteur, $post);
//  | teste si $childOf{id} existe
    if (isset(${arrayChild($comment->id)})) {
//  |  | parcourt $childOf{id}
        foreach (${arrayChild($comment->id)} as $commentLevel1) :
            $compteur++;
//  |  |  | affiche le commentaire (panel)
            echo '<div class="col-xs-offset-1">';
            showComment($commentLevel1, $compteur, $post);
//  |  |  | teste si $childOf{id} existe
            if (isset(${arrayChild($commentLevel1->id)})) {
//  |  |  |  | parcourt $childOf{id}
                foreach (${arrayChild($commentLevel1->id)} as $commentLevel2) :
                    $compteur++;
//  |  |  |  |  | affiche le commentaire (panel)
                    echo '<div class="col-xs-offset-1">';
                    showComment($commentLevel2, $compteur, $post);
//  |  |  |  |  | teste si $childOf{id} existe
                    if (isset(${arrayChild($commentLevel2->id)})) {
//  |  |  |  |  |  | parcourt $childOf{id}
                    foreach (${arrayChild($commentLevel2->id)} as $commentLevel3) :
                        $compteur++;
//  |  |  |  |  |  |  | affiche le commentaire (panel)
                        echo '<div class="col-xs-offset-1">';
                        showComment($commentLevel3, $compteur, $post);
//  |  |  |  |  |  | fin de parcours
                        echo '</div>';
                    endforeach;
//  |  |  |  |  | fin test
                    }
//  |  |  |  | fin de parcours
                    echo '</div>';
                endforeach;
//  |  |  | fin test
            }
//  |  | fin de parcours
            echo '</div>';
        endforeach;
//  | fin test
    }
    }
// fin de parcours
endforeach;

?>
</div>


    <?= $message ?>
    <div>
        <form method="post" class="form-group">
            <h4> laisser un commentaire </h4>
            <input type="hidden" name="post_id" value="<?= $post->id ?>" />
            <input type="hidden" name="parent_id" value="0" />
            <input type="hidden" name="level" value="0" />
            <label for="authorname">Votre nom : </label>
            <input type="text" name="authorname" id="authorname" class="form-control" required />
            <label for="email">Votre adresse email : </label>
            <input type="email" name="email" id="email" class="form-control" required />
            <label for="comment">Votre commentaire : </label>
            <textarea name="comment" id="comment" rows="5" required class="form-control"></textarea>
            <input type="submit" value="Valider" class="btn btn-primary pull-right"/>
        </form>
    </div>
</div>
