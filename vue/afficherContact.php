<?php ob_start()?>

<div class="container">


<footer>
    <h6>Copyright perroquet - Tous droits réservés</h6>
    <p class="text-center">
        <a href="index.php?action=mentions-legales">Mentions légales</a>
        <a href="index.php?action=cookies">Cookies</a>
        <a href="index.php?action=donnees-personnelles">Données personnelles</a>
    </p>
</footer>
</div>

<?php
    $content=ob_get_clean();
    $titre = "Contact";
    require "vue/template.php";
?>