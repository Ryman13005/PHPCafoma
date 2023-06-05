<?php

class Createur {
    private $idCreateur;
    private $nom;
    private $videographie;
    function __construct($nom, $videographie) {
        $this->nom = $nom;
        $this->videographie = $videographie;
    }
    public function __toString() {
        return $this->idCreateur." ".$this->nom/*." ".$this->videographie.*/;
    }
    function getIdCreateur() {
        return $this->idCreateur;
    }

    function getNom() {
        return $this->nom;
    }

    function getVideographie() {
        return $this->videographie;
    }

    function setIdCreateur($idCreateur): void {
        $this->idCreateur = $idCreateur;
    }

    function setNom($nom): void {
        $this->nom = $nom;
    }

    function setVideographie($videographie): void {
        $this->videographie = $videographie;
    }
}