<?php
require_once __DIR__ . '/../models/Don.php';

class DonRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Création don nature ou argent
    public function createDon($id_type_don, $quantite, $montant, $date_saisie) {
        $st = $this->pdo->prepare("
            INSERT INTO bngrc_don (id_type_don, quantite, montant, montant_restant, date_saisie)
            VALUES (?, ?, ?, ?, ?)
        ");

        $montant_restant = $montant;

        $st->execute([
            (int)$id_type_don,
            $quantite ? (int)$quantite : null,
            $montant ? (float)$montant : null,
            $montant ? (float)$montant_restant : null,
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
}
