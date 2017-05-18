<div class="row">
    <!-- affichage de la liste des articles -->
    <div class="col-md-8 bloc">
        <?php foreach ($posts as $post): ?>
        <h2><a href="<?= $post->url; ?>"><?= $post->title ?></a></h2>
        <p>Publié le <?= $post->date ?></p>
        <?= $post->extract; ?>
        <hr>
        <?php endforeach; ?>
    </div>
    <!-- affichage de la liste des catégories -->
    <div class="col-sm-3 bloc">
        <h2>Catégories</h2>
        <ul class="list-unstyled">
            <?php foreach ($categoriesList as $categories): ?>
            <li><a href="<?= $categories->url; ?>"><?= $categories->title ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>