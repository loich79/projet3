<?php
//template du footer
// affichage différencier si une session existe ou non
if(isset($_SESSION['auth'])) {
?>
<footer>
        <p><a href="?page=admin.posts.index" class="btn">Administration</a></p>
        <p><a href='?page=users.logout' class="btn">Se déconnecter</a></p>
</footer>
<?php
} else {
?>
<footer>
        <p><a href="?page=admin.posts.index" class="btn">Administration</a></p>
</footer>
<?php
}
