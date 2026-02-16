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

    public function calculerSimulationComplete() {
        // 1. Besoins
        $sqlBesoins = "
            SELECT b.id, b.id_ville, v.nom as ville_nom, b.id_type_don, td.nom as type_nom,
            (b.quantite - 
                COALESCE((SELECT SUM(dp.quantite_attribuee) 
                        FROM bngrc_dispatch dp 
                        JOIN bngrc_don d ON dp.id_don = d.id 
                        WHERE d.id_type_don = b.id_type_don AND dp.id_ville = b.id_ville), 0) -
                COALESCE((SELECT SUM(ac.quantite_achetee) 
                        FROM bngrc_achat ac 
                        WHERE ac.id_type_don = b.id_type_don AND ac.id_ville = b.id_ville), 0)
            ) as reste_a_pourvoir
            FROM bngrc_besoin b
            JOIN bngrc_ville v ON b.id_ville = v.id
            JOIN bngrc_type_don td ON b.id_type_don = td.id
            HAVING reste_a_pourvoir > 0
            ORDER BY b.date_saisie ASC, b.id ASC";
        
        $besoins = $this->pdo->query($sqlBesoins)->fetchAll(PDO::FETCH_ASSOC);

        // 2. Dons
        $sqlDons = "
            SELECT d.id, d.id_type_don, 
            (d.quantite - COALESCE((SELECT SUM(dp.quantite_attribuee) FROM bngrc_dispatch dp WHERE dp.id_don = d.id), 0)) as stock_dispo
            FROM bngrc_don d
            WHERE d.montant IS NULL OR d.montant = 0
            HAVING stock_dispo > 0
            ORDER BY d.date_saisie ASC, d.id ASC";
        
        $dons = $this->pdo->query($sqlDons)->fetchAll(PDO::FETCH_ASSOC);

        $simulation_par_ville = [];
        $actions_a_enregistrer = [];

        foreach ($besoins as $b) {
            // CORRECTION ICI : on utilise 'reste_a_pourvoir' directement
            $reste_actuel = (int)$b['reste_a_pourvoir'];
            $initial_pour_cette_simul = $reste_actuel;
            $attribue = 0;

            foreach ($dons as &$d) {
                if ($d['id_type_don'] == $b['id_type_don'] && $d['stock_dispo'] > 0 && $reste_actuel > 0) {
                    $prendre = min($reste_actuel, $d['stock_dispo']);
                    
                    $attribue += $prendre;
                    $reste_actuel -= $prendre;
                    $d['stock_dispo'] -= $prendre;

                    $actions_a_enregistrer[] = [
                        'id_don' => $d['id'],
                        'id_ville' => $b['id_ville'],
                        'quantite' => $prendre
                    ];
                }
            }

            $simulation_par_ville[$b['ville_nom']][] = [
                'type_nom' => $b['type_nom'],
                'demande' => $initial_pour_cette_simul,
                'attribue' => $attribue,
                'reste' => $reste_actuel
            ];
        }

        return ['affichage' => $simulation_par_ville, 'actions' => $actions_a_enregistrer];
    }
}
