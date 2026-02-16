<?php
class SimulationController {
    public static function index() {
        Flight::render('front/modele.php', [
            'var' => 'simulation.php',
            'villes_simulees' => [] 
        ]);
    }

    public static function lancer() {
        $repo = new DispatchRepository(Flight::db());
        $simul = $repo->calculerSimulationComplete();

        if (session_status() === PHP_SESSION_NONE) session_start();
        // On stocke les actions pour la validation réelle en BDD
        $_SESSION['actions_dispatch'] = $simul['actions'];

        Flight::render('front/modele.php', [
            'var' => 'simulation.php',
            'villes_simulees' => $simul['affichage']
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
            Flight::redirect('/achats/besoins'); 
        } catch (Exception $e) {
            $pdo->rollBack();
            Flight::halt(500, $e->getMessage());
        }
    }
}