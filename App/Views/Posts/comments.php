<?php 
// fonction permettant de creer le nom du tableau contenant les enfants
function arrayChild($id)
{
    return $name = 'ChildOfComment'.$id;
} 
// fonction récursive permettant d'afficher les réponses a un commentaire et de gérer le décalage 
function showAllComments($arrayOfArrayOfChild, $comment, $compteur, $postId)
{
    if (isset($arrayOfArrayOfChild[arrayChild($comment->id)])) {
        // teste si le niveau du commentaires est inférieur au niveau maximun de réponses autorisé
        if($comment->level <= MAX_COMMENT_LEVEL ) {
            // parcourt $childOf{id}
            foreach ($arrayOfArrayOfChild[arrayChild($comment->id)] as $commentLevel1) {
                $compteur++;
                // crée un décalage de 30 pixels vers la droite pour l'affichage des réponses
                echo '<div style="margin-left:30px">';
                // affiche le commentaire (panel)
                showComment($commentLevel1, $compteur, $postId);
                // appelle la fonction showAllComments (récursivité)
                showAllComments($arrayOfArrayOfChild, $commentLevel1, $compteur, $postId);
                echo '</div>';
            }
        } 
    } 
}
//fonction d'affichage des commentaires (englobe le html nécessaire pour chaque commentaire)
// prend en paramètre l'objet commentaire ($comment), la valeur du compteur pour nommer le collapse du bouton répondre
// et l'id de l'article
function showComment($comment, $compteur, $postId)
{ ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <p>
                <?= htmlspecialchars($comment->authorname) ?> - <?= $comment->date  ?>
                <a href="index.php?page=posts.flag&id=<?= $comment->id ?>" class="pull-right">Signaler</a>
            </p>
        </div>
        <div class="panel-body">
            <p><?=htmlspecialchars($comment->comment) ?></p>               
        
        <?php 
        // affiche le bouton répondre si le niveau du commentaire est inférieur ou égal au niveau max de reponses - 1
        if($comment->level <= (MAX_COMMENT_LEVEL-1)) : 
            // cree le nom pour le collapse du bouton répondre
            $collapseName = 'reponse'.(string)$compteur;
            // crée la valeur pour la variable level de la réponse au commentaire 
            $level = (int)$comment->level +1; 
            ?>
        <!-- formulaire pour la réponse a un commentaire-->
            <div>
                <p>&nbsp; <a class="pull-right" role="button" data-toggle="collapse" href="#<?=$collapseName ?>" aria-expanded="false" aria-controls="<?=$collapseName ?>">Répondre</a></p>
                <div class="collapse" id="<?=$collapseName ?>" >
                    <div class="well">
                        <form method="post" class="form-group">
                            <input type="hidden" name="post_id" value="<?= $postId ?>" />
                            <input type="hidden" name="parent_id" value="<?=$comment->id ?>" />
                            <input type="hidden" name="level" value="<?=$level ?>" />
                            <label for="authorname">Votre nom : </label> 
                            <input type="text" name="authorname" id="authorname" class="form-control" required /> 
                            <label for="email">Votre adresse email : </label> 
                            <input type="email" name="email" id="email" class="form-control" required /> 
                            <label for="comment">Votre commentaire : </label> 
                            <textarea name="comment" id="comment" rows="5" required class="form-control"></textarea> 
                            <input type="submit" value="Répondre" class="btn btn-primary pull-right btn-reponse"/> 
                        </form> 
                    </div> 
                </div>                
            </div>
        <?php endif;?>
        </div>
    </div>
    <?php
}
?>
<!-- début d'affichage des commentaires -->
<div>
    <h3>Commentaires</h3>
<?php
// ***affichage des commentaires***
// $compteur sert pour nommer les collapses de bootstrap qui contiennent le formulaire de réponse
// ce compteur est incrémenté pour chaque commentaire affiché
$compteur = 0;
// parcourt $comments
foreach ($comments as $comment) { 
    $compteur++;
    // test si le commentaire est de niveau 0
    if ($comment->parent_id == 0){
        // affiche le commentaire (panel)
        showComment($comment, $compteur, $postId);
        // affiche les réponses au commentaire
        showAllComments($arrayOfArrayOfChild, $comment, $compteur, $postId);
    }
}

?>
</div>
<!-- affiche les messages d'erreur ou d'information -->
<?= $message ?>
<!-- affiche le formulaire pour commenter un article -->
<div>
    <form method="post" class="form-group">
        <h4> laisser un commentaire </h4>
        <input type="hidden" name="post_id" value="<?= $postId ?>" />
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
