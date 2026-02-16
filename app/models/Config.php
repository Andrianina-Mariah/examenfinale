<?php
class Config {
    private $id;
    private $frais_pourcentage;

    public function __construct($id, $frais_pourcentage) {
        $this->id = $id;
        $this->frais_pourcentage = $frais_pourcentage;
    }

    public function getId() { return $this->id; }
    public function getFraisPourcentage() { return $this->frais_pourcentage; }
}
