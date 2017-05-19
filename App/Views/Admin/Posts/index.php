<div class="row">
    <div class="col-sm-offset-2 col-sm-8" >
        <!-- affichage d'un bouton pour ajouter un article -->
        <p>
            <a href="index.php?page=admin.posts.add" class="btn btn-success">Ajouter</a>
        </p>
        <!-- affichage d'un tableau contenant les articles existants -->
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
                        <!-- affichage d'un bouton pour éditer l'article -->
                        <a class="btn btn-primary" href="index.php?page=admin.posts.edit&id=<?= $post->id; ?>">Editer</a>
                        <!-- affichage d'un bouton pour supprimer l'article -->
                        <form action="index.php?page=admin.posts.delete" method="post" style='display: inline'>
                            <input type="hidden" name="id" value="<?= $post->id ?>" />
                            <button type="submit" class="btn btn-danger" >Supprimer</button>
                        </form>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
