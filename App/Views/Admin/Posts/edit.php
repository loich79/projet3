<a href="?page=admin.posts.index" class="btn btn-primary"> retour </a>
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
<!-- affichage du formulaire pour éditer l'article -->
<form method="POST">
    <?= $form->input('title', 'Titre de l\'article'); ?>
    <?= $form->input('content', 'contenu',['type' => 'textarea']) ?>
    <!-- démarre le script pour afficher l'éditeur de texte TinyMCE -->
    <script>tinymce.init({ selector:'textarea', language: 'fr_FR' });</script>
    <?= $form-> select('category_id', 'Catégories', $categories); ?>
    <?= $form->submit('Sauvegarder') ?>
</form>

