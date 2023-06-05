<?php ob_start()?>

Télécharger l'application android : <a href="">bibliotheque android</a>

<?php
    $content=ob_get_clean();
    $titre = "Android";
    require "vue/template.php";
?>