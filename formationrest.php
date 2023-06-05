<?php
require_once "./model/FormationDaoClass.php"; 
require_once "./model/CreateurDaoClass.php"; 

$formationDao = FormationDao::getInstance();
$createurDao = CreateurDao::getInstance();

if(isset($_GET["operation"])){
    if($_GET["operation"]=="lister"){
        try{
            //echo "LISTER<br>";
            $formations=$formationDao->findAllFormation();
            //Outils::afficherTableau($livres, "livres");
            //var_dump($livres[0]->jsonSerialize());
            print("lister#");
            print(json_encode($formations));
        }catch(PDOException $e){
            print "erreur#".$e->getMessage();
        }
    }
}