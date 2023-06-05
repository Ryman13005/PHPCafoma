<?php 
ob_start(); 
?>
<br>
<div class="row">
    <div class="col-12">
        <br>
        <h3>Nom : <?= $createur->getNom(); ?></h3>
        <br>
        <h3>Description :</h3> 
        <p><?= $createur->getVideographie(); ?></p>
        <br>
    </div>  
</div>

<?php if(isset($formationList) && !empty($formationList)) { ?>
<h3>Formations réalisées par le createur :</h3> 
<div class="container">
    <table class="table table-striped">
      <thead>
        <tr>
        <th scope="col">IdFormation</th>
          <th scope="col">Image</th>
          <th scope="col">Titre</th>
          <th scope="col" colspan="3">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($formationList as $formation) { ?>
          <tr class="align-middle">
            <td scope="row"><?php echo $formation->getId(); ?></td>
            <td><img width="80" src="public/images/<?php echo $formation->getImage(); ?>"></td>
            <td><?php echo $formation->getTitre(); ?></td>
            <td><a href="index.php?action=afficher-formation&id=<?= $formation->getId(); ?>" class="btn btn-info">Lire</a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table> 
</div> 
<?php } ?>
<?php
$content = ob_get_clean();
$titre = "Createur";
require "template.php";
?>