<a href="?page=admin.categories.index" class="btn"> retour </a>
<?php if(!is_null($res)) :
    if ($res) {  ?>
        <div class="alert alert-success">
            Les données ont été sauvegardés avec succès ! 
        </div>
    <?php } else {  ?>
        <div class="alert alert-danger">
            Erreur lors de la sauvegarde ! 
        </div>
    <?php } 
endif;?>   
<h1>Modifier la catégorie : "<?= $categorie->title ?>"</h1>
<form method="POST">
    <?= $form->input('title', 'Titre de la catégorie'); ?>
    <?= $form->submit('Sauvegarder') ?>
</form>

