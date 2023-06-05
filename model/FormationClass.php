<?php
class Formation implements JsonSerializable {
    private $id;
    private $titre;
    private $image;
    private $description;
    private $createur;


    function __construct($id, $titre, $image, $description) {
        $this->id = $id;
        $this->titre = $titre;
        $this->image = $image;
            $this->description = $description;
    }
    public function __toString() {
        return "id=".$this->id." titre=".$this->titre." image=".$this->image;
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id->getId(),
            'titre' => $this->titre->getTitre(),
             'image' => $this->image->getImage(),
            'createur' => $this->createur->getNom(),
            'idCreateur' => $this->createur->getCreateur(),
            'description' => $this->description->getDescription(),
        ];
    }
    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}

    public function getTitre(){return $this->titre;}
    public function setTitre($titre){$this->titre = $titre;}

    public function getImage(){return $this->image;}
    public function setImage($image){$this->image = $image;}
    
    public function getDescription(){return $this->description;}
    public function setDescription($description){$this->description = $description;}
    
    function getCreateur() {return $this->createur;}
    function setCreateur($createur): void { $this->createur = $createur;}

   
}