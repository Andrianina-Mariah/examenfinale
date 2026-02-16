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

// Classe pour la table bngrc_dispatch
class Dispatch {
    private $id;
    private $id_don;
    private $id_ville;
    private $quantite_attribuee;
    private $date_dispatch;

    public function __construct($id, $id_don, $id_ville, $quantite_attribuee, $date_dispatch) {
        $this->id = $id;
        $this->id_don = $id_don;
        $this->id_ville = $id_ville;
        $this->quantite_attribuee = $quantite_attribuee;
        $this->date_dispatch = $date_dispatch;
    }

    public function getId() { return $this->id; }
    public function getIdDon() { return $this->id_don; }
    public function getIdVille() { return $this->id_ville; }
    public function getQuantiteAttribuee() { return $this->quantite_attribuee; }
    public function getDateDispatch() { return $this->date_dispatch; }
}