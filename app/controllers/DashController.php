<?php
class DashController {
  public static function DashBoard() {
      try {
      $pdo  = Flight::db();
      $repo = new VilleRepository($pdo);

        Flight::render('front/modele.php', [
            'var' => 'accueil.php',
            'villes' => $repo->getAllVillesWithRegion()
        ]);
    } catch (Throwable $e) {
      http_response_code(500);
      Flight::json([
        'ok' => false,
        'errors' => [
          '_global' => $e->getMessage().' '.$e->getFile().' '.$e->getLine()
        //   '_global' => 'Erreur serveur lors de la validation.'
        ],
        'values' => []
      ]);
    }
  }

  public static function Details($id) {
        try {
            $pdo = Flight::db();

            $villeRepo  = new VilleRepository($pdo);
            $besoinRepo = new BesoinRepository($pdo);

            $ville   = $villeRepo->getVilleById($id);
            $besoins = $besoinRepo->getBesoinAvecDispatchParVille($id);

            Flight::render('front/modele.php', [
                'var' => 'VilleDetails.php',
                'ville' => $ville,
                'besoins' => $besoins
            ]);

        } catch (Throwable $e) {
            http_response_code(500);
            Flight::json([
                'ok' => false,
                'errors' => [
                    '_global' => $e->getMessage().' '.$e->getFile().' '.$e->getLine()
                ]
            ]);
        }
    }


  public static function form() {
        try {
            Flight::render('front/modele.php', [
                'var' => 'formulaireBesoin.php'
            ]);

        } catch (Throwable $e) {
            http_response_code(500);
            Flight::json([
                'ok' => false,
                'errors' => [
                    '_global' => $e->getMessage().' '.$e->getFile().' '.$e->getLine()
                ]
            ]);
        }
    }
    /* ── V2 ── */

    public static function achatBesoins() {
        try {
            Flight::render('front/modele.php', [
                'var' => 'achat_besoins.php'
            ]);
        } catch (Throwable $e) {
            http_response_code(500);
            Flight::json(['ok' => false, 'errors' => ['_global' => $e->getMessage().' '.$e->getFile().' '.$e->getLine()]]);
        }
    }

    public static function simulation() {
        try {
            Flight::render('front/modele.php', [
                'var' => 'simulation.php'
            ]);
        } catch (Throwable $e) {
            http_response_code(500);
            Flight::json(['ok' => false, 'errors' => ['_global' => $e->getMessage().' '.$e->getFile().' '.$e->getLine()]]);
        }
    }

    public static function recapitulatif() {
        try {
            Flight::render('front/modele.php', [
                'var' => 'recapitulatif.php'
            ]);
        } catch (Throwable $e) {
            http_response_code(500);
            Flight::json(['ok' => false, 'errors' => ['_global' => $e->getMessage().' '.$e->getFile().' '.$e->getLine()]]);
        }
    }
}