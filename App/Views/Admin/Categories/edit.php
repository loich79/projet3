<div class="row">
    <div class="col-sm-offset-2 col-sm-8" >
        <a href="?page=admin.categories.index" class="btn btn-primary"> retour </a>
        <!-- Affichage d'un message selon le résultat de l'enregistrement de la modification -->
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
        <!-- affichage d'un formulaire pour l'édition de la catégorie -->
        <form method="POST">
            <?= $form->input('title', 'Titre de la catégorie'); ?>
            <?= $form->submit('Sauvegarder') ?>
        </form>
    </div>
</div>