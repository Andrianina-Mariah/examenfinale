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
}
