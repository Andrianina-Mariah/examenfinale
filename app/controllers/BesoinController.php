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

            $id_type_don = $data->id_type_don;
            $catRepo = new CategorieRepository($pdo);

            // 1. Gestion nouveau type (si applicable au formulaire de besoin)
            if (!empty($data->nouveau_type_nom)) {
                $id_type_don = $typeRepo->createTypeDon($data->nouveau_type_nom, $data->id_categorie_nouveau);
            }

            // 2. Déterminer le type de catégorie
            $type_categorie = $data->type_categorie ?? 'materiel';
            
            // 2.1 Si c'est de l'argent et pas de type sélectionné, utiliser un type par défaut
            if ($type_categorie === 'argent' && empty($id_type_don)) {
                $categories = $catRepo->getAllCategories();
                $id_categorie_argent = null;
                foreach ($categories as $cat) {
                    if (strtolower($cat->getNom()) === 'argent') {
                        $id_categorie_argent = $cat->getId();
                        break;
                    }
                }
                if ($id_categorie_argent) {
                    $id_type_don = $typeRepo->getOrCreateTypeArgent($id_categorie_argent);
                }
            }

            // 3. Création du besoin selon la catégorie
            if ($type_categorie === 'argent') {
                $quantite = null;
                $prix_unitaire = null;
                $montant = (float)($data->montant_argent ?? 0);
            } else {
                $quantite = (int)($data->quantite ?? 0);
                $prix_unitaire = (float)($data->prix_unitaire ?? 0);
                $montant = null;
            }

            // 4. Création du besoin initial
            $besoinRepo->createBesoin(
                $data->id_ville,
                $id_type_don,
                $quantite,
                $prix_unitaire,
                $data->date_saisie,
                $montant
            );

            Flight::redirect(BASE_URL . '/');

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