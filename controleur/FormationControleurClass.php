<?php
require_once "model/FormationDaoClass.php"; 
require_once "./outil/OutilClass.php";

class FormationControleur{
    private $formationDao;
 
    private $createurDao;

    public function __construct(){
        $this->formationDao = FormationDao::getInstance();
       
        $this->createurDao = CreateurDao::getInstance();
    }
    function afficherAccueil(){
        require "vue/accueil.php";
    }
    function afficherCatalogue(){
        $alert = "";
        $formations=$this->formationDao->findAllFormation();
        require "vue/afficherCatalogueview.php";
    }

    function afficherInscriptionsByLogin(){
        $alert = "";
        $formations=$this->formationDao->findAllInscriptionsByLogin($_SESSION["login"]);
        if($formations == null){
            $alert = "Vous êtes  inscrit à aucune formation";
        }
        require "vue/afficherFormationInscription.php";
    }


    function afficherFormation($id){
        $formation=$this->formationDao->findOneFormationById($id);
        require "vue/afficherformationview.php";
    }

    function afficherFormationInscription($id){
        $alert = "";
        $formations =$this->formationDao->creerInscription($id,$_SESSION["login"], date("Y-m-d H:i:s"));
        Outils::afficherTableau($formations,"formations");
    
        header('Location:index.php?action=inscription-affichage'); 
    }

    function supprimerFormationInscription($id){
        $alert = "";
        $formations =$this->formationDao->supprimerInscription($id,$_SESSION["login"]);
        Outils::afficherTableau($formations,"formations");
        
        header('Location:index.php?action=inscription-affichage'); 
    }


  
 
 

    function afficherPanierEmprunt(){
        $alert="";
        if(isset($_SESSION['formations'])){   
            foreach($_SESSION['formations'] as $id){
                $formations[]=$this->formationDao->findOneFormationById($id);
            }
        }
        if(!isset($formations) || empty($formations)){
            $alert="Votre panier est vide, sélectionnez en dans le catalogue";
        }
        require "vue/afficherpanierEmprunt.php";
    }
    function supprimerFormation($id){ 
        if(Securite::verifAccessAdmin()){           
            if(!$this->empruntDao->isExistEmpruntByIdFormation($id)){
                $nomImage = $this->formationDao->findOneFormationById($id)->getImage();
                $this->formationDao->supprimerFormation($id);
                unlink("public/images/".$nomImage);
                header("Location: index.php?action=administrer-formation");
            }    
            else throw new Exception("Impossible de supprimer la formation car des emprunts y font référence");
        }
        else throw new Exception("Vous n'avez pas les droit nécessaires");
    }
    function creerFormation(){ // Tester les droits
        if(Securite::verifAccessAdmin()){
            $createurList = $this->createurDao->findAllCreateur();
          
            require "vue/creerFormationview.php";
        }
        else throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
    }
    function creerValidationFormation($titre,$nb,$description){ // Tester les droits
        if(Securite::verifAccessAdmin()){
            $file = $_FILES['image'];
            $repertoire = "public/images/";
            $nomImageAjoute = Outils::ajouterImage($file,$repertoire);
            $this->formationDao->creerFormation($titre,$nb,$nomImageAjoute,$description);
            header("Location: index.php?action=administrer-formation");
        }
        else throw new Exception("Vous n'avez pas les droit nécessaires");
    }
    function afficherCardFormations(){
        $formations=$this->formationDao->lireFormations();
        require "vue/cardLivres.view.php";
    }
    function modifierFormation($id){ // Tester les droits
        if(Securite::verifAccessAdmin()){
            //echo "Modifier LIVRE id=".$id."<br>";
            $formation=$this->formationDao->findOneFormationById($id);
            require "vue/modifierFormation.php";
        }
        else throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
    }
    function modifierFormationValidation($id,$titre,$nb,$description,$image){ // Tester les droits
        if(Securite::verifAccessAdmin()){
            Outils::afficherTableau($_POST,"POST");
            // echo "Modifier VALIDATION LIVRE id<br>";
            $repertoire = "public/images/";
            $nomImageAjoute = $image;
            $file = $_FILES['image'];
            Outils::afficherTableau($file,"file");
            $repertoire = "public/images/";
            if($_FILES['image']['size'] > 0){
                unlink($repertoire.$nomImageAjoute);
                $nomImageAjoute = Outils::ajouterImage($file,$repertoire);
            }
            
            $formations=$this->formationDao->modifierFormation($id,$titre,$nb,$nomImageAjoute,$description);
            header("Location: index.php?action=administrer-formation");
        }
        else throw new Exception("Vous n'avez pas les droit nécessaires");
    }
    function ajouerterFormationPanier($id){ // ajout exception 
        $alert="";
        if(!isset($_SESSION['formations'])){
            $_SESSION['formations'] = array();
        }
        if(in_array($id, $_SESSION['formations'])){
            echo $id." est déjà commander<br>";
            throw new Exception("Vous avez déjà commander ce livre");
        }
        else {
            $_SESSION['formations'][]=$id;
        }
        Outils::afficherTableau($_SESSION['formations'],"SESSION['formations']");
        header("Location: index.php?action=afficher-catalogue");
    }
    function supprimerFormationPanier($id){
        for ($i = 0; $i < count($_SESSION['formations']); $i++){
            if($_SESSION['formations'][$i] == $id){
                unset($_SESSION['formations'][$i]);
            } 
        }
        header("Location: index.php?action=afficher-panier");
    }
    function administrerFormations(){
        $tabFormations=$this->formationDao->findAllFormation();
        require "vue/administrerFormationsview.php";
    }
}
?>