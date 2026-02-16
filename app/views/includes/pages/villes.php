<!-- villes.php - Liste des villes avec détails -->
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h2>Villes Sinistrées</h2>
        <p class="text-muted mb-0">
            <?php if (isset($region_nom)): ?>
                Région: <?= htmlspecialchars($region_nom) ?>
            <?php else: ?>
                Toutes les villes
            <?php endif; ?>
        </p>
    </div>
    <a href="/besoins" class="btn btn-success-custom">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg me-1" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
        </svg>
        Ajouter un besoin
    </a>
</div>

<div class="row g-4">
    <?php if (!empty($villes)): ?>
        <?php foreach ($villes as $ville): ?>
        <div class="col-md-6 col-lg-4">
            <div class="card card-custom ville-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-building me-2 text-primary" viewBox="0 0 16 16">
                                <path d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z"/>
                                <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3z"/>
                            </svg>
                            <?= htmlspecialchars($ville['nom']) ?>
                        </h5>
                        <span class="region-badge"><?= htmlspecialchars($ville['region_nom'] ?? 'N/A') ?></span>
                    </div>

                    <!-- Besoins -->
                    <div class="mb-3">
                        <h6 class="fw-bold text-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-data me-1" viewBox="0 0 16 16">
                                <path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0z"/>
                                <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
                                <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
                            </svg>
                            Besoins
                        </h6>
                        <?php if (!empty($ville['besoins'])): ?>
                            <ul class="list-unstyled mb-0">
                                <?php foreach ($ville['besoins'] as $besoin): ?>
                                <li class="mb-1">
                                    <span class="badge-besoin"><?= htmlspecialchars($besoin['type_don']) ?></span>
                                    <span class="ms-2"><?= $besoin['quantite'] ?> unités</span>
                                    <small class="text-muted">(<?= number_format($besoin['quantite'] * $besoin['prix_unitaire'], 0, ',', ' ') ?> Ar)</small>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-muted small mb-0">Aucun besoin enregistré</p>
                        <?php endif; ?>
                    </div>

                    <!-- Dons attribués -->
                    <div class="mb-3">
                        <h6 class="fw-bold text-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gift me-1" viewBox="0 0 16 16">
                                <path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A3 3 0 0 1 3 2.506z"/>
                            </svg>
                            Dons Attribués
                        </h6>
                        <?php if (!empty($ville['dons_attribues'])): ?>
                            <ul class="list-unstyled mb-0">
                                <?php foreach ($ville['dons_attribues'] as $don): ?>
                                <li class="mb-1">
                                    <span class="badge-don"><?= htmlspecialchars($don['type_don']) ?></span>
                                    <span class="ms-2"><?= $don['quantite_attribuee'] ?> unités</span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-muted small mb-0">Aucun don attribué</p>
                        <?php endif; ?>
                    </div>

                    <!-- Barre de couverture -->
                    <?php 
                        $couverture = $ville['couverture'] ?? 0;
                        $barClass = $couverture < 30 ? 'bg-danger' : ($couverture < 70 ? 'bg-warning' : 'bg-success');
                    ?>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small class="text-muted">Couverture des besoins</small>
                            <small class="fw-bold"><?= $couverture ?>%</small>
                        </div>
                        <div class="progress progress-custom">
                            <div class="progress-bar <?= $barClass ?>" style="width: <?= $couverture ?>%"></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="btn-group w-100">
                        <a href="/besoins/ville/<?= $ville['id'] ?>" class="btn btn-outline-warning btn-sm">
                            + Besoin
                        </a>
                        <a href="/ville/<?= $ville['id'] ?>" class="btn btn-outline-primary btn-sm">
                            Détails
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="alert alert-info alert-custom text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-buildings mb-3" viewBox="0 0 16 16">
                    <path d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022z"/>
                </svg>
                <p class="mb-0">Aucune ville enregistrée</p>
            </div>
        </div>
    <?php endif; ?>
</div>
