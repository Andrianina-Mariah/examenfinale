<?php
class StatRepository {
    private $pdo;
    public function __construct(PDO $pdo) { $this->pdo = $pdo; }

    public function getGlobalStats() {
        // On calcule d'abord le total des besoins en Ar
        $sqlBesoins = "SELECT SUM(quantite * prix_unitaire) as total FROM bngrc_besoin";
        $totalBesoins = (float)$this->pdo->query($sqlBesoins)->fetchColumn();

        // On calcule ce qui a été dispatché (Dons physiques)
        $sqlDispatch = "SELECT SUM(dp.quantite_attribuee * b.prix_unitaire) 
                        FROM bngrc_dispatch dp
                        JOIN bngrc_don d ON dp.id_don = d.id
                        JOIN bngrc_besoin b ON (d.id_type_don = b.id_type_don AND dp.id_ville = b.id_ville)";
        $totalDispatch = (float)$this->pdo->query($sqlDispatch)->fetchColumn();

        // On calcule ce qui a été acheté (Dons en argent utilisés)
        $sqlAchats = "SELECT SUM(montant_total) FROM bngrc_achat";
        $totalAchats = (float)$this->pdo->query($sqlAchats)->fetchColumn();

        // Nombre de dons
        $nbDons = (int)$this->pdo->query("SELECT COUNT(*) FROM bngrc_don")->fetchColumn();

        $satisfait = $totalDispatch + $totalAchats;
        $pourcentage = ($totalBesoins > 0) ? round(($satisfait / $totalBesoins) * 100) : 0;

        return [
            'total_besoins' => number_format($totalBesoins, 0, '.', ' ') . ' Ar',
            'total_satisfaits' => number_format($satisfait, 0, '.', ' ') . ' Ar',
            'total_restants' => number_format($totalBesoins - $satisfait, 0, '.', ' ') . ' Ar',
            'nb_dons' => $nbDons,
            'pourcentage' => $pourcentage
        ];
    }

    public function getStatsParVille() {
        // Cette requête récupère les quantités par ville
        $sql = "SELECT v.nom as ville_nom,
                COALESCE(SUM(b.quantite), 0) as qte_besoin,
                (
                    COALESCE((SELECT SUM(dp.quantite_attribuee) FROM bngrc_dispatch dp WHERE dp.id_ville = v.id), 0) +
                    COALESCE((SELECT SUM(ac.quantite_achetee) FROM bngrc_achat ac WHERE ac.id_ville = v.id), 0)
                ) as qte_recue
                FROM bngrc_ville v
                LEFT JOIN bngrc_besoin b ON v.id = b.id_ville
                GROUP BY v.id, v.nom";
        
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}