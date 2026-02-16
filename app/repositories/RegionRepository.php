<?php
require_once __DIR__ . '/../models/Region.php';

class RegionRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function createRegion($nom) {
        $st = $this->pdo->prepare("INSERT INTO bngrc_region (nom) VALUES (?)");
        $st->execute([(string)$nom]);
        return $this->pdo->lastInsertId();
    }

    public function getAllRegions() {
        $st = $this->pdo->query("SELECT * FROM bngrc_region");
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);
        $regions = [];
        foreach ($rows as $row) {
            $regions[] = new Region($row['id'], $row['nom']);
        }
        return $regions;
    }
}
