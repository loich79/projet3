<div class="row">
    <div class="col-sm-offset-2 col-sm-8" >
        <a href="?page=admin.categories.index" class="btn btn-primary"> retour </a>
        <!-- affichage d'un message d'erreur si nécessaire -->
        <?php if($error) : ?>
            <div class="alert alert-danger">
                Erreur lors de la sauvegarde ! 
            </div>
        <?php endif; ?>
        <!-- affichage du formulaire pour l'ajout d'une catégorie -->
        <form method="POST">
            <?= $form->input('title', 'Titre de la catégorie'); ?>
            <?= $form->submit('Sauvegarder') ?>
        </form>
    </div>
</div>
