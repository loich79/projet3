<div class="row">
    <!-- affichage de la liste des articles -->
    <div class="col-sm-offset-1 col-sm-7">
        <div class="row">
            <p><?= $post->content ?></p>
        </div>
        <div class="row">
        <?php 
            //affiche les commentaires
            $controlComment->show($post->id);
        ?>
        </div>
    </div>
    <!-- affichage de la liste des catégories -->
    <div class="col-sm-offset-1 col-sm-3">
        <h2>Catégories</h2>
        <ul class="list-unstyled">
            <?php foreach ($categoriesList as $categories): ?>
            <li><a href="<?= $categories->url; ?>"><?= $categories->title ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
