<?php ob_start()?>

<?php if($alert !== ""){ ?>
    <div class="alert alert-danger" role="alert">
        <?= $alert ?>
    </div>              
<?php } ?>

<form action="index.php?action=creer-abonne-validation" method="post">
<div class="form">
      <div class="title">Créer Compte</div>
      <div class="subtitle">Inscrivez vous dés maintenant!</div>
      <div class="input-container ic1">
        <input id="username" class="input" type="text" placeholder=" " name="login" />
        <div class="cut"></div>
        <label for="username" class="placeholder">Nom d'utilisateur</label>
      </div>
      <div class="input-container ic2">
        <input id="email" class="input" type="text" placeholder=" " name="mail" required />
        <div class="cut"></div>
        <label for="email" class="placeholder">Email</label>
      </div>
      <div class="input-container ic2">
        <input id="password" class="input" type="password" placeholder=" " name="password" />
        <div class="cut"></div>
        <label for="lastname" class="placeholder">Mot de passe</label>
      </div>

      <button type="submit" class="submit">submit</button>
    </div>

   
    <div class="form-check">
                <input class="form-check-input" type="checkbox" name="mentions" id="flexCheckIndeterminate">
                <label class="form-check-label" for="flexCheckIndeterminate">
                  J'ai lu et j'accepte les conditions de service décrites dans les 
                  <a href="index.php?action=mentions-legales">mentions légales</a>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="perso" id="flexCheckIndeterminate">
                <label class="form-check-label" for="flexCheckIndeterminate">
                  J'accepte que mes données soient conservées pour avoir accés aux services de la bibliothéques 
                </label>
            </div>
            </form> 
<?php
    $content=ob_get_clean();
    $titre = "S'inscrire";
    require "vue/template.php";
?>

