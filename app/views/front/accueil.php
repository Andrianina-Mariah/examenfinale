<div class="container py-4">
    <div class="mb-5">
        <h2 class="fw-bold text-dark mb-2">Liste des Villes et leurs besoins</h2>
        <p class="text-muted">Consultez les besoins des sinistrés par ville</p>
    </div>

    <div class="row g-4">
        <?php if (isset($villes) && !empty($villes)): ?>
            <?php for ($i=0; $i < count($villes); $i++): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm rounded h-100 border-0 hover-shadow">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title fw-bold text-primary mb-0">
                                    <?= htmlspecialchars($villes[$i]['ville']->getNom()) ?>
                                </h5>
                                <span class="badge bg-light text-dark border">
                                    <?= htmlspecialchars($villes[$i]['region_nom']) ?>
                                </span>
                            </div>
                            
                            <div class="mb-3">
                                <h6 class="text-muted small mb-2">BESOINS ENREGISTRÉS</h6>
                                <p class="text-secondary mb-0">Aucun donné</p>
                            </div>

                            <div class="d-grid gap-2 mt-auto">
                                <a href="<?= BASE_URL ?>/villesDetails/<?= $villes[$i]['ville']->getId() ?>" 
                                   class="btn btn-primary btn-sm">
                                    <i class="bi bi-eye"></i> Voir les détails
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center py-5">
                    <h5>Aucune ville disponible</h5>
                    <p class="mb-0">Les données seront affichées prochainement.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
