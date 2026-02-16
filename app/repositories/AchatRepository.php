<?php
require_once __DIR__ . '/../models/Achat.php';

class AchatRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function createAchat(
        $id_ville,
        $id_type_don,
        $quantite,
        $prix_unitaire,
        $frais_pourcentage,
        $montant_total,
        $date_achat
    ) {
        $st = $this->pdo->prepare("
            INSERT INTO bngrc_achat 
            (id_ville, id_type_don, quantite_achetee, prix_unitaire, frais_pourcentage, montant_total, date_achat)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        $st->execute([
            (int)$id_ville,
            (int)$id_type_don,
            (int)$quantite,
            (float)$prix_unitaire,
            (float)$frais_pourcentage,
            (float)$montant_total,
            $date_achat
        ]);

        return $this->pdo->lastInsertId();
    }

    public function getAchatsParVille($id_ville) {
        $st = $this->pdo->prepare("
            SELECT * FROM bngrc_achat
            WHERE id_ville = ?
            ORDER BY date_achat DESC
        ");
        $st->execute([(int)$id_ville]);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalAchatMontantParVille($id_ville) {
        $st = $this->pdo->prepare("
            SELECT COALESCE(SUM(montant_total),0)
            FROM bngrc_achat
            WHERE id_ville = ?
        ");
        $st->execute([(int)$id_ville]);
        return (float)$st->fetchColumn();
    }
}
