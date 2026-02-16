<?php
require_once __DIR__ . '/../models/Besoin.php';

class BesoinRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Création d'un nouveau besoin
    public function createBesoin($id_ville, $id_type_don, $quantite, $prix_unitaire, $date_saisie) {
        $st = $this->pdo->prepare("
            INSERT INTO bngrc_besoin (id_ville, id_type_don, quantite, prix_unitaire, date_saisie)
            VALUES (?, ?, ?, ?, ?)
        ");
        $st->execute([
            (int)$id_ville,
            (int)$id_type_don,
            (int)$quantite,
            (float)$prix_unitaire,
            $date_saisie
        ]);

        return $this->pdo->lastInsertId();
    }

    // Récupère tous les besoins d'une ville
    public function getBesoinByVille($id_ville) {
        $st = $this->pdo->prepare("SELECT * FROM bngrc_besoin WHERE id_ville = ?");
        $st->execute([(int)$id_ville]);
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);

        $besoins = [];
        foreach ($rows as $row) {
            // Calcul de la quantité restante
            $quantite_restante = $row['quantite'] - $this->getQuantiteAttribuee($row['id_ville'], $row['id_type_don']);

            $besoins[] = new Besoin(
                $row['id'],
                $row['id_ville'],
                $row['id_type_don'],
                $row['quantite'],
                $quantite_restante,
                $row['prix_unitaire'],
                $row['date_saisie']
            );
        }

        return $besoins;
    }

    // Récupère la somme totale des besoins pour une ville
    public function getTotalBesoinByVille($id_ville) {
        $st = $this->pdo->prepare("SELECT SUM(quantite) as total FROM bngrc_besoin WHERE id_ville = ?");
        $st->execute([(int)$id_ville]);
        return (int)$st->fetchColumn();
    }

    // Récupère le besoin restant pour une ville
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

    // Récupère tous les besoins avec la quantité déjà attribuée
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
                (
                    SELECT COALESCE(SUM(dp.quantite_attribuee), 0)
                    FROM bngrc_dispatch dp
                    JOIN bngrc_don d ON dp.id_don = d.id
                    WHERE dp.id_ville = b.id_ville 
                    AND d.id_type_don = b.id_type_don
                ) AS quantite_attribuee
            FROM bngrc_besoin b
            LEFT JOIN bngrc_type_don td ON b.id_type_don = td.id
            WHERE b.id_ville = ?
        ";

        $st = $this->pdo->prepare($sql);
        $st->execute([(int)$id_ville]);
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($rows as $row) {
            $quantite_restante = $row['besoin_quantite'] - (int)$row['quantite_attribuee'];

            $besoin = new Besoin(
                $row['besoin_id'],
                $row['id_ville'],
                $row['id_type_don'],
                $row['besoin_quantite'],
                $quantite_restante,
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

    // Récupère les besoins non satisfaits pour un type de don
    public function getBesoinsNonSatisfaitsParType($id_type_don) {
        $sql = "
            SELECT b.*, 
                (b.quantite - COALESCE((
                    SELECT SUM(dp.quantite_attribuee) 
                    FROM bngrc_dispatch dp 
                    JOIN bngrc_don d ON dp.id_don = d.id 
                    WHERE dp.id_ville = b.id_ville AND d.id_type_don = b.id_type_don
                ), 0)) as reste
            FROM bngrc_besoin b
            WHERE b.id_type_don = ?
            HAVING reste > 0
            ORDER BY b.date_saisie ASC, b.id ASC
        ";
        $st = $this->pdo->prepare($sql);
        $st->execute([(int)$id_type_don]);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fonction utilitaire pour récupérer la quantité déjà attribuée pour une ville et un type de don
    private function getQuantiteAttribuee($id_ville, $id_type_don) {
        $st = $this->pdo->prepare("
            SELECT COALESCE(SUM(dp.quantite_attribuee), 0) 
            FROM bngrc_dispatch dp
            JOIN bngrc_don d ON dp.id_don = d.id
            WHERE dp.id_ville = ? AND d.id_type_don = ?
        ");
        $st->execute([(int)$id_ville, (int)$id_type_don]);
        return (int)$st->fetchColumn();
    }
}
