<?php ob_start()?>




<?php if(Securite::verifAccessAdmin()){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=administrer-formation">Aministration formation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=creer-formation">Créer formation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=administrer-utilisateur">administrer utilisateur</a>
                    </li>
                  
              
                    <?php } ?>

  <div class="row">



<?php
    $content=ob_get_clean();
    $titre = "Administration";
    require "vue/template.php";
?>
