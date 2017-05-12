
<div class="row">
    <div class="col-md-6">
        <h1>Modérer les commentaires</h1>      
    </div>
    <div class="col-md-3">
        <a href="index.php?page=admin.posts.index" class="btn btn-info center-block">Administrer les articles</a> 
    </div>
    <div class="col-md-3">
        <a href="index.php?page=admin.categories.index" class="btn btn-info center-block">Administrer les catégories</a> 
    </div>
 </div>
<?php if($countCommentsFlagged != 0) : ?>
<p class=" alert alert-danger text-center"> nombre de commentaires signalés : <?= $countCommentsFlagged ?></p>
<?php endif; ?>
<table class="table table-striped">
    <thead>
        <tr class="info">
            <td>ID</td>
            <td>commentaire</td>
            <td></td>
            <td>nombre de signalements</td>
            <td></td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($comments as $comment): ?>
        <tr <?php if ($comment->flag !=0) { echo 'class="danger"';}?>>
            <td><?= $comment->id; ?></td>
            <td><?= $comment->comment; ?></td>
            <td><a href="index.php?page=posts.show&id=<?= $comment->post_id; ?>" class="btn btn-primary">Afficher l'article</a></td>
            <td><?= $comment->flag; ?></td>
            
            <td>
                <?php if ($comment->flag !=0) :?>
               
                <form action="?page=admin.comments.unflag" method="post" style='display: inline'>
                    <input type="hidden" name="id" value="<?= $comment->id ?>" />
                    <button type="submit" class="btn btn-warning" name="unflag">Retirer le signalement</button>
                </form>
                <?php endif; ?>
            </td>
            
            <td>
                <form action="?page=admin.comments.delete" method="post" style='display: inline'>
                    <input type="hidden" name="id" value="<?= $comment->id ?>" />
                    <button type="submit" class="btn btn-danger" name="delete" title="supprime le commentaire et ses réponses éventuelles">Supprimer</button>
                </form>                
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
