<?php
class Achat {
    private $id;
    private $id_ville;
    private $id_type_don;
    private $quantite;
    private $prix_unitaire;
    private $frais_pourcentage;
    private $montant_total;
    private $date_achat;

    public function __construct(
        $id,
        $id_ville,
        $id_type_don,
        $quantite,
        $prix_unitaire,
        $frais_pourcentage,
        $montant_total,
        $date_achat
    ) {
        $this->id = $id;
        $this->id_ville = $id_ville;
        $this->id_type_don = $id_type_don;
        $this->quantite = $quantite;
        $this->prix_unitaire = $prix_unitaire;
        $this->frais_pourcentage = $frais_pourcentage;
        $this->montant_total = $montant_total;
        $this->date_achat = $date_achat;
    }

    public function getId() { return $this->id; }
    public function getIdVille() { return $this->id_ville; }
    public function getIdTypeDon() { return $this->id_type_don; }
    public function getQuantite() { return $this->quantite; }
    public function getPrixUnitaire() { return $this->prix_unitaire; }
    public function getFraisPourcentage() { return $this->frais_pourcentage; }
    public function getMontantTotal() { return $this->montant_total; }
    public function getDateAchat() { return $this->date_achat; }
}
