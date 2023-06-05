<?php
require_once "ConnexionClass.php";
require_once "FormationClass.php";
require_once "CreateurDaoClass.php";

class FormationDao extends Connexion {
    private static $_instance = null;
    private $createurDao;


    private function __construct() {
        $this->createurDao = CreateurDao::getInstance();
     
    }
    
    public static function getInstance() {
        if(is_null(self::$_instance)) {
            self::$_instance = new FormationDao();  
        }
        return self::$_instance;
    }

    function findAllFormation(){
        $stmt = $this->getBdd()->prepare("SELECT * FROM formations");
        $stmt->execute();
        $bddFormations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $formations = null;
        foreach($bddFormations as $formation){
            $l=new Formation($formation['id'], $formation['titre'],$formation['image'], $formation['description']);
          
            $formations[]=$l;
        }
        return $formations;
    }

    function findOneFormationById($id){
        $stmt = $this->getBdd()->prepare("SELECT * FROM formations WHERE id=:id");
        $stmt->bindValue(":id",$id,PDO::PARAM_STR);
        $cpt = $stmt->execute();
        $formation = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();  
        $formations = null;
        //echo "id=".$id."<br>";
        $l=new Formation($formation['id'], $formation['titre'], $formation['image'], $formation['description'],);
        
        $createur = $this->createurDao->findCreateurByIdCreateur($formation['idCreateur']);
        $l->setCreateur($createur);
        
        
        return $l;
        return $formations;
    }

    function findAllInscriptionsByLogin($login){
        $stmt = $this->getBdd()->prepare(
        "SELECT f.id, f.titre, f.image, f.description, f.idCreateur
        FROM formations AS f 
        WHERE f.id IN (SELECT fi.id 
        FROM formation_inscription AS fi
        WHERE fi.login = login)");

       
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $bddFormations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $formations = null;
        foreach($bddFormations as $f){
            $formation=new Formation($f['id'], $f['titre'], $f['image'],$f['description'], $f['idCreateur']);
            $formations[]=$formation;
        }
        return $formations;
    }

    function creerFormation($titre,$image,$nb,$description){
        $pdo = $this->getBdd();
        $req = "
        INSERT INTO formations (titre, nb, image, description)
        values (:titre, :image, :description)";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":titre",$titre,PDO::PARAM_STR);
        $stmt->bindValue(":image",$image,PDO::PARAM_STR);
        $stmt->bindValue(":description",$description,PDO::PARAM_STR);
        $stmt->bindValue(":nb",$nb,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat > 0){
            echo "formation insérer id=".$pdo->lastInsertId()."<br>";
        }        
    }

    function creerInscription($id, $login, $date_inscription){
        $pdo = $this->getBdd();   
        $req = "
        INSERT INTO formation_inscription(id, login, date_inscription)
        values (:id, :login, :date_inscription)";
        
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":id",$id,PDO::PARAM_INT);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->bindValue(":date_inscription",$date_inscription,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat > 0){
            return $pdo->lastInsertId()."<br>";
            
        }
        return false;
    }

    function supprimerInscription($id, $login){
        $pdo = $this->getBdd();   
        $req = "
        DELETE from formation_inscription
        WHERE id=:id and login=:login";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":id",$id,PDO::PARAM_INT);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);

        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat > 0){
            return $pdo->lastInsertId()."<br>";
            
        }
        return false;
    }
    function supprimerFormation($id){
        $pdo = $this->getBdd();
        
        $req = "Delete from formations where id = :idFormation";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":idFormation",$id,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat > 0){
            echo "formation supprimer id=".$id."<br>";
        }
    }
    function supprimerAllFormation(){
        $pdo = $this->getBdd();
        $req = "Delete from formations";
        $stmt = $pdo->prepare($req);
        $nbr = $stmt->execute();
        return $nbr;
    }
    function modifierFormation($id,$titre,$image, $nb, $description){
        $pdo = $this->getBdd();
        $req = "
        update formations 
        set titre = :titre, image = :image, description = :description
        where id = :id";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":id",$id,PDO::PARAM_INT);
        $stmt->bindValue(":titre",$titre,PDO::PARAM_STR);
        $stmt->bindValue(":image",$image,PDO::PARAM_STR);
        $stmt->bindValue(":description",$description,PDO::PARAM_STR);

        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            echo "formation modifier id=".$id."<br>";
        }
    }
    function decrementerNbFormation($idFormation){
        //Update Matable Set MonChamp=Monchamp-1 where Macle=ValeurQuiVaBien
        $pdo = $this->getBdd();
        $req = "
        update formations 
        set nb = nb - 1
        where id = :id";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":id",$idFormation,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();       
        if($resultat > 0){
            echo "formation modifier id=".$idFormation."<br>";
        }
    }
    function incrementerNbFormation($idFormation){
        //Update Matable Set MonChamp=Monchamp-1 where Macle=ValeurQuiVaBien
        $pdo = $this->getBdd();
        $req = "
        update formations 
        set nb = nb + 1
        where id = :id";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":id",$idFormation,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();       
        if($resultat > 0){
            echo "formation modifier id=".$idFormation."<br>";
        }
    }
    function findTitreFormationById($idFormation){ 
        $stmt = $this->getBdd()->prepare(
            "SELECT titre FROM formations WHERE id= :idFormation");
        $stmt->bindValue(":idFormation",$idFormation,PDO::PARAM_INT);
        $nb = $stmt->execute();
        //echo "nb=".$nb."<br>";
        $imageBd = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();  
        return $imageBd['titre'];
    }
    
    function findAllFormationByIdCreateur($idCreateur){
        $stmt = $this->getBdd()->prepare(
            "SELECT * FROM formations WHERE idCreateur = :idCreateur");
        $stmt->bindValue(":idCreateur",$idCreateur,PDO::PARAM_INT);
        $nb = $stmt->execute();
        //echo "nb=".$nb."<br>";
        $FormationListBd = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        if(isset($FormationListBd) && !empty($FormationListBd)){
            foreach($FormationListBd as $formationBd){
                $formation = new Formation($formationBd['id'], $formationBd['titre'], $formationBd['image'], $formationBd['description']);
                //echo "LivreDao - findAllLivre - l=".$l." livre[idLivre]=".$livre['idLivre']."<br>";
                //$livre->setIdLivre($livreBd['idLivre']);
                $this->formations[]=$formation;
            }
            return $this->formations;
        }
        else {
            return null;
        }
    }



} // FIN CLASS FormationDao
