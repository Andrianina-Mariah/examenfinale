<?php
// Classe pour la table bngrc_besoin
// class Besoin {
//     private $id;
//     private $id_ville;
//     private $id_type_don;
//     private $quantite;
//     private $prix_unitaire;
//     private $date_saisie;

//     public function __construct($id, $id_ville, $id_type_don, $quantite, $prix_unitaire, $date_saisie) {
//         $this->id = $id;
//         $this->id_ville = $id_ville;
//         $this->id_type_don = $id_type_don;
//         $this->quantite = $quantite;
//         $this->prix_unitaire = $prix_unitaire;
//         $this->date_saisie = $date_saisie;
//     }

//     public function getId() { return $this->id; }
//     public function getIdVille() { return $this->id_ville; }
//     public function getIdTypeDon() { return $this->id_type_don; }
//     public function getQuantite() { return $this->quantite; }
//     public function getPrixUnitaire() { return $this->prix_unitaire; }
//     public function getDateSaisie() { return $this->date_saisie; }
// }

class Besoin {
    private $id;
    private $id_ville;
    private $id_type_don;
    private $quantite;
    private $quantite_restante;
    private $prix_unitaire;
    private $date_saisie;
    private $montant;

    public function __construct(
        $id,
        $id_ville,
        $id_type_don,
        $quantite,
        $quantite_restante,
        $prix_unitaire,
        $date_saisie,
        $montant = null
    ) {
        $this->id = $id;
        $this->id_ville = $id_ville;
        $this->id_type_don = $id_type_don;
        $this->quantite = $quantite;
        $this->quantite_restante = $quantite_restante;
        $this->prix_unitaire = $prix_unitaire;
        $this->date_saisie = $date_saisie;
        $this->montant = $montant;
    }

    public function getId() { return $this->id; }
    public function getIdVille() { return $this->id_ville; }
    public function getIdTypeDon() { return $this->id_type_don; }
    public function getQuantite() { return $this->quantite; }
    public function getQuantiteRestante() { return $this->quantite_restante; }
    public function getPrixUnitaire() { return $this->prix_unitaire; }
    public function getDateSaisie() { return $this->date_saisie; }
    public function getMontant() { return $this->montant; }
    public function isArgent() { return $this->montant !== null && $this->quantite === null; }
}
