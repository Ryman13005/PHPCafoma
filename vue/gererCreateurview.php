<?php ob_start()?>
<?php //require_once "model/LivreManager.php"; ?>
<?php //afficherTableau($tabLivres,"tabLivres"); ?>

<div class="container">
    
           <form action="index.php?action=creer-createur-validation" method="post">
            <div class="form-group">
              <label for="nom" class="form-label">Nom</label>
              <input type="text" class="input" id="nom" name="nom">
            </div>
            <div class="form-group">
              <label for="videographie" class="form-label">Videographie</label>
              <textarea name="videogprahie" rows="6" class="input" placeholder="Saisir la videographie du createur."></textarea><br>
            <div class="form-group">           
            <button type="submit" class="btn btn-primary">créer</button>
          </form>
    
    <table class="table table-striped">
      <thead>
        <tr>
        <th scope="col">IdCreateur</th>
          <th scope="col">Nom</th>
          <th scope="col">Videographie</th>
          <th scope="col" colspan="2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($createurList as $createur) { ?>
          <tr class="align-middle">
            <td scope="row"><?php echo $createur->getIdCreateur(); ?></td>
            <td><?php echo $createur->getNom(); ?></td>
            <td><?php echo Outils::sousChaineTaille($createur->getVideographie(),40); ?></td>
            <td><a href="index.php?action=afficher-createur&idCreateur=<?= $createur->getIdCreateur(); ?>" class="btn btn-info">Lire</a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table> 
</div> 
<?php
    $content=ob_get_clean();
    $titre = "Administrer la liste des createurs";
    require "vue/template.php";
?>