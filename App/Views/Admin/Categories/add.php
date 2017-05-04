<a href="?page=admin.categories.index" class="btn"> retour </a>
<?php if($error) : ?>
    <div class="alert alert-danger">
        Erreur lors de la sauvegarde ! 
    </div>
<?php endif; ?>
<h1>Ajouter une catégorie</h1>
<form method="POST">
    <?= $form->input('title', 'Titre de la catégorie'); ?>
    <?= $form->submit('Sauvegarder') ?>
</form>

