<!-- ville-detail.php - Détails d'une ville avec tous ses besoins et dons -->
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="/dashboard">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="/villes">Villes</a></li>
                <li class="breadcrumb-item active"><?= htmlspecialchars($ville['nom']) ?></li>
            </ol>
        </nav>
        <h2>
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-building me-2" viewBox="0 0 16 16">
                <path d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z"/>
                <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3z"/>
            </svg>
            <?= htmlspecialchars($ville['nom']) ?>
        </h2>
        <span class="region-badge">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-geo-alt me-1" viewBox="0 0 16 16">
                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94"/>
            </svg>
            Région: <?= htmlspecialchars($ville['region_nom'] ?? 'N/A') ?>
        </span>
    </div>
    <div>
        <a href="/besoins/ville/<?= $ville['id'] ?>" class="btn btn-success-custom">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg me-1" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
            </svg>
            Ajouter un besoin
        </a>
    </div>
</div>

<!-- Statistiques de la ville -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-number" style="color: #ed8936;"><?= count($ville['besoins'] ?? []) ?></div>
            <div class="stat-label">Besoins</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-number" style="color: #4a7c59;"><?= count($ville['dons_attribues'] ?? []) ?></div>
            <div class="stat-label">Dons reçus</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-number"><?= number_format($ville['valeur_totale'] ?? 0, 0, ',', ' ') ?></div>
            <div class="stat-label">Valeur Besoins (Ar)</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <?php 
                $couverture = $ville['couverture'] ?? 0;
                $textColor = $couverture < 30 ? '#c53030' : ($couverture < 70 ? '#ed8936' : '#4a7c59');
            ?>
            <div class="stat-number" style="color: <?= $textColor ?>;"><?= $couverture ?>%</div>
            <div class="stat-label">Couverture</div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Besoins -->
    <div class="col-lg-6 mb-4">
        <div class="card card-custom h-100">
            <div class="card-header" style="background: #ed8936; color: white; border-radius: 12px 12px 0 0;">
                <h5 class="mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clipboard-data me-2" viewBox="0 0 16 16">
                        <path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0z"/>
                    </svg>
                    Besoins de la ville
                </h5>
            </div>
            <div class="card-body p-0">
                <?php if (!empty($ville['besoins'])): ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background: #f7fafc;">
                            <tr>
                                <th style="color: #2c5282;">Date</th>
                                <th style="color: #2c5282;">Type</th>
                                <th style="color: #2c5282;">Quantité</th>
                                <th style="color: #2c5282;">Prix U.</th>
                                <th style="color: #2c5282;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ville['besoins'] as $besoin): ?>
                            <tr>
                                <td><?= date('d/m/Y', strtotime($besoin['date_saisie'])) ?></td>
                                <td><span class="badge-besoin"><?= htmlspecialchars($besoin['type_don']) ?></span></td>
                                <td><?= $besoin['quantite'] ?></td>
                                <td><?= number_format($besoin['prix_unitaire'], 0, ',', ' ') ?> Ar</td>
                                <td><strong><?= number_format($besoin['quantite'] * $besoin['prix_unitaire'], 0, ',', ' ') ?> Ar</strong></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot style="background: #f7fafc;">
                            <tr>
                                <td colspan="4" class="text-end"><strong>Total:</strong></td>
                                <td><strong><?= number_format($ville['valeur_totale'] ?? 0, 0, ',', ' ') ?> Ar</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <?php else: ?>
                <div class="text-center py-5 text-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-clipboard mb-3" viewBox="0 0 16 16">
                        <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
                    </svg>
                    <p>Aucun besoin enregistré pour cette ville</p>
                    <a href="/besoins/ville/<?= $ville['id'] ?>" class="btn btn-warning btn-sm">Ajouter un besoin</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Dons attribués -->
    <div class="col-lg-6 mb-4">
        <div class="card card-custom h-100">
            <div class="card-header" style="background: #4a7c59; color: white; border-radius: 12px 12px 0 0;">
                <h5 class="mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-gift me-2" viewBox="0 0 16 16">
                        <path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A3 3 0 0 1 3 2.506z"/>
                    </svg>
                    Dons attribués
                </h5>
            </div>
            <div class="card-body p-0">
                <?php if (!empty($ville['dons_attribues'])): ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background: #f7fafc;">
                            <tr>
                                <th style="color: #2c5282;">Date dispatch</th>
                                <th style="color: #2c5282;">Type</th>
                                <th style="color: #2c5282;">Quantité</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ville['dons_attribues'] as $don): ?>
                            <tr>
                                <td><?= date('d/m/Y', strtotime($don['date_dispatch'])) ?></td>
                                <td><span class="badge-don"><?= htmlspecialchars($don['type_don']) ?></span></td>
                                <td><strong><?= $don['quantite_attribuee'] ?></strong></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot style="background: #f7fafc;">
                            <tr>
                                <td colspan="2" class="text-end"><strong>Total reçu:</strong></td>
                                <td><strong><?= array_sum(array_column($ville['dons_attribues'], 'quantite_attribuee')) ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <?php else: ?>
                <div class="text-center py-5 text-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-gift mb-3" viewBox="0 0 16 16">
                        <path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A3 3 0 0 1 3 2.506z"/>
                    </svg>
                    <p>Aucun don attribué à cette ville</p>
                    <a href="/dispatch" class="btn btn-success btn-sm">Voir le dispatch</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Comparaison besoins vs dons -->
<div class="card card-custom">
    <div class="card-header card-header-custom">
        <h5 class="mb-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bar-chart me-2" viewBox="0 0 16 16">
                <path d="M4 11H2v3h2zm5-4H7v7h2zm5-5v12h-2V2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1z"/>
            </svg>
            Comparaison Besoins vs Dons reçus
        </h5>
    </div>
    <div class="card-body">
        <?php if (!empty($comparaison)): ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Type de don</th>
                        <th>Besoin</th>
                        <th>Reçu</th>
                        <th>Manque</th>
                        <th>Couverture</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comparaison as $item): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($item['type_don']) ?></strong></td>
                        <td><?= $item['besoin'] ?></td>
                        <td><?= $item['recu'] ?></td>
                        <td>
                            <?php if ($item['manque'] > 0): ?>
                                <span class="text-danger"><?= $item['manque'] ?></span>
                            <?php else: ?>
                                <span class="text-success">✓</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php 
                                $pct = $item['besoin'] > 0 ? round(($item['recu'] / $item['besoin']) * 100) : 0;
                                $barClass = $pct < 30 ? 'bg-danger' : ($pct < 70 ? 'bg-warning' : 'bg-success');
                            ?>
                            <div class="progress progress-custom" style="width: 100px;">
                                <div class="progress-bar <?= $barClass ?>" style="width: <?= min($pct, 100) ?>%"></div>
                            </div>
                            <small><?= $pct ?>%</small>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <p class="text-muted text-center mb-0">Pas de données de comparaison disponibles</p>
        <?php endif; ?>
    </div>
</div>
