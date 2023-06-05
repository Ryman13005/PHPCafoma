
<?php ob_start()?>

<?php if($alert !== ""){ ?>
    <div class="alert alert-danger" role="alert">
        <?= $alert ?>
    </div>              
<?php } ?>

<form action="index.php?action=login-validation" method="post">
<div class="form">
      <div class="title">Se Connecter</div>
      <div class="subtitle">Se connecter a son espace abonné</div>
      <div class="input-container ic1">
        <input id="username" class="input" type="text" placeholder=" " name="login"/>
        <div class="cut"></div>
        <label for="username" class="placeholder">Nom d'utilisateur</label>
      </div>
      <div class="input-container ic2">
        <input id="passwd" class="input" type="password" placeholder=" " name="passwd" />
        <div class="cut"></div>
        <label for="lastname" class="placeholder">Mot de passe</label>
      </div>

      <button type="submit" class="submit">submit</button> 
    </div>

    </form>
<?php
    $content=ob_get_clean();
    $titre = "login";
    require "vue/template.php";
?>