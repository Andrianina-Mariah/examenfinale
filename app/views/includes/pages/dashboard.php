<!-- dashboard.php - Tableau de bord avec liste des villes, besoins et dons attribués -->
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h2>Tableau de Bord</h2>
        <p class="text-muted mb-0">Vue d'ensemble des besoins et dons par ville</p>
    </div>
    <div>
        <a href="/dispatch" class="btn btn-primary-custom">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right me-1" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5m14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5"/>
            </svg>
            Lancer Dispatch
        </a>
    </div>
</div>

<!-- Statistiques globales -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-number"><?= $stats['total_villes'] ?? 0 ?></div>
            <div class="stat-label">Villes</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-number"><?= $stats['total_besoins'] ?? 0 ?></div>
            <div class="stat-label">Besoins enregistrés</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-number"><?= $stats['total_dons'] ?? 0 ?></div>
            <div class="stat-label">Dons reçus</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-number"><?= $stats['total_dispatches'] ?? 0 ?></div>
            <div class="stat-label">Dispatches effectués</div>
        </div>
    </div>
</div>

<!-- Liste des villes avec besoins et dons -->
<div class="card card-custom">
    <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-buildings me-2" viewBox="0 0 16 16">
                <path d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022M6 8.694 1 10.36V15h5zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5z"/>
            </svg>
            Villes - Besoins et Dons Attribués
        </h5>
        <div class="btn-group btn-group-sm">
            <a href="/besoins" class="btn btn-outline-light">+ Besoin</a>
            <a href="/dons" class="btn btn-outline-light">+ Don</a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead style="background: #f7fafc;">
                    <tr>
                        <th style="color: #2c5282;">Ville</th>
                        <th style="color: #2c5282;">Région</th>
                        <th style="color: #2c5282;">Besoins</th>
                        <th style="color: #2c5282;">Valeur Besoins</th>
                        <th style="color: #2c5282;">Dons Attribués</th>
                        <th style="color: #2c5282;">Couverture</th>
                        <th style="color: #2c5282;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($villes)): ?>
                        <?php foreach ($villes as $ville): ?>
                        <tr>
                            <td>
                                <strong><?= htmlspecialchars($ville['nom']) ?></strong>
                            </td>
                            <td>
                                <span class="region-badge"><?= htmlspecialchars($ville['region_nom'] ?? 'N/A') ?></span>
                            </td>
                            <td>
                                <?php if (!empty($ville['besoins'])): ?>
                                    <?php foreach ($ville['besoins'] as $besoin): ?>
                                        <div class="mb-1">
                                            <span class="badge-besoin">
                                                <?= htmlspecialchars($besoin['type_don']) ?> : <?= $besoin['quantite'] ?>
                                            </span>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <span class="text-muted">Aucun besoin</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?= number_format($ville['valeur_totale'] ?? 0, 0, ',', ' ') ?> Ar</strong>
                            </td>
                            <td>
                                <?php if (!empty($ville['dons_attribues'])): ?>
                                    <?php foreach ($ville['dons_attribues'] as $don): ?>
                                        <div class="mb-1">
                                            <span class="badge-don">
                                                <?= htmlspecialchars($don['type_don']) ?> : <?= $don['quantite_attribuee'] ?>
                                            </span>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <span class="text-muted">Aucun don</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php 
                                    $couverture = $ville['couverture'] ?? 0;
                                    $barClass = $couverture < 30 ? 'bg-danger' : ($couverture < 70 ? 'bg-warning' : 'bg-success');
                                ?>
                                <div class="progress progress-custom" style="width: 100px;">
                                    <div class="progress-bar <?= $barClass ?>" style="width: <?= $couverture ?>%"></div>
                                </div>
                                <small class="text-muted"><?= $couverture ?>%</small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="/besoins/ville/<?= $ville['id'] ?>" class="btn btn-outline-primary btn-sm" title="Ajouter besoin">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                        </svg>
                                    </a>
                                    <a href="/ville/<?= $ville['id'] ?>" class="btn btn-outline-secondary btn-sm" title="Voir détails">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-inbox mb-2" viewBox="0 0 16 16">
                                    <path d="M4.98 4a.5.5 0 0 0-.39.188L1.54 8H6a.5.5 0 0 1 .5.5 1.5 1.5 0 1 0 3 0A.5.5 0 0 1 10 8h4.46l-3.05-3.812A.5.5 0 0 0 11.02 4zm9.954 5H10.45a2.5 2.5 0 0 1-4.9 0H1.066l.32 2.562a.5.5 0 0 0 .497.438h12.234a.5.5 0 0 0 .496-.438zM3.809 3.563A1.5 1.5 0 0 1 4.981 3h6.038a1.5 1.5 0 0 1 1.172.563l3.7 4.625a.5.5 0 0 1 .105.374l-.39 3.124A1.5 1.5 0 0 1 14.117 13H1.883a1.5 1.5 0 0 1-1.489-1.314l-.39-3.124a.5.5 0 0 1 .106-.374z"/>
                                </svg>
                                <p>Aucune ville enregistrée</p>
                                <a href="/villes/new" class="btn btn-primary-custom btn-sm">Ajouter une ville</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Section Dons non distribués -->
<?php if (!empty($dons_disponibles)): ?>
<div class="card card-custom mt-4">
    <div class="card-header" style="background: #4a7c59; color: white; border-radius: 12px 12px 0 0;">
        <h5 class="mb-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-gift me-2" viewBox="0 0 16 16">
                <path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A3 3 0 0 1 3 2.506zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43zM9 3h2.932l.023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0zM1 4v2h6V4zm8 0v2h6V4zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5z"/>
            </svg>
            Dons disponibles pour dispatch
        </h5>
    </div>
    <div class="card-body">
        <div class="row">
            <?php foreach ($dons_disponibles as $don): ?>
            <div class="col-md-4 mb-3">
                <div class="card h-100" style="border-left: 4px solid #4a7c59;">
                    <div class="card-body">
                        <h6><?= htmlspecialchars($don['type_don']) ?></h6>
                        <p class="mb-1"><strong>Quantité:</strong> <?= $don['quantite_disponible'] ?></p>
                        <p class="mb-0 text-muted small">Reçu le: <?= date('d/m/Y', strtotime($don['date_saisie'])) ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>
