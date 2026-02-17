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

    public function getAllVillesWithRegion() {
        $sql = "
            SELECT 
                v.id AS ville_id, 
                v.nom AS ville_nom, 
                r.id AS region_id, 
                r.nom AS region_nom,
                COUNT(DISTINCT b.id) AS nombre_besoins,
                COALESCE(SUM(b.quantite), 0) AS total_quantite,
                COALESCE(SUM(d.quantite_attribuee), 0) AS total_recu
            FROM bngrc_ville v
            INNER JOIN bngrc_region r ON v.id_region = r.id
            LEFT JOIN bngrc_besoin b ON v.id = b.id_ville
            LEFT JOIN bngrc_dispatch d ON v.id = d.id_ville
            GROUP BY v.id, v.nom, r.id, r.nom
        ";
        $st = $this->pdo->query($sql);
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);

        $villes = [];
        foreach ($rows as $row) {
            $villes[] = [
                'ville' => new Ville($row['ville_id'], $row['ville_nom'], $row['region_id']),
                'region_nom' => $row['region_nom'],
                'nombre_besoins' => (int)$row['nombre_besoins'],
                'total_quantite' => (float)$row['total_quantite'],
                'total_recu' => (float)$row['total_recu']
            ];
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
