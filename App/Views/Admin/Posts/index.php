
<div class="row">
    <div class="col-md-8">
        <h1>Administrer les articles</h1>      
    </div>
    <div class="col-md-4">
        <a href="index.php?page=admin.categories.index" class="btn btn-info">Administrer les categories</a> 
    </div>
 </div>
<p>
    <a href="index.php?page=admin.posts.add" class="btn btn-success">Ajouter</a>
</p>
<table class="table">
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
