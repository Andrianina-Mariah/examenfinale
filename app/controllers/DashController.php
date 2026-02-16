<?php
class DashController {
  public static function DashBoard() {
      try {
      $pdo  = Flight::db();
      $repo = new VilleRepository($pdo);

        Flight::render('/accueil.php', [
        'villes' => $repo->getAllVilles(),
        'success' => false
        ]);
    } catch (Throwable $e) {
      http_response_code(500);
      Flight::json([
        'ok' => false,
        'errors' => [
          // '_global' => $e->getMessage().' '.$e->getFile().' '.$e->getLine()
          '_global' => 'Erreur serveur lors de la validation.'
        ],
        'values' => []
      ]);
    }
  }
}