<?php
// Classe pour la table bngrc_don
// class Don {
//     private $id;
//     private $id_type_don;
//     private $quantite;
//     private $date_saisie;

//     public function __construct($id, $id_type_don, $quantite, $date_saisie) {
//         $this->id = $id;
//         $this->id_type_don = $id_type_don;
//         $this->quantite = $quantite;
//         $this->date_saisie = $date_saisie;
//     }

//     public function getId() { return $this->id; }
//     public function getIdTypeDon() { return $this->id_type_don; }
//     public function getQuantite() { return $this->quantite; }
//     public function getDateSaisie() { return $this->date_saisie; }
// }

class Don {
    private $id;
    private $id_type_don;
    private $quantite;
    private $montant;
    private $montant_restant;
    private $date_saisie;

    public function __construct(
        $id,
        $id_type_don,
        $quantite,
        $montant,
        $montant_restant,
        $date_saisie
    ) {
        $this->id = $id;
        $this->id_type_don = $id_type_don;
        $this->quantite = $quantite;
        $this->montant = $montant;
        $this->montant_restant = $montant_restant;
        $this->date_saisie = $date_saisie;
    }

    public function getId() { return $this->id; }
    public function getIdTypeDon() { return $this->id_type_don; }
    public function getQuantite() { return $this->quantite; }
    public function getMontant() { return $this->montant; }
    public function getMontantRestant() { return $this->montant_restant; }
    public function getDateSaisie() { return $this->date_saisie; }

    public function setMontantRestant($montant_restant) {
        $this->montant_restant = $montant_restant;
    }
}
