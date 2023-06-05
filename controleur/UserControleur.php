<?php
require_once "model/UserDaoClass.php";
require_once "outil/SecuriteClass.php";

class UserControleur {
    private $userDao;

    
    public function __construct(){
        $this->userDao = UsersDao::getInstance();

    }
    function accepterCookie(){
        require "vue/afficherCookieConsent.php";
    }

    function afficherRessources(){
        require "vue/ressourcesView.php";
    }

    function afficherAdministration(){
        require "vue/afficherAdministration.php";
    }


    function afficherContact(){
        require "vue/afficherContact.php";
    }
    function creerCompteAbonne(){
        $alert = "";
        require "vue/signUp.php";
    }
    function creerAbonneValidation($login,$mail,$password,$mentions,$perso){
        $alert = "";
        if(!$mentions || !$perso){
            $alert = "Vous devez valider les cases à cocher pour pouvoir créer un compte abonné"; 
            require "vue/signUp.php";
        }
        else {
    
            //$this->sendMailAbonne($login, $mail,$cle);
            $hash = password_hash($password, PASSWORD_DEFAULT);
            echo "hash=".$hash."<br>";
            $user=new User($login, $hash, $mail, "abonne","profils/profil.png", "1");
            $this->userDao->creerAbonne($user);
            require "vue/signUp.php";
            header("Location: index.php?action=login");
        }
    }
    private function sendMailAbonne($login,$mail){
        $urlVerification = "http://localhost/bdd/biblio-etape4-01/index.php?action=valider-abonne&login=".$login."";
        $sujet = "Création du compte sur le site Alcatar";
        $message = "Pour valider votre compte veuillez cliquer sur le lien suivant ".$urlVerification;
        Outils::sendMail($mail,$sujet,$message);
    }
    function recevoirMailAbonneValidation($login){
        $state = $this->userDao->validerAbonne($login);
        if($state == false)
            throw new Exception ("Le lien est incorrecte, votre compte n'est pas validé");
        $alert="";
        require "vue/logIn.php";
    }
    function login(){
        $alert="";
        if(!Securite::isConnected()){
            require "vue/logIn.php";
        }
        else header("Location: index.php?action=afficher-profil");
    }
    function loginValidation($login,$password){
        $alert="";
        if(!$this->userDao->isExistLoginUser($login)){
            throw new Exception("Le login n'existe pas");
        }
        else {          //if(!Securite::verifAccessAdmin()){
            if(isset($login) && !empty($login)
                     && isset($password) && !empty($password))        
            {
                if($this->userDao->isAbonneValide($login)){
                    $passwdHashbd = $this->userDao->getPasswdHashUser($login);
/*                     $hash = password_hash($password, PASSWORD_DEFAULT);
                    if ($hash == $passwdHashbd) {
                        $_SESSION['login'] = $login;
                        $_SESSION['role'] = $this->userDao->getRoleByLogin($login);
                        header("Location: index.php?action=afficher-profil");
                    } else {
                        $alert = $password ."=>".$passwdHashbd . ',=>' . $hash;
                        require "vue/logIn.php";
                    } */
                    if(password_verify($password, $passwdHashbd)){
                        $_SESSION['login'] = $login;
                        $_SESSION['role'] = $this->userDao->getRoleByLogin($login);
                        header("Location: index.php?action=afficher-profil");
                    }
                    else {
                        $alert = $password . "Mot de passe invalide";
                        require "vue/logIn.php";
                    }
                }
                else {
                    $alert = "Vous devez valider votre compte via votre mail";
                    require "vue/logIn.php";
                }
            } else {
                $alert = "Saisir un nom d'utilisateur et un mot de passe";
                require "vue/logIn.php";
            }
        }
    }
    function afficherProfil(){
        $user = $this->userDao->findUserByLogin($_SESSION['login']);
        require "vue/afficherProfil.php";
    }
    function supprimerCompteAbonne(){
        if($_SESSION['role'] == 'abonne'){
            if(!$this->empruntDao->isExistEmpruntByLogin($_SESSION['login'])){
                $user = $this->userDao->supprimerUser($_SESSION['login']);
                session_unset(); 
                echo "session_unset() ";
                require "vue/accueil.php";
            }
            else {
                throw new Exception("Impossible de supprimer votre compte car des emprunts y font référence");
            }
        }
        else {
            require "vue/afficherProfil.php";
        }
    }
    function logout(){
        if(Securite::isConnected()){
            unset($_SESSION['role']);
            unset($_SESSION['nom']);
            header("Location: index.php");
        }
        else throw new Exception("Vous n'êtes pas connecté, vous ne pouvez vous délogger");
    }
    function administrerUtilisateur(){
        if(Securite::verifAccessAdmin()){
            $users = $this->userDao->findAllUser();
            require "vue/administrerUtilisateur.php";
        }
        else throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
    }
    function supprimerUser($login){
        if(Securite::verifAccessAdmin()){
            if(!$this->empruntDao->isExistEmpruntByLogin($login)){
                $this->userDao->supprimerUser($login);
                header("Location: index.php?action=administrer-utilisateur");
            }
            else {
                throw new Exception("Impossible de supprimer votre compte car des emprunts y font référence");
            }
        }
        else throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
    }
}

