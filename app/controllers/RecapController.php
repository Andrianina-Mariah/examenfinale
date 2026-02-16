<?php
class RecapController {
    public static function index() {
        Flight::render('front/modele.php', ['var' => 'recapitulatif.php']);
    }

    public static function apiStats() {
        $repo = new StatRepository(Flight::db());
        $global = $repo->getGlobalStats();
        $villes = $repo->getStatsParVille();
        
        // On renvoie tout en JSON pour le JavaScript
        Flight::json([
            'global' => $global,
            'villes' => $villes
        ]);
    }
}