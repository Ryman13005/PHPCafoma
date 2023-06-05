<?php
require_once "controleur/FormationControleurClass.php";
require_once "outil/OutilClass.php";
require_once "outil/SecuriteClass.php";
require_once "controleur/UserControleur.php";

require_once "controleur/CreateurClassControleur.php";

// if (Securite::autoriserCookie()){
    session_start();
// }
 
$formationController = new FormationControleur();
$userControleur = new UserControleur();
 
$CreateurController = new CreateurControleur();


//Outils::afficherTableau($_SESSION,"SESSION");
//Outils::afficherTableau($_POST,"POST");
try{
    if(empty($_GET['action']) || !isset($_GET['action'])){
        $formationController->afficherAccueil();
       
    
    }
    else switch ($_GET['action']){

        case "afficher-accueil": $formationController->afficherAccueil();
        break;
        case "afficher-contact": $userControleur->afficherContact();
        break;

        case "afficher-ressources": $userControleur->afficherRessources();
        break;

        case "afficher-administration": $userControleur->afficherAdministration();
        break;
        
        case "formation-inscription": $formationController->afficherFormationInscription($_GET['id']);
         break;

          
        case "inscription-affichage": $formationController->afficherInscriptionsByLogin();
        break;
        case "inscription-suppression": $formationController->supprimerFormationInscription($_GET['id']);
        break;
     
         case "afficher-catalogue": $formationController->afficherCatalogue();
        break;
        case "afficher-formation": $formationController->afficherFormation($_GET['id']);
        break; 
        case "creer-abonne": $userControleur->creerCompteAbonne();
        break;
        case "creer-abonne-validation": $userControleur->creerAbonneValidation($_POST['login'], $_POST['mail'],$_POST['password'],
                                                                                    isset($_POST['mentions']),isset($_POST['perso']));
        break;
        case "valider-abonne": $userControleur->recevoirMailAbonneValidation($_GET['login'],$_GET['cle']);
        break;
        case "login": $userControleur->login();
        break;
        case "login-validation": $userControleur->loginValidation($_POST['login'], $_POST['passwd']);
        break;
        case "afficher-profil": $userControleur->afficherProfil();
        break;
        case "supprimer-abonne": $userControleur->supprimerCompteAbonne();
        break;
        case "logout":  $userControleur->logout();
        break;
        case "administrer-formation":  $formationController->administrerFormations();
        break;
        case "supprimer-formation":  $formationController->supprimerFormation($_GET['id']);
        break;
        case "modifier-formation": $formationController->modifierFormation($_GET['id']);
        break;
        case "modifier-formation-validation": $formationController->modifierFormationValidation($_POST['id'],$_POST['titre'],$_POST,['descr'],$_POST['image']);
        break;
        case "creer-formation": $formationController->creerFormation();
        break;
        case "creer-formation-validation": $formationController->creerValidationFormation($_POST['titre'],$_POST['nb'],$_POST['descr']);
        break;
        case "administrer-utilisateur": $userControleur->administrerUtilisateur();
        break;
        case "supprimer-user": $userControleur->supprimerUser($_GET['user']);
        break;
        case "mentions-legales": require "vue/mentionLegale.php";
        break;
        case "cookies": require "vue/cookiesview.php";
        break;
        case "donnees-personnelles": require "vue/donnespersonellesview.php";
        break;
        case "afficher-createur": $CreateurController->lireCreateur($_GET['idCreateur']);
        break;
        case "gerer-createur": $CreateurController->gererAllCreateur();
        break;
        case "creer-createur-validation": $CreateurController->creerCreateurValidation();
        break;
        case "android": require "vue/androidview.php";
        break;
        case "supprimer-cookie": echo "supprimer-cookie";
            session_destroy();
            //unset($_COOKIE['cookie-accept']);
            setcookie('cookie-accept', '', time()-3600, '/', '', false, false);
            header("Location: index.php");
        break;
        default: throw new Exception("La page n'existe pas");
    }
}catch(Exception $e){
    $title = "Erreur";
    $erreurMsg = $e->getMessage();
    require "vue/erreurview.php";
}
?>