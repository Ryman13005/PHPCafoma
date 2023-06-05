<header>
<div class="logo">CAFOMA</div>
<div class="hamburger"> 
    <div class= "line"></div>
    <div class= "line"></div>
    <div class= "line"></div>

</div>

<nav class="nav-bar">

<?php ?>
    <ul>
      

   
    <li>
       <?php if($titre == "Accueil") { echo ' <a href="index.php?action=afficher-accueil" class="active">Accueil</a>'; } else  {echo '<a href="index.php?action=afficher-accueil">Accueil</a>'; } ?>
    </li>  

    
      <?php if(!Securite::isConnected()){ // si non connecté ?>
        <?php if(Securite::autoriserCookie()){ ?>
    
      <?php } ?>

      <li>
    
    <?php if($titre == "Android") { echo ' <a href="index.php?action=android" class="active">Application Android</a>'; } else  {echo '<a href="index.php?action=android">Application Android</a>'; } ?>

   </li>

  
    <li>
     
     <li>
    <?php if($titre == "S'inscrire") { echo ' <a href="index.php?action=creer-abonne" class="active">S\'inscrire</a>'; } else  {echo '<a href="index.php?action=creer-abonne">S\'inscrire</a>'; } ?>
      </li>
                    

   <li>
    
    <?php if($titre == "Login") { echo ' <a href="index.php?action=login" class="active">Se Connecter</a>'; } else  {echo '<a href="index.php?action=login">Se Connecter</a>'; } ?>

   </li>

         
   <li>
    <?php if($titre == "Contact") { echo ' <a href="index.php?action=afficher-contact" class="active">Contact</a>'; } else  {echo '<a href="index.php?action=afficher-contact">Contact</a>'; } ?>
      </li>


  
   <?php } ?>

   <?php if(Securite::verifAccessAdmin()){ ?>

      
    <li>
    <?php if($titre == "Administration") { echo ' <a href="index.php?action=afficher-administration" class="active">Administration</a>'; } else  {echo '<a href="index.php?action=afficher-administration">Administration</a>'; } ?>
      </li>



    <?php } ?>


   
   <?php if(Securite::isConnected()){ // si connecté ?>

  

      
<li>
    <?php if($titre == "Catalogue") { echo ' <a href="index.php?action=afficher-catalogue" class="active">Catalogue</a>'; } else  {echo '<a href="index.php?action=afficher-catalogue">Catalogue</a>'; } ?>
      </li>


    <li>
    <?php if($titre == "Profil") { echo ' <a href="index.php?action=afficher-profil" class="active"> Profil</a>'; } else  {echo '<a href="index.php?action=afficher-profil" > Profil</a>'; } ?>
</li>

<!-- <li>
    <?php if($titre == "Historique") { echo ' <a href="index.php?action=afficher-historique-emprunt" class="active">Historique</a>'; } else  {echo '<a href="index.php?action=afficher-historique-emprunt">Historique</a>'; } ?>
</li> -->
<li>
    <?php if($titre == "Apprentissage") { echo ' <a href="index.php?action=inscription-affichage" class="active"> Apprentissage</a>'; } else  {echo '<a href="index.php?action=inscription-affichage" > Apprentissage</a>'; } ?>
</li>


    <li>
    <?php if($titre == "Deconnexion") { echo ' <a href="index.php?action=logout" class="active">Deconnexion</a>'; } else  {echo '<a href="index.php?action=logout">Deconnexion</a>'; } ?>
</li>
    <?php } ?>  
 *
    
    </ul>
    <?php ?>    

</nav>

</header>