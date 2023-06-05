<?php
require_once "model/FormationDaoClass.php"; 
require_once "./outil/OutilClass.php";

class CreateurControleur {
    private $formationDao;
    private $createurDao;
   

    public function __construct(){
        $this->formationDao = FormationDao::getInstance();
        $this->createurDao = CreateurDao::getInstance();
    
    }
    public function lireCreateur($idCreateur){
        $createur = $this->createurDao->findCreateurByIdCreateur($idCreateur);
      
        $formationList = $this->formationDao->findAllFormationByIdCreateur($idCreateur);
        require "vue/afficherCreateurview.php";
    }
    public function gererAllCreateur(){
        //echo "StockControleur - gererAllAuteur<br>";
        $createurList = $this->createurDao->findAllCreateur();
        //Outils::afficherListObjet($auteurList, "ateurList");
        require "vue/gererCreateurview.php";
    }
    public function creerCreateurValidation(){
        //Outils::afficherTableau($_POST, "_POST");
        $createur = new Createur($_POST['nom'], $_POST['videographie']);
        echo "createur=".$createur."<br>";
        $this->createurDao->creerCreateur($createur);
        $this->gererAllCreateur(); 
    }
}
