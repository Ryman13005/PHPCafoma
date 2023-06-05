<?php 
ob_start(); 
?>
<div class="container">
    <form method="POST" action="index.php?page=formations&action=modifier-formation-validation" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label" for="titre">Titre : </label>
        <input class="input" type="text" id="titre" name="titre" value="<?= $formation->getTitre() ?>">
      </div>
      <div class="mb-3">
        <label class="form-label" for="descr">Description : </label>
        <input class="input" type="text" id="descr" name="descr" value="<?= $formation->getDescription() ?>">
      </div>
      <img width="200px" src="public/images/<?php echo $formation->getImage(); ?>">
      <div class="mb-3">
        <label class="form-label" for="image">Image : </label>
        <input class="input" type="file" id="image" name="image">
      </div>
        <input type="hidden" name="id" value="<?= $formation->getId() ?>">
        <input type="hidden" name="image" value="<?= $formation->getImage() ?>">
      <input class="btn btn-primary" type="submit" value="modifier" name="form_ajouter"/> 
</form>
<?php
$content = ob_get_clean();
$titre = "Modifier la formation";
require "vue/template.php";
?>