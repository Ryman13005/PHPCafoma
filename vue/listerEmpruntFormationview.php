<?php ob_start()?>
<?php //require_once "model/LivreDao.php"; ?>
<?php //afficherTableau($tabLivres,"tabLivres"); ?>

<?php if($alert !== ""){ ?>
<div class="alert alert-danger" role="alert">
    <?= $alert ?>
</div>              
<?php } else { ?>
<div class="container">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">IdEmprunt</th>
          <th scope="col">Titre</th>
          <th scope="col">date pret</th>
          <th scope="col">date retour</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($empruntList as $emprunt) { ?>
          <tr class="align-middle">
            <td scope="row"><?php echo $emprunt->getIdEmprunt(); ?></td>
            <td><?php echo $emprunt->getTitreFormation(); ?></td>
            <td><?php echo  $emprunt->getDatePret(); ?></td> 
            <td><?php echo $emprunt->getDateRetour(); ?></td>
            <td><a href="index.php?action=afficher-formation&id=<?= $emprunt->getIdFormation(); ?>" class="btn btn-info">Lire</a></td>
            <td><a href="index.php?action=retourner-emprunt-formation&idEmprunt=<?= $emprunt->getIdEmprunt(); ?>&idLivre=<?= $emprunt->getIdFormation(); ?>" class="btn btn-danger">Retour</a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table> 
</div> 
<?php } ?>
<?php
    $content=ob_get_clean();
    $titre = "Liste des formations empruntés";
    require "vue/template.php";
?>