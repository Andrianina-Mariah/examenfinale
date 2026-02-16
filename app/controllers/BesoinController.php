<?php
class BesoinController {

    // Affiche le formulaire avec les données nécessaires
    public static function form() {
        try {
            $pdo = Flight::db();

            // Initialisation des Repositories
            $villeRepo = new VilleRepository($pdo);
            $typeRepo  = new TypeDonRepository($pdo);
            $catRepo   = new CategorieRepository($pdo);

            // Récupération des données pour les listes déroulantes
            $villes     = $villeRepo->getAllVilles();
            $types      = $typeRepo->getAllTypes();
            $categories = $catRepo->getAllCategories();

            Flight::render('front/modele.php', [
                'var'        => 'formulaireBesoin.php',
                'villes'     => $villes,
                'types'      => $types,
                'categories' => $categories,
                'title'      => 'Saisie des Besoins'
            ]);

        } catch (Throwable $e) {
            self::handleError($e);
        }
    }

    public static function enregistrer() {
        try {
            $pdo = Flight::db();
            $data = Flight::request()->data;

            $typeRepo = new TypeDonRepository($pdo);
            $besoinRepo = new BesoinRepository($pdo);
            $donRepo = new DonRepository($pdo);
            $dispatchRepo = new DispatchRepository($pdo);

            $id_type_don = $data->id_type_don;

            // 1. Gestion nouveau type (si applicable au formulaire de besoin)
            if (!empty($data->nouveau_type_nom)) {
                $id_type_don = $typeRepo->createTypeDon($data->nouveau_type_nom, $data->id_categorie_nouveau);
            }

            // 2. Création du besoin initial
            $besoinRepo->createBesoin(
                $data->id_ville,
                $id_type_don,
                $data->quantite,
                $data->prix_unitaire,
                $data->date_saisie
            );
            
            // --- LOGIQUE DE SATISFACTION IMMÉDIATE DU BESOIN ---
            $quantiteBesoinRestante = (int)$data->quantite;
            $id_ville = (int)$data->id_ville;
            $dateAujourdhui = date('Y-m-d');

            // Récupérer les dons disponibles pour ce produit (le plus vieux don en premier)
            $donsDispos = $donRepo->getDonsDisponiblesParType($id_type_don);

            foreach ($donsDispos as $don) {
                if ($quantiteBesoinRestante <= 0) break; // Le besoin est comblé

                $stockDispo = (int)$don['stock_restant'];
                
                // On prend le maximum possible entre le besoin restant et le stock du don
                $quantiteAPrendre = min($quantiteBesoinRestante, $stockDispo);

                if ($quantiteAPrendre > 0) {
                    $dispatchRepo->createDispatch(
                        $don['id'],
                        $id_ville,
                        $quantiteAPrendre,
                        $dateAujourdhui
                    );

                    $quantiteBesoinRestante -= $quantiteAPrendre;
                }
            }
            // ---------------------------------------------------

            Flight::redirect('/');

        } catch (Throwable $e) {
            http_response_code(500);
            Flight::json(['error' => $e->getMessage()]);
        }
    }
    
    private static function handleError($e) {
        http_response_code(500);
        Flight::json([
            'ok' => false,
            'errors' => ['_global' => $e->getMessage()]
        ]);
    }
}