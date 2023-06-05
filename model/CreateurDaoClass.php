<?php
require_once "ConnexionClass.php";
require_once "CreateurClass.php";
require_once "./outil/OutilClass.php";

class CreateurDao extends Connexion {
    private static $_instance = null;
    //private $themeDao;
    private function __construct() {}
    public static function getInstance() {
        if(is_null(self::$_instance)) {
            self::$_instance = new CreateurDao();  
        }
        return self::$_instance;
    }
    public function findAllCreateur(){
        $stmt = $this->getBdd()->prepare(
            "SELECT * FROM createur");
    
        //echo "nb=".$nb."<br>";
        $createurListBd = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        foreach($createurListBd as $createurBd){
            $createur = new Createur($createurBd['nom'], $createurBd['videographie']);
            //echo "LivreDao - findAllLivre - l=".$l." livre[idLivre]=".$livre['idLivre']."<br>";
            $createur->setIdCreateur($createurBd['idCreateur']);
            $createurList[]=$createur;
        }
        return;
    }
    function findCreateurByIdCreateur($idCreateur){ 
        //echo "idAuteur=".$idAuteur."<br>";
        $stmt = $this->getBdd()->prepare(
            "SELECT * FROM createur WHERE idCreateur = :idCreateur");
        $stmt->bindValue(":idCreateur",$idCreateur,PDO::PARAM_INT);
        $nb = $stmt->execute();
        //echo "nb=".$nb."<br>";
        $createurBd = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();  
        $createur = new Createur($createurBd['nom'], $createurBd['videographie']);
        $createur->setIdCreateur($createurBd['idCreateur']);
        return $createur;
    }
    public function creerCreateur($createur){
        echo "creerCreateur - createur=".$createur."<br>";
        $pdo = $this->getBdd();
        $req = "
            INSERT INTO createur (nom, videographie)
            VALUES (:nom, :videographie)";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":nom",$createur->getNom(),PDO::PARAM_STR);
        $stmt->bindValue(":videographie",$createur->getVideographie(),PDO::PARAM_STR);        
        $nb = $stmt->execute();
        echo "lastInsertId=".$pdo->lastInsertId()."<br>";
        echo "nb=".$nb."<br>";
        $stmt->closeCursor();
        if($nb > 0){
            return $pdo->lastInsertId();
        }
        return false;
    }
    
}
