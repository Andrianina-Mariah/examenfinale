<?php
require_once __DIR__ . '/../models/Don.php';

class DonRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function createDon($id_type_don, $quantite, $date_saisie) {
        $st = $this->pdo->prepare("
            INSERT INTO bngrc_don (id_type_don, quantite, date_saisie)
            VALUES (?, ?, ?)
        ");
        $st->execute([(int)$id_type_don, (int)$quantite, $date_saisie]);
        return $this->pdo->lastInsertId();
    }

    public function getAllDons() {
        $st = $this->pdo->query("SELECT * FROM bngrc_don");
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);
        $dons = [];
        foreach ($rows as $row) {
            $dons[] = new Don($row['id'], $row['id_type_don'], $row['quantite'], $row['date_saisie']);
        }
        return $dons;
    }

    public function getDonsDisponiblesParType($id_type_don) {
        $sql = "
            SELECT d.*, 
                (d.quantite - COALESCE((
                    SELECT SUM(dp.quantite_attribuee) 
                    FROM bngrc_dispatch dp 
                    WHERE dp.id_don = d.id
                ), 0)) as stock_restant
            FROM bngrc_don d
            WHERE d.id_type_don = ?
            HAVING stock_restant > 0
            ORDER BY d.date_saisie ASC, d.id ASC
        ";
        $st = $this->pdo->prepare($sql);
        $st->execute([(int)$id_type_don]);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
}
