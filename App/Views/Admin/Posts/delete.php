<div class="row">
    <div class="col-sm-offset-2 col-sm-8" >
        <a href="?page=admin.posts.index" class="btn btn-primary"> retour </a>
        <!-- affichage d'un message d'erreur si besoin -->
        <?php
        if($error) :
        ?>
        <div class="alert alert-danger">
            <p>Erreur lors de la suppression !</p> 
            <p><a href="?page=admin.posts.index">RETOUR A L'ADMINISTATION</a></p>
        </div>
        <?php
        endif;
        ?>
    </div>
</div>