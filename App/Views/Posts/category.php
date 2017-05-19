<div class="row">
    <!-- affichage de la liste des articles -->
    <div class="col-sm-offset-1 col-md-8 bloc">
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
<!-- pagination -->
<?php 
// le pager s'affiche uniquement s'il y a plus d'une page à afficher 
if($nbPages>1) { ?>
<div class="row">
    <nav aria-label="Page navigation">
      <ul class="pager">
        <?php
        // teste si la page affiché est la première page pour desactiver le bouton precedent
        if($currentPage == 1) {?>
            <li class="disabled">
              <a href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
        <?php } else { ?>
            <li>
              <a href="index.php?page=posts.category&id=<?= $category->id?>&p=<?= ($currentPage-1) ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
        <?php } ?>
        <?php 
        // créer l'affichage des boutons numérotés en fonction du nombre de page
        for ($i=1;$i<=$nbPages;$i++) { 
            // teste si le numéro du bouton correspond a la page courante pour desactiver le bouton numéroté
            if($i == $currentPage) { ?>
            <li class="disabled">
                <a href="index.php?page=posts.category&id=<?= $category->id?>&p=<?= $i ?>"><?= $i ?><span class="sr-only">(current)</span></a>
            </li>
            <?php
            } else {?>
            <li>
                <a href="index.php?page=posts.category&id=<?= $category->id?>&p=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php    
            }        
        } ?> 
        <?php 
        // teste si la page affiché est la dernière page pour desactiver le bouton suivant
        if($currentPage == $nbPages) {?>
            <li class="disabled">
              <a href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
        <?php } else { ?>
            <li>
              <a href="index.php?page=posts.category&id=<?= $category->id?>&p=<?= ($currentPage+1) ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
        <?php } ?>
      </ul>
    </nav>
</div>
<?php } ?>