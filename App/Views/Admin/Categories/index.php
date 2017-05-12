<div class="row">
    <div class="col-md-6">
        <h1>Administrer les categories</h1>      
    </div>
    <div class="col-md-3">
        <a href="index.php?page=admin.posts.index" class="btn btn-info center-block">Administrer les articles</a>           
    </div>
    <div class="col-md-3">
        <a href="index.php?page=admin.comments.index" class="btn btn-info center-block">Modérer les commentaires </a>
        <?php if($countCommentsFlagged != 0) : ?>
        <p class=" alert alert-danger text-center">Commentaires signalés : <?= $countCommentsFlagged ?></p>
        <?php endif; ?>
    </div>
    
 </div>
<p>
    <a href="?page=admin.categories.add" class="btn btn-success">Ajouter</a>
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
        <?php foreach ($categories as $categorie): ?>
        <tr>
            <td><?= $categorie->id; ?></td>
            <td><?= $categorie->title; ?></td>
            <td>
                <a class="btn btn-primary" href="?page=admin.categories.edit&id=<?= $categorie->id; ?>">Editer</a>
                <form action="?page=admin.categories.delete" method="post" style='display: inline'>
                    <input type="hidden" name="id" value="<?= $categorie->id ?>" />
                    <button type="submit" class="btn btn-danger" >Supprimer</button>
                </form>
                
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
