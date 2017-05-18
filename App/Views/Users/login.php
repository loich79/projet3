<!-- affichage d'un message d'erreur si besoin -->
<?php if($errors) :  ?>
<div class="alert alert-danger">
    Identifiants incorrects !
</div>    
<?php endif; ?>
<!-- affichage d'un formulaire pour saisir les identifiants -->
<form method="POST">
    <?= $form->input('username', 'Identifiant'); ?>
    <?= $form->input('password', 'Mot de passe',['type' => 'password']) ?>
    <?= $form->submit() ?>
</form>

