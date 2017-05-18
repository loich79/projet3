<!-- affichage d'un bouton pour ajouter une catégorie-->
<p>
    <a href="?page=admin.categories.add" class="btn btn-success">Ajouter</a>
</p>
<!-- affichage d'un tableau contenant les catégories existantes -->
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
                <!-- affichage d'un bouton pour éditer la catégorie-->
                <a class="btn btn-primary" href="?page=admin.categories.edit&id=<?= $categorie->id; ?>">Editer</a>
                <!-- affichage d'un bouton pour supprimer la catégorie-->
                <form action="?page=admin.categories.delete" method="post" style='display: inline'>
                    <input type="hidden" name="id" value="<?= $categorie->id ?>" />
                    <button type="submit" class="btn btn-danger" >Supprimer</button>
                </form>                
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
