
<?php 
  require_once "outil/OutilClass.php"; 
  require_once "outil/SecuriteClass.php"; 
  require_once "model/FormationDaoClass.php"; 
  ob_start();   
?>

<?php if($alert !== ""){ ?>
  <div class="alert alert-danger" role="alert">
    <?= $alert ?>
  </div>
<?php } else { ?> 



  <?php foreach($formations as $formation) { ?>

    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=afficher-ressources">Ressources</a>
                    </li>
      <div class="col-3"></div>
        <div class="card p-1 m-1" style="width: 18rem;">
          <img height="300px" src="images/<?php echo $formation->getImage(); ?>" class="card-img-top" alt="image">
          <div class="card-body">
            <h5 class="card-title"><?php echo Outils::sousChaineTaille($formation->getTitre(), 18); ?></h5>
            <p class="card-text"><?php echo Outils::sousChaineTaille($formation->getDescription(),50); ?></p>
          
           

            <p><a href="index.php?action=afficher-createur&idCreateur=<?php echo $formation->getCreateur(); ?>"><?= $formation->getCreateur(); ?></a></p>
            
            <a href="index.php?action=afficher-formation&id=<?php echo $formation->getId(); ?>" class="btn btn-primary">Suivre</a>
            <?php if(Securite::isConnected()){ ?>
                <a href="index.php?action=inscription-suppression&id=<?php echo $formation->getId(); ?>" class="btn btn-success">Désinscrire</a>
                <?php } ?>

          </div>
        </div>
      </div>
  <?php } ?>

  <?php } ?>


<?php
    $content=ob_get_clean();
    $titre = "Formations Inscrites";
    require "vue/template.php";
?>

