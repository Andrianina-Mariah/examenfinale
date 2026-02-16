<?php

// Classe pour la table bngrc_region
class Region {
    private $id;
    private $nom;

    public function __construct($id, $nom) {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }
}