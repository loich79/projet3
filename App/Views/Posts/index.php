<h1>accueil</h1>
<div class="row">
    <div class="col-sm-8 bloc">
        <?php foreach ($posts as $post): ?>
        <h3><a href="<?= $post->url; ?>"><?= $post->title ?></a></h3>
        <p><em><?= $post->categorie ?></em></p>
        <p>Publié le <?= $post->date ?></p>
        <?= $post->extract; ?>
        <?php endforeach; ?>
    </div>
    <div class="col-sm-3 bloc">
        <h3>Catégories</h3>
        <ul class="list-unstyled">
            <?php foreach ($categoriesList as $categorie): ?>
            <li><a href="<?= $categorie->url; ?>"><?= $categorie->title ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>


