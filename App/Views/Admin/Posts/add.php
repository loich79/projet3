<div class="row">
    <div class="col-sm-offset-2 col-sm-8" >
        <a href="?page=admin.post.index" class="btn btn-primary"> retour </a>
        <!-- affichage d'un message d'erreur si besoin-->
        <?php if($error) : ?>
            <div class="alert alert-danger">
                Erreur lors de la sauvegarde ! 
            </div>
        <?php endif; ?>
        <!-- affichage d'un formulaire pour ajouter un article -->
        <form method="POST">
            <?= $form->input('title', 'Titre de l\'article'); ?>
            <?= $form->input('content', 'contenu',['type' => 'textarea']) ?>
            <!-- démarre le script pour afficher l'éditeur de texte TinyMCE -->
            <script>tinymce.init({ selector:'textarea', language: 'fr_FR' });</script>
            <?= $form-> select('category_id', 'Catégories', $categories); ?>
            <?= $form->submit('Sauvegarder') ?>
        </form>
    </div>
</div>
    