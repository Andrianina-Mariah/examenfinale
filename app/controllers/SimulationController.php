<?php
class SimulationController {
    public static function index() {
        Flight::render('front/modele.php', [
            'var' => 'simulation.php',
            'villes_simulees' => [],
            'mode_actuel' => null
        ]);
    }

    public static function lancer() {
        $db = Flight::db();
        $repo = new DispatchRepository($db);
        $mode = Flight::request()->data->mode ?? 'fifo';

        // Choix de l'algorithme
        if ($mode === 'petit_besoin') {
            $simul = $repo->calculerSimulationPrioritePetitBesoin();
            $label = "Priorité aux petits besoins";
        } elseif ($mode === 'proportionnel') {
            $simul = $repo->calculerSimulationProportionnelle();
            $label = "Répartition proportionnelle";
        } else {
            $simul = $repo->calculerSimulationFIFO();
            $label = "Premier arrivé, premier servi (FIFO)";
        }

        if (session_status() === PHP_SESSION_NONE) session_start();
        $_SESSION['actions_dispatch'] = $simul['actions'];

        Flight::render('front/modele.php', [
            'var' => 'simulation.php',
            'villes_simulees' => $simul['affichage'],
            'mode_actuel' => $label
        ]);
    }

    public static function valider() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $actions = $_SESSION['actions_dispatch'] ?? [];

        if (empty($actions)) {
            Flight::redirect('/simulation');
            return;
        }

        $pdo = Flight::db();
        $pdo->beginTransaction();
        try {
            $st = $pdo->prepare("INSERT INTO bngrc_dispatch (id_don, id_ville, quantite_attribuee, date_dispatch) VALUES (?, ?, ?, NOW())");
            foreach ($actions as $a) {
                $st->execute([$a['id_don'], $a['id_ville'], $a['quantite']]);
            }
            $pdo->commit();
            unset($_SESSION['actions_dispatch']);
            Flight::redirect('/simulation?success=1'); 
        } catch (Exception $e) {
            $pdo->rollBack();
            Flight::halt(500, "Erreur lors de la validation : " . $e->getMessage());
        }
    }
}