<?php
class DonController {

    public static function form() {
        try {
            $pdo = Flight::db();

            $typeRepo = new TypeDonRepository($pdo);
            $catRepo  = new CategorieRepository($pdo);

            Flight::render('front/modele.php', [
                'var'        => 'formulaireDon.php',
                'types'      => $typeRepo->getAllTypes(),
                'categories' => $catRepo->getAllCategories(),
                'title'      => 'Saisie des Dons'
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
            $donRepo  = new DonRepository($pdo);
            $besoinRepo = new BesoinRepository($pdo); // À ajouter
            $dispatchRepo = new DispatchRepository($pdo); // À ajouter

            $id_type_don = $data->id_type_don;
            $catRepo = new CategorieRepository($pdo);

            // 1. Gestion nouveau type
            if (!empty($data->nouveau_type_nom)) {
                $id_type_don = $typeRepo->createTypeDon($data->nouveau_type_nom, $data->id_categorie_nouveau);
            }

            // 2. Déterminer le type de catégorie et la date
            $date_saisie = date('Y-m-d'); // date actuelle
            $type_categorie = $data->type_categorie ?? 'materiel'; // par défaut materiel si non précisé
            
            // 2.1 Si c'est de l'argent et pas de type sélectionné, utiliser un type par défaut
            if ($type_categorie === 'argent' && empty($id_type_don)) {
                // Trouver l'id de la catégorie Argent
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

            // 3. Création du don selon la catégorie
            if ($type_categorie === 'argent') {
                $quantite = null;
                $montant = (float)($data->montant_argent ?? 0);
            } else {
                $quantite = (int)($data->quantite ?? 0);
                $montant = 0;
            }

            $id_don = $donRepo->createDon(
                $id_type_don,
                $type_categorie,
                $quantite,
                $montant,
                $date_saisie
            );

            // --- LOGIQUE DE DISPATCH AUTOMATIQUE ---
            $quantiteRestanteDon = $quantite ?? 0; // pour matériel/nature
            if ($type_categorie === 'argent') {
                $quantiteRestanteDon = (float)$montant; // pour argent
            }

            $dateAujourdhui = date('Y-m-d');

            // Récupérer les besoins en attente pour ce type de produit (du plus vieux au plus récent)
            $besoinsEnAttente = $besoinRepo->getBesoinsNonSatisfaitsParType($id_type_don);

            foreach ($besoinsEnAttente as $besoin) {
                if ($quantiteRestanteDon <= 0) break; // Plus de stock dans ce don

                $resteBesoin = (int)$besoin['reste'];
                
                // On prend soit tout ce qui reste du besoin, soit tout ce qui reste du don
                $quantiteADonner = min($quantiteRestanteDon, $resteBesoin);

                if ($quantiteADonner > 0) {
                    // Créer l'entrée dans dispatch
                    $dispatchRepo->createDispatch(
                        $id_don,
                        $besoin['id_ville'],
                        $quantiteADonner,
                        $dateAujourdhui
                    );

                    $quantiteRestanteDon -= $quantiteADonner;
                }
            }
            // ---------------------------------------

            Flight::redirect('/');

        } catch (Throwable $e) {
            self::handleError($e);
        }
    }

    // public static function enregistrer() {
    //     try {
    //         $pdo = Flight::db();
    //         $data = Flight::request()->data;

    //         $typeRepo = new TypeDonRepository($pdo);
    //         $donRepo  = new DonRepository($pdo);

    //         $id_type_don = $data->id_type_don;

    //         // LOGIQUE : Création du type si nouveau_type_nom est rempli [cite: 15, 21]
    //         if (!empty($data->nouveau_type_nom)) {
    //             if (empty($data->id_categorie_nouveau)) {
    //                 throw new Exception("Veuillez choisir une catégorie pour le nouveau type de don.");
    //             }
                
    //             $id_type_don = $typeRepo->createTypeDon(
    //                 $data->nouveau_type_nom, 
    //                 $data->id_categorie_nouveau
    //             );
    //         }

    //         if (empty($id_type_don)) {
    //             throw new Exception("Veuillez sélectionner un type de don.");
    //         }

    //         // Insertion du don dans bngrc_don [cite: 15]
    //         $donRepo->createDon(
    //             $id_type_don,
    //             $data->quantite,
    //             $data->date_saisie
    //         );

    //         // Une fois le don saisi, on peut imaginer lancer le dispatch ici plus tard [cite: 15]
    //         Flight::redirect('/');

    //     } catch (Throwable $e) {
    //         self::handleError($e);
    //     }
    // }

    private static function handleError($e) {
        http_response_code(500);
        Flight::json(['ok' => false, 'message' => $e->getMessage()]);
    }
}