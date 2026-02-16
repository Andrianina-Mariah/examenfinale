<?php
require_once __DIR__ . '/../models/Ville.php';

class VilleRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function createVille($nom, $id_region) {
        $st = $this->pdo->prepare("INSERT INTO bngrc_ville (nom, id_region) VALUES (?, ?)");
        $st->execute([(string)$nom, (int)$id_region]);
        return $this->pdo->lastInsertId();
    }

    public function getAllVilles() {
        $st = $this->pdo->query("SELECT * FROM bngrc_ville");
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);
        $villes = [];
        foreach ($rows as $row) {
            $villes[] = new Ville($row['id'], $row['nom'], $row['id_region']);
        }
        return $villes;
    }

    public function getVilleById($id) {
        $st = $this->pdo->prepare("SELECT * FROM bngrc_ville WHERE id = ?");
        $st->execute([(int)$id]);
        $row = $st->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;
        return new Ville($row['id'], $row['nom'], $row['id_region']);
    }
}
