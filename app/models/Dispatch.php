<?php

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
