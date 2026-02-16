<?php
// Classe pour la table bngrc_type_don
class TypeDon {
    private $id;
    private $nom;
    private $id_categorie;

    public function __construct($id, $nom, $id_categorie) {
        $this->id = $id;
        $this->nom = $nom;
        $this->id_categorie = $id_categorie;
    }

    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }
    public function getIdCategorie() { return $this->id_categorie; }
}

