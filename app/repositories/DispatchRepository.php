<?php
require_once __DIR__ . '/../models/Dispatch.php';

class DispatchRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Créer un dispatch
    public function createDispatch($id_don, $id_ville, $quantite_attribuee, $date_dispatch) {
        $st = $this->pdo->prepare("
            INSERT INTO bngrc_dispatch (id_don, id_ville, quantite_attribuee, date_dispatch)
            VALUES (?, ?, ?, ?)
        ");
        $st->execute([
            (int)$id_don,
            (int)$id_ville,
            (int)$quantite_attribuee,
            $date_dispatch
        ]);
        return $this->pdo->lastInsertId();
    }

    // Récupérer tous les dispatchs
    public function getAllDispatchs() {
        $st = $this->pdo->query("SELECT * FROM bngrc_dispatch");
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);
        $dispatchs = [];
        foreach ($rows as $row) {
            $dispatchs[] = new Dispatch(
                $row['id'],
                $row['id_don'],
                $row['id_ville'],
                $row['quantite_attribuee'],
                $row['date_dispatch']
            );
        }
        return $dispatchs;
    }

    // Récupérer tous les dispatchs pour une ville donnée
    public function getDispatchByVille($id_ville) {
        $st = $this->pdo->prepare("SELECT * FROM bngrc_dispatch WHERE id_ville = ?");
        $st->execute([(int)$id_ville]);
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);
        $dispatchs = [];
        foreach ($rows as $row) {
            $dispatchs[] = new Dispatch(
                $row['id'],
                $row['id_don'],
                $row['id_ville'],
                $row['quantite_attribuee'],
                $row['date_dispatch']
            );
        }
        return $dispatchs;
    }

    // Récupérer tous les dispatchs pour un don donné
    public function getDispatchByDon($id_don) {
        $st = $this->pdo->prepare("SELECT * FROM bngrc_dispatch WHERE id_don = ?");
        $st->execute([(int)$id_don]);
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);
        $dispatchs = [];
        foreach ($rows as $row) {
            $dispatchs[] = new Dispatch(
                $row['id'],
                $row['id_don'],
                $row['id_ville'],
                $row['quantite_attribuee'],
                $row['date_dispatch']
            );
        }
        return $dispatchs;
    }
}
