<?php
// Classe pour la table bngrc_don
class Don {
    private $id;
    private $id_type_don;
    private $quantite;
    private $date_saisie;

    public function __construct($id, $id_type_don, $quantite, $date_saisie) {
        $this->id = $id;
        $this->id_type_don = $id_type_don;
        $this->quantite = $quantite;
        $this->date_saisie = $date_saisie;
    }

    public function getId() { return $this->id; }
    public function getIdTypeDon() { return $this->id_type_don; }
    public function getQuantite() { return $this->quantite; }
    public function getDateSaisie() { return $this->date_saisie; }
}
