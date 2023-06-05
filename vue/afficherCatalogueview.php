<?php 
  require_once "outil/OutilClass.php"; 
  require_once "outil/SecuriteClass.php"; 
  require_once "model/FormationDaoClass.php"; 
  ob_start(); 
?>



  <?php foreach($formations as $formation) { ?>
      <div class="col-3"></div>
        <div class="card p-1 m-1" style="width: 18rem;">
          <img height="300px" src="images/<?php echo $formation->getImage(); ?>" class="card-img-top" alt="image">
          <div class="card-body">
            <h5 class="card-title"><?php echo Outils::sousChaineTaille($formation->getTitre(), 18); ?></h5>
            <p class="card-text"><?php echo Outils::sousChaineTaille($formation->getDescription(),50); ?></p>
          
    

            <p><a href="index.php?action=afficher-createur&idCreateur=<?php echo $formation->getCreateur(); ?>"><?= $formation->getCreateur(); ?></a></p>
            
            <a href="index.php?action=afficher-formation&id=<?php echo $formation->getId(); ?>" class="btn btn-primary">Détail</a>
            <?php if(Securite::isConnected()){ ?>
                <a href="index.php?action=formation-inscription&id=<?php echo $formation->getId(); ?>" class="btn btn-success">S'inscrire</a>
                <?php } ?>

          </div>
        </div>
      </div>
  <?php } ?>

  </div>

<?php
$content = ob_get_clean();
$titre = "Catalogue";
require "vue/template.php";
?>  