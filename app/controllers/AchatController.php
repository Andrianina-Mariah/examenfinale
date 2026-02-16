<?php
class AchatController {

    public static function pageAchats() {
        $pdo = Flight::db();
        $id_ville = Flight::request()->query->id_ville;
        
        $besoinRepo = new BesoinRepository($pdo);
        $villeRepo = new VilleRepository($pdo);
        
        // Récupérer les frais et le solde d'argent réel
        $frais = $pdo->query("SELECT frais_pourcentage FROM bngrc_config LIMIT 1")->fetchColumn();
        $solde = $pdo->query("SELECT SUM(montant_restant) FROM bngrc_don WHERE montant_restant > 0")->fetchColumn();

        Flight::render('front/modele.php', [
            'var' => 'achat_besoins.php',
            'besoins' => $besoinRepo->getBesoinsRestantsPourAchat($id_ville),
            'villes' => $villeRepo->getAllVilles(),
            'frais' => $frais ?? 0,
            'solde_argent' => $solde ?? 0,
            'id_ville_selectionnee' => $id_ville
        ]);
    }

    public static function effectuerAchat() {
        $pdo = Flight::db();
        $data = Flight::request()->data;
        $pdo->beginTransaction();

        try {
            $id_besoin = $data->id_besoin;
            $qte = (int)$data->quantite;

            // 1. Récupérer infos besoin + frais
            $st = $pdo->prepare("SELECT b.*, (SELECT frais_pourcentage FROM bngrc_config LIMIT 1) as taux FROM bngrc_besoin b WHERE b.id = ?");
            $st->execute([$id_besoin]);
            $besoin = $st->fetch(PDO::FETCH_ASSOC);

            // 2. Calcul du coût total (incluant frais)
            $total_a_payer = ($qte * $besoin['prix_unitaire']) * (1 + ($besoin['taux'] / 100));

            // 3. Chercher les dons d'Argent ayant du montant_restant (FIFO)
            $stArgent = $pdo->query("SELECT id, montant_restant FROM bngrc_don WHERE montant_restant > 0 ORDER BY date_saisie ASC, id ASC");
            $donsArgent = $stArgent->fetchAll(PDO::FETCH_ASSOC);

            $resteAPrelever = $total_a_payer;
            foreach ($donsArgent as $don) {
                if ($resteAPrelever <= 0) break;

                $montantDisponible = (float)$don['montant_restant'];
                $prelevement = min($montantDisponible, $resteAPrelever);
                
                // Mise à jour du montant_restant dans bngrc_don
                $nouveauReste = $montantDisponible - $prelevement;
                $pdo->prepare("UPDATE bngrc_don SET montant_restant = ? WHERE id = ?")->execute([$nouveauReste, $don['id']]);

                $resteAPrelever -= $prelevement;
            }

            if ($resteAPrelever > 0.01) throw new Exception("Fonds insuffisants en Argent pour couvrir l'achat et les frais.");

            // 4. Enregistrer dans bngrc_achat
            $pdo->prepare("INSERT INTO bngrc_achat (id_ville, id_type_don, quantite_achetee, prix_unitaire, frais_pourcentage, montant_total, date_achat) VALUES (?, ?, ?, ?, ?, ?, NOW())")
                ->execute([$besoin['id_ville'], $besoin['id_type_don'], $qte, $besoin['prix_unitaire'], $besoin['taux'], $total_a_payer]);

            $pdo->commit();
            Flight::redirect('/achats/besoins');

        } catch (Exception $e) {
            $pdo->rollBack();
            Flight::halt(400, $e->getMessage());
        }
    }
}