<a href="?page=admin.post.index" class="btn"> retour </a>
<?php if($error) : ?>
    <div class="alert alert-danger">
        Erreur lors de la sauvegarde ! 
    </div>
<?php endif; ?>
<h1>Ajouter un article</h1>
<form method="POST">
    <?= $form->input('title', 'Titre de l\'article'); ?>
    <?= $form->input('content', 'contenu',['type' => 'textarea']) ?>
    <?= $form-> select('category_id', 'Catégories', $categories); ?>
    <?= $form->submit('Sauvegarder') ?>
</form>

    