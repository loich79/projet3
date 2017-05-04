<h1><?= $post->title ?></h1>
<div class="row">
    <div class="col-sm-8 bloc">
        <p><em><?= $post->categorie ?></em></p>
        <p>Publié le <?= $post->date ?></p>
        <p><?= $post->content ?></p>
    </div>
    <div class="col-sm-3 bloc">
        <h2>Catégories</h2>
        <ul class="list-unstyled">
            <?php foreach ($categoriesList as $categories): ?>
            <li><a href="<?= $categories->url; ?>"><?= $categories->title ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
