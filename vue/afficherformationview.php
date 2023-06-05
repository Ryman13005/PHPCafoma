<?php 
ob_start(); 
?>
<br>
<div class="row">
    <div class="col-4">
        <img  style="width:80%; height:auto" src="public/images/<?= $formation->getImage(); ?>">
    </div>
    <div class="col-8">

        <br>
        <h3>Description :</h3> 
        <p><?= $formation->getDescription(); ?></p>
        <h3>Createur :</h3> 
        <?php $createur = $formation->getCreateur(); ?>
        <?php if(isset($createur)) { ?>
        <h5><a href="index.php?action=afficher-createur&idCreateur=<?php echo $createur->getIdCreateur(); ?>"><?= $createur->getNom(); ?></a></h5> 
            
        <?php } else { ?>
            <h4>Createur inconnu</h4>
        <?php } ?>
        
    </div>
</div>

<?php
$content = ob_get_clean();
$titre = $formation->getTitre();
require "vue/template.php";
?>
