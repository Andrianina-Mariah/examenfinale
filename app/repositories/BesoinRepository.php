<?php
require_once __DIR__ . '/../models/Besoin.php';

class BesoinRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function createBesoin($id_ville, $id_type_don, $quantite, $prix_unitaire, $date_saisie) {
        $st = $this->pdo->prepare("
            INSERT INTO bngrc_besoin (id_ville, id_type_don, quantite, prix_unitaire, date_saisie)
            VALUES (?, ?, ?, ?, ?)
        ");
        $st->execute([(int)$id_ville, (int)$id_type_don, (int)$quantite, (float)$prix_unitaire, $date_saisie]);
        return $this->pdo->lastInsertId();
    }

    public function getBesoinByVille($id_ville) {
        $st = $this->pdo->prepare("SELECT * FROM bngrc_besoin WHERE id_ville = ?");
        $st->execute([(int)$id_ville]);
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);
        $besoins = [];
        foreach ($rows as $row) {
            $besoins[] = new Besoin(
                $row['id'],
                $row['id_ville'],
                $row['id_type_don'],
                $row['quantite'],
                $row['prix_unitaire'],
                $row['date_saisie']
            );
        }
        return $besoins;
    }

    public function getTotalBesoinByVille($id_ville) {
        $st = $this->pdo->prepare("SELECT SUM(quantite) as total FROM bngrc_besoin WHERE id_ville = ?");
        $st->execute([(int)$id_ville]);
        return (int)$st->fetchColumn();
    }

    public function getBesoinRestantByVille($id_ville) {
        $st = $this->pdo->prepare("
            SELECT SUM(quantite) - COALESCE((SELECT SUM(quantite_attribuee) 
                                            FROM bngrc_dispatch 
                                            WHERE id_ville = ?), 0) AS restant
            FROM bngrc_besoin
            WHERE id_ville = ?
        ");
        $st->execute([(int)$id_ville, (int)$id_ville]);
        return (int)$st->fetchColumn();
    }

    public function getBesoinAvecDispatchParVille($id_ville) {
        $sql = "
            SELECT 
                b.id AS besoin_id,
                b.id_ville,
                b.id_type_don,
                b.quantite AS besoin_quantite,
                b.prix_unitaire,
                b.date_saisie AS besoin_date,
                td.nom AS type_nom,
                COALESCE(SUM(d.quantite_attribuee), 0) AS quantite_attribuee
            FROM bngrc_besoin b
            LEFT JOIN bngrc_type_don td ON b.id_type_don = td.id
            LEFT JOIN bngrc_dispatch d 
                ON d.id_ville = b.id_ville
            WHERE b.id_ville = ?
            GROUP BY b.id
        ";

        $st = $this->pdo->prepare($sql);
        $st->execute([(int)$id_ville]);
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);

        $result = [];

        foreach ($rows as $row) {
            $besoin = new Besoin(
                $row['besoin_id'],
                $row['id_ville'],
                $row['id_type_don'],
                $row['besoin_quantite'],
                $row['prix_unitaire'],
                $row['besoin_date']
            );

            $result[] = [
                'besoin' => $besoin,
                'type_nom' => $row['type_nom'],
                'quantite_attribuee' => (int)$row['quantite_attribuee']
            ];
        }

        return $result;
    }

}
