<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-list-ul me-2"></i>Liste des Dons</h2>
        <a href="<?= BASE_URL ?>/don/nouveau" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i>Nouveau Don
        </a>
    </div>

    <?php if (empty($dons)): ?>
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>Aucun don enregistré pour le moment.
        </div>
    <?php else: ?>
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Type de Don</th>
                                <th>Catégorie</th>
                                <th class="text-center">Quantité</th>
                                <th class="text-end">Montant</th>
                                <th class="text-end">Montant Restant</th>
                                <th>Date de Saisie</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dons as $don): ?>
                                <tr>
                                    <td><?= htmlspecialchars($don['id']) ?></td>
                                    <td><?= htmlspecialchars($don['type_nom'] ?? '-') ?></td>
                                    <td>
                                        <?php if (!empty($don['categorie_nom'])): ?>
                                            <span class="badge bg-<?= strtolower($don['categorie_nom']) === 'argent' ? 'warning text-dark' : 'primary' ?>">
                                                <?= htmlspecialchars($don['categorie_nom']) ?>
                                            </span>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $don['quantite'] !== null ? number_format($don['quantite'], 0, ',', ' ') : '-' ?>
                                    </td>
                                    <td class="text-end">
                                        <?= $don['montant'] > 0 ? number_format($don['montant'], 2, ',', ' ') . ' Ar' : '-' ?>
                                    </td>
                                    <td class="text-end">
                                        <?= $don['montant_restant'] > 0 ? number_format($don['montant_restant'], 2, ',', ' ') . ' Ar' : '-' ?>
                                    </td>
                                    <td><?= htmlspecialchars($don['date_saisie']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-3 text-muted">
            <small><i class="bi bi-info-circle me-1"></i>Total: <?= count($dons) ?> don(s) enregistré(s)</small>
        </div>
    <?php endif; ?>
</div>
