<?php
require_once __DIR__ . '/../models/Besoin.php';

class BesoinRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Création d'un nouveau besoin
    public function createBesoin($id_ville, $id_type_don, $quantite, $prix_unitaire, $date_saisie, $montant = null) {
        $st = $this->pdo->prepare("
            INSERT INTO bngrc_besoin (id_ville, id_type_don, quantite, prix_unitaire, date_saisie, montant)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $st->execute([
            (int)$id_ville,
            (int)$id_type_don,
            $quantite !== null ? (int)$quantite : null,
            $prix_unitaire !== null ? (float)$prix_unitaire : null,
            $date_saisie,
            $montant !== null ? (float)$montant : null
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

    // public function getBesoinsRestantsPourAchat($id_ville = null) {
    //     $sql = "
    //         SELECT 
    //             b.id as besoin_id, b.id_ville, v.nom as ville_nom,
    //             td.nom as type_nom, b.prix_unitaire,
    //             -- Reste = Quantité initiale - (Dons directs) - (Achats déjà faits)
    //             (b.quantite - 
    //                 COALESCE((SELECT SUM(dp.quantite_attribuee) FROM bngrc_dispatch dp JOIN bngrc_don d ON dp.id_don = d.id WHERE d.id_type_don = b.id_type_don AND dp.id_ville = b.id_ville), 0) -
    //                 COALESCE((SELECT SUM(ac.quantite_achetee) FROM bngrc_achat ac WHERE ac.id_type_don = b.id_type_don AND ac.id_ville = b.id_ville), 0)
    //             ) as qte_restante,
    //             -- Vérifier si un stock physique existe encore (pour bloquer l'achat inutile)
    //             (SELECT COALESCE(SUM(d.quantite), 0) - COALESCE((SELECT SUM(dp.quantite_attribuee) FROM bngrc_dispatch dp WHERE dp.id_don = d.id), 0)
    //             FROM bngrc_don d WHERE d.id_type_don = b.id_type_don AND (d.montant IS NULL OR d.montant = 0)
    //             ) as stock_nature_dispo
    //         FROM bngrc_besoin b
    //         JOIN bngrc_ville v ON b.id_ville = v.id
    //         JOIN bngrc_type_don td ON b.id_type_don = td.id
    //         WHERE td.nom != 'Argent'
    //         HAVING qte_restante > 0
    //     ";
        
    //     if ($id_ville) $sql .= " AND b.id_ville = " . (int)$id_ville;
    //     $sql .= " ORDER BY b.date_saisie ASC";

    //     return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getBesoinsRestantsPourAchat($id_ville = null) {
        $sql = "
            SELECT 
                b.id as besoin_id, b.id_ville, v.nom as ville_nom,
                td.nom as type_nom, b.prix_unitaire,
                -- Reste = Besoin initial - Dispatchs directs - Achats par argent
                (b.quantite - 
                    COALESCE((SELECT SUM(dp.quantite_attribuee) FROM bngrc_dispatch dp JOIN bngrc_don d ON dp.id_don = d.id WHERE d.id_type_don = b.id_type_don AND dp.id_ville = b.id_ville), 0) -
                    COALESCE((SELECT SUM(ac.quantite_achetee) FROM bngrc_achat ac WHERE ac.id_type_don = b.id_type_don AND ac.id_ville = b.id_ville), 0)
                ) as qte_restante,
                -- Stock disponible en dons PHYSIQUES uniquement (montant IS NULL ou 0)
                (SELECT SUM(d.quantite) - COALESCE((SELECT SUM(dp.quantite_attribuee) FROM bngrc_dispatch dp WHERE dp.id_don = d.id), 0)
                FROM bngrc_don d 
                WHERE d.id_type_don = b.id_type_don AND (d.montant IS NULL OR d.montant = 0)
                ) as stock_nature_dispo
            FROM bngrc_besoin b
            JOIN bngrc_ville v ON b.id_ville = v.id
            JOIN bngrc_type_don td ON b.id_type_don = td.id
            WHERE td.nom != 'Argent'
            HAVING qte_restante > 0
        ";
        
        if ($id_ville) $sql .= " AND b.id_ville = " . (int)$id_ville;
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
