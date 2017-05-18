<a href="?page=admin.comments.index" class="btn btn-primary"> retour </a>
<!-- affichage d'un message d'erreur si besoin -->
<?php
if($error) :
?>
<div class="alert alert-danger">
    <p>Erreur lors du retrait du signalement !</p> 
    <p><a href="?page=admin.comments.index">RETOUR A L'ADMINISTATION</a></p>
</div>
<?php
endif;
?>
