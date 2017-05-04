<a href="?page=admin.posts.index" class="btn"> retour </a>
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
<h1>Modifier l'article : "<?= $post->title ?>"</h1>
<form method="POST">
    <?= $form->input('title', 'Titre de l\'article'); ?>
    <?= $form->input('content', 'contenu',['type' => 'textarea']) ?>
    <?= $form-> select('category_id', 'Catégories', $categories); ?>
    <?= $form->submit('Sauvegarder') ?>
</form>

