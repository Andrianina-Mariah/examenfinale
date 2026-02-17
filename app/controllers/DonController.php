<?php
class DonController {

    public static function liste() {
        try {
            $pdo = Flight::db();
            $donRepo = new DonRepository($pdo);
            
            // Récupérer tous les dons avec le nom du type et de la catégorie
            $st = $pdo->query("
                SELECT d.*, t.nom AS type_nom, c.nom AS categorie_nom
                FROM bngrc_don d
                LEFT JOIN bngrc_type_don t ON d.id_type_don = t.id
                LEFT JOIN bngrc_categorie c ON t.id_categorie = c.id
                ORDER BY d.date_saisie DESC, d.id DESC
            ");
            $dons = $st->fetchAll(PDO::FETCH_ASSOC);

            Flight::render('front/modele.php', [
                'var'   => 'listeDons.php',
                'dons'  => $dons,
                'title' => 'Liste des Dons'
            ]);

        } catch (Throwable $e) {
            self::handleError($e);
        }
    }

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

            $donRepo->createDon(
                $id_type_don,
                $type_categorie,
                $quantite,
                $montant,
                $date_saisie
            );

            Flight::redirect(BASE_URL . '/');

        } catch (Throwable $e) {
            self::handleError($e);
        }
    }


    private static function handleError($e) {
        http_response_code(500);
        Flight::json(['ok' => false, 'message' => $e->getMessage()]);
    }
}