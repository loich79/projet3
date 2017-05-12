
<div class="row">
    <div class="col-md-6">
        <h1>Administrer les articles</h1>      
    </div>
    <div class="col-md-3">
        <a href="index.php?page=admin.categories.index" class="btn btn-info center-block">Administrer les catégories</a> 
    </div>
    <div class="col-md-3">
        <a href="index.php?page=admin.comments.index" class="btn btn-info center-block">modérer les commentaires </a>
        <?php if($countCommentsFlagged != 0) : ?>
        <p class=" alert alert-danger text-center">Commentaires signalés : <?= $countCommentsFlagged ?></p>
        <?php endif; ?>
    </div>
 </div>
<p>
    <a href="index.php?page=admin.posts.add" class="btn btn-success">Ajouter</a>
</p>
<table class="table table-striped">
    <thead>
        <tr>
            <td>ID</td>
            <td>Titre</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($posts as $post): ?>
        <tr>
            <td><?= $post->id; ?></td>
            <td><?= $post->title; ?></td>
            <td>
                <a class="btn btn-primary" href="index.php?page=admin.posts.edit&id=<?= $post->id; ?>">Editer</a>
                <form action="index.php?page=admin.posts.delete" method="post" style='display: inline'>
                    <input type="hidden" name="id" value="<?= $post->id ?>" />
                    <button type="submit" class="btn btn-danger" >Supprimer</button>
                </form>
                
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
