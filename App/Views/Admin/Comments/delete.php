<a href="?page=admin.comments.index" class="btn"> retour </a>
<?php
if($error) :
?>
<div class="alert alert-danger">
    <p>Erreur lors de la suppression !</p> 
    <p><a href="?page=admin.comments.index">RETOUR A L'ADMINISTATION</a></p>
</div>
<?php
endif;
?>