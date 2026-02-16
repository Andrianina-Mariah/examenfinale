<div class="container py-4">
    <!-- En-tête -->
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Détails ville</li>
            </ol>
        </nav>
        <h2 class="fw-bold text-dark">
            <i class="bi bi-geo-alt-fill text-primary"></i>
            <?= $ville ? htmlspecialchars($ville->getNom()) : 'Aucun donné' ?>
        </h2>
        <p class="text-muted">Détails des besoins et ressources attribuées</p>
    </div>

    <!-- Statistiques globales -->
    <div class="row g-4 mb-4">
        <?php
            $totalBesoin = 0;
            $totalAttribue = 0;
            $totalValeur = 0;

            if (!empty($besoins)) {
                foreach ($besoins as $item) {
                    $b = $item['besoin'];
                    $totalBesoin += $b->getQuantite();
                    $totalAttribue += $item['quantite_attribuee'];
                    $totalValeur += $b->getQuantite() * $b->getPrixUnitaire();
                }
            }

            $regionNom = (isset($region) && $region) ? $region->getNom() : 'Non spécifiée';
            $tauxCouverture = $totalBesoin > 0 ? round(($totalAttribue / $totalBesoin) * 100, 1) : 0;
        ?>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center p-4">
                    <div class="text-muted small mb-2">RÉGION</div>
                    <h4 class="fw-bold text-dark mb-0"><?= htmlspecialchars($regionNom) ?></h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 bg-primary text-white">
                <div class="card-body text-center p-4">
                    <div class="small mb-2 opacity-75">TOTAL BESOINS</div>
                    <h4 class="fw-bold mb-0"><?= number_format($totalBesoin, 0, ',', ' ') ?></h4>
                    <small class="opacity-75">unités</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 bg-success text-white">
                <div class="card-body text-center p-4">
                    <div class="small mb-2 opacity-75">ATTRIBUÉ</div>
                    <h4 class="fw-bold mb-0"><?= number_format($totalAttribue, 0, ',', ' ') ?></h4>
                    <small class="opacity-75">unités</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 bg-info text-white">
                <div class="card-body text-center p-4">
                    <div class="small mb-2 opacity-75">TAUX COUVERTURE</div>
                    <h4 class="fw-bold mb-0"><?= $tauxCouverture ?>%</h4>
                    <small class="opacity-75">complété</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau détaillé -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-bold text-dark">
                <i class="bi bi-list-ul text-primary"></i>
                Liste détaillée par article
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3 ps-4">Type de Besoin</th>
                            <th class="py-3 text-center">Quantité demandée</th>
                            <th class="py-3 text-center">Quantité attribuée</th>
                            <th class="py-3 text-end">Prix unitaire</th>
                            <th class="py-3 text-end">Valeur Totale</th>
                            <th class="py-3 text-center">Reste à pourvoir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($besoins)): ?>
                            <?php foreach ($besoins as $item): ?>
                                <?php
                                    $b = $item['besoin'];
                                    $attribue = $item['quantite_attribuee'];
                                    $reste = $b->getQuantite() - $attribue;
                                    $totalValeurItem = $b->getQuantite() * $b->getPrixUnitaire();
                                ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark"><?= htmlspecialchars($item['type_nom']) ?></div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border">
                                            <?= number_format($b->getQuantite(), 0, ',', ' ') ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success text-white">
                                            <?= number_format($attribue, 0, ',', ' ') ?>
                                        </span>
                                    </td>
                                    <td class="text-end pe-3">
                                        <span class="text-muted"><?= number_format($b->getPrixUnitaire(), 2, ',', ' ') ?> Ar</span>
                                    </td>
                                    <td class="text-end pe-3">
                                        <span class="fw-bold text-dark"><?= number_format($totalValeurItem, 2, ',', ' ') ?> Ar</span>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($reste <= 0): ?>
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle"></i> Comblé
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">
                                                <?= number_format($reste, 0, ',', ' ') ?> restant
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-inbox display-4 d-block mb-3 opacity-50"></i>
                                        <p class="mb-0">Aucun besoin enregistré pour cette ville.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if (!empty($besoins)): ?>
        <div class="card-footer bg-light border-top">
            <div class="row g-3">
                <div class="col-md-4">
                    <small class="text-muted d-block">Valeur totale des besoins</small>
                    <strong class="text-dark"><?= number_format($totalValeur, 2, ',', ' ') ?> Ar</strong>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block">Articles différents</small>
                    <strong class="text-dark"><?= count($besoins) ?></strong>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block">Statut global</small>
                    <strong class="<?= $tauxCouverture >= 100 ? 'text-success' : 'text-warning' ?>">
                        <?= $tauxCouverture >= 100 ? 'Complété' : 'En attente' ?>
                    </strong>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Bouton retour -->
    <div class="mt-4">
        <a href="/" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour à l'accueil
        </a>
    </div>
</div>

