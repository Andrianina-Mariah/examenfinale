<?php
require_once __DIR__ . '/../models/Don.php';

class DonRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Création don nature ou argent
    public function createDon($id_type_don, $type_categorie, $quantite, $montant, $date_saisie) {
        // Si type = argent, on remplit montant et montant_restant, quantite = null
        if ($type_categorie === 'argent') {
            $montant_restant = $montant;
            $quantite_to_insert = null;
            $montant_to_insert = (float)$montant;
            $montant_restant_to_insert = (float)$montant_restant;
        } else {
            // Si type ≠ argent, on remplit quantite, montant = 0
            $quantite_to_insert = (int)$quantite;
            $montant_to_insert = 0;
            $montant_restant_to_insert = 0;
        }

        $st = $this->pdo->prepare("
            INSERT INTO bngrc_don (id_type_don, quantite, montant, montant_restant, date_saisie)
            VALUES (?, ?, ?, ?, ?)
        ");

        $st->execute([
            (int)$id_type_don,
            $quantite_to_insert,
            $montant_to_insert,
            $montant_restant_to_insert,
            $date_saisie
        ]);

        return $this->pdo->lastInsertId();
    }

    public function getAllDons() {
        $st = $this->pdo->query("SELECT * FROM bngrc_don");
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);

        $dons = [];
        foreach ($rows as $row) {
            $dons[] = new Don(
                $row['id'],
                $row['id_type_don'],
                $row['quantite'],
                $row['montant'],
                $row['montant_restant'],
                $row['date_saisie']
            );
        }
        return $dons;
    }

    // Dons argent encore disponibles
    public function getDonsArgentDisponibles() {
        $st = $this->pdo->prepare("
            SELECT * FROM bngrc_don
            WHERE montant_restant IS NOT NULL
            AND montant_restant > 0
            ORDER BY date_saisie ASC, id ASC
        ");
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateMontantRestant($id_don, $nouveau_montant) {
        $st = $this->pdo->prepare("
            UPDATE bngrc_don
            SET montant_restant = ?
            WHERE id = ?
        ");
        $st->execute([(float)$nouveau_montant, (int)$id_don]);
    }
    public function getDonsDisponiblesParType($id_type_don) { 
        $sql = " SELECT d.*, (d.quantite - COALESCE(( SELECT SUM(dp.quantite_attribuee) FROM bngrc_dispatch dp WHERE dp.id_don = d.id ), 0)) as stock_restant FROM bngrc_don d WHERE d.id_type_don = ? HAVING stock_restant > 0 ORDER BY d.date_saisie ASC, d.id ASC "; 
        $st = $this->pdo->prepare($sql); 
        $st->execute([(int)$id_type_don]); 
        return $st->fetchAll(PDO::FETCH_ASSOC); 
    } 
}
