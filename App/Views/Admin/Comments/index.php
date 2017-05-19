<div class="row">
    <div class="col-sm-offset-2 col-sm-8" >
        <!-- affichage du nombre de commentaires signalés s'il y en a -->
        <?php if($countCommentsFlagged != 0) : ?>
        <p class=" alert alert-danger text-center"> nombre de commentaires signalés : <?= $countCommentsFlagged ?></p>
        <?php endif; ?>
        <!-- affichage d'un tableau contenant tout les commentaires-->
        <table class="table table-striped">
            <thead>
                <tr class="info">
                    <td class="text-center">ID</td>
                    <td class="text-center">Commentaire</td>
                    <td class="text-center">Article associé</td>
                    <td class="text-center">Nombre de signalements</td>
                    <td class="text-center">Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments as $comment): ?>
                <tr <?php if ($comment->flag !=0) { echo 'class="danger"';}?>>
                    <td class="text-center"><?= $comment->id; ?></td>
                    <td><?= htmlspecialchars($comment->comment); ?></td>
                    <td class="text-center">
                        <?= $comment->post_id; ?> &nbsp
                        <!-- affichage d'un bouton permettant de se rendre sur l'article auquel le commentaire appartient-->
                        <a href="index.php?page=posts.show&id=<?= $comment->post_id; ?>" class="btn btn-primary" target="_blank">Afficher</a>
                    </td>
                    <td class="text-center">
                        <?= $comment->flag; ?> &nbsp
                        <?php if ($comment->flag !=0) :?> 
                        <!-- affiche un bouton pour retirer le signalement s'il y en a -->
                        <form action="?page=admin.comments.unflag" method="post" style='display: inline'>
                            <input type="hidden" name="id" value="<?= $comment->id ?>" />
                            <button type="submit" class="btn btn-warning" name="unflag" title="retirer le signalement">Retirer</button>
                        </form>
                        <?php endif; ?>
                    </td>

                    <td>
                        <!-- affichage d'un bouton pour supprimer un commentaires et ses réponses s'il y en a -->
                        <form action="?page=admin.comments.delete" method="post" style='display: inline'>
                            <input type="hidden" name="id" value="<?= $comment->id ?>" />
                            <button type="submit" class="btn btn-danger" name="delete" title="supprime le commentaire et ses réponses éventuelles">Supprimer</button>
                        </form>                
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
