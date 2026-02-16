<?php
class Ville {
    private $id;
    private $nom;
    private $id_region;

    public function __construct($id, $nom, $id_region) {
        $this->id = $id;
        $this->nom = $nom;
        $this->id_region = $id_region;
    }

    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }
    public function getIdRegion() { return $this->id_region; }
}