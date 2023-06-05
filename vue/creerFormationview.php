<?php 
ob_start(); 
?>
<div class="container">
    <div class="row">
        <div class="col-6 text-center">
            <a href="index.php?action=gerer-createur" class="btn btn-primary">Gérer createur</a>
        </div>
     
    </div>
    <form method="POST" action="index.php?action=creer-formation-validation" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label" for="titre">Titre : </label>
        <input class="input" type="text" id="titre" name="titre">
      </div>
      <div class="mb-3">
        <label class="form-label" for="nb">Nombre exemplaire : </label>
        <input class="input" type="number" id="nb" name="nb">
      </div>
      <div class="mb-3">
        <label class="form-label" for="descr">Description : </label>
        <input class="input" type="text" id="descr" name="descr">
      </div>
      <div class="mb-3">
        <label class="form-label" for="image">Image : </label>
        <input class="input" type="file" id="image" name="image">
      </div>
      <div class="mb-3">
          <label for="createur" class="form-label">Createur</label>
          <select id="createur" class="input" name="idCreateur" >
              <?php foreach($createurList as $createur) { ?>
                <option value="<?php echo $createur->getIdCreateur(); ?>"><?php echo $createur->getNom(); ?></option>
              <?php } ?>                      
          </select>
      </div>  
     
      <input class="btn btn-primary" type="submit" value="ajouter" name="form_ajouter"/> 
</form>
<?php
$content = ob_get_clean();
$titre = "Ajout d'une formation";
require "vue/template.php";
?>