<div class="container py-4">
    <!-- En-tête de la page -->
    <div class="mb-5 text-center">
        <div class="bg-primary bg-opacity-10 rounded-circle p-4 d-inline-flex mb-3">
            <i class="bi bi-building text-primary" style="font-size: 3rem;"></i>
        </div>
        <h2 class="fw-bold text-dark mb-2">Liste des Villes et leurs besoins</h2>
        <p class="text-muted">Consultez les besoins des sinistrés et l'état des distributions par ville</p>
    </div>

    <div class="row g-4">
        <?php if (isset($villes) && !empty($villes)): ?>
            <?php for ($i=0; $i < count($villes); $i++): 
                $nombre_besoins = $villes[$i]['nombre_besoins'] ?? 0;
                $total_quantite = $villes[$i]['total_quantite'] ?? 0;
                $total_recu = $villes[$i]['total_recu'] ?? 0;
                $restant = $total_quantite - $total_recu;
                $pourcentage = $total_quantite > 0 ? round(($total_recu / $total_quantite) * 100) : 0;
                
                // Déterminer le statut
                if ($nombre_besoins == 0) {
                    $statut_badge = '<span class="badge bg-secondary">Aucun besoin</span>';
                    $statut_couleur = 'secondary';
                } elseif ($pourcentage >= 100) {
                    $statut_badge = '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Satisfait</span>';
                    $statut_couleur = 'success';
                } elseif ($pourcentage > 0) {
                    $statut_badge = '<span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split me-1"></i>En cours</span>';
                    $statut_couleur = 'warning';
                } else {
                    $statut_badge = '<span class="badge bg-danger"><i class="bi bi-exclamation-triangle me-1"></i>Urgent</span>';
                    $statut_couleur = 'danger';
                }
            ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm rounded-3 h-100 border-0 hover-shadow transition">
                        <div class="card-body p-4">
                            <!-- En-tête de la carte -->
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="card-title fw-bold text-primary mb-1">
                                        <i class="bi bi-geo-alt-fill me-1"></i>
                                        <?= htmlspecialchars($villes[$i]['ville']->getNom()) ?>
                                    </h5>
                                    <span class="badge bg-light text-dark border">
                                        <i class="bi bi-map me-1"></i><?= htmlspecialchars($villes[$i]['region_nom']) ?>
                                    </span>
                                </div>
                                <?= $statut_badge ?>
                            </div>

                            <!-- Statistiques -->
                            <div class="mb-3">
                                <h6 class="text-muted small fw-bold mb-2">
                                    <i class="bi bi-clipboard-data me-1"></i>STATISTIQUES
                                </h6>
                                
                                <?php if ($nombre_besoins > 0): ?>
                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <div class="bg-primary bg-opacity-10 rounded-3 p-2 text-center">
                                                <div class="text-primary fw-bold fs-5"><?= $nombre_besoins ?></div>
                                                <small class="text-muted">Besoin<?= $nombre_besoins > 1 ? 's' : '' ?></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="bg-<?= $statut_couleur ?> bg-opacity-10 rounded-3 p-2 text-center">
                                                <div class="text-<?= $statut_couleur ?> fw-bold fs-5"><?= $pourcentage ?>%</div>
                                                <small class="text-muted">Satisfait</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Barre de progression -->
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between mb-1">
                                            <small class="text-muted">Demandé: <strong><?= number_format($total_quantite, 0, ',', ' ') ?></strong></small>
                                            <small class="text-muted">Reçu: <strong><?= number_format($total_recu, 0, ',', ' ') ?></strong></small>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-<?= $statut_couleur ?>" 
                                                 role="progressbar" 
                                                 style="width: <?= min($pourcentage, 100) ?>%"
                                                 aria-valuenow="<?= $pourcentage ?>" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>

                                    <?php if ($restant > 0): ?>
                                        <div class="alert alert-<?= $statut_couleur ?> alert-sm py-2 px-3 mb-0">
                                            <small>
                                                <i class="bi bi-info-circle me-1"></i>
                                                <strong><?= number_format($restant, 0, ',', ' ') ?></strong> unité<?= $restant > 1 ? 's' : '' ?> manquante<?= $restant > 1 ? 's' : '' ?>
                                            </small>
                                        </div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <div class="text-center py-3">
                                        <i class="bi bi-inbox text-muted" style="font-size: 2rem;"></i>
                                        <p class="text-muted mb-0 small mt-2">Aucun besoin enregistré</p>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Bouton d'action -->
                            <div class="d-grid gap-2 mt-auto">
                                <a href="/villesDetails/<?= $villes[$i]['ville']->getId() ?>" 
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-eye me-1"></i> Voir les détails
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center py-5 border-0 shadow-sm">
                    <i class="bi bi-info-circle" style="font-size: 3rem;"></i>
                    <h5 class="mt-3">Aucune ville disponible</h5>
                    <p class="mb-0 text-muted">Les données seront affichées prochainement.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
.hover-shadow {
    transition: all 0.3s ease;
}
.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
}
.transition {
    transition: all 0.3s ease;
}
</style>
