<div class="container py-5">
    <div class="d-flex align-items-center mb-4">
        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width:54px;height:54px;">
            <i class="bi bi-shuffle text-primary fs-4"></i>
        </div>
        <div>
            <h2 class="fw-bold text-dark mb-0">Simulation du Dispatch</h2>
            <p class="text-muted mb-0">Répartition FIFO des dons physiques vers les besoins</p>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-3 mb-5">
        <div class="card-body p-4 text-center">
            <form action="/simulation/lancer" method="POST">
                <i class="bi bi-cpu text-primary display-4 d-block mb-3"></i>
                <h5 class="fw-bold text-dark mb-3">Lancer l'algorithme de répartition</h5>
                <button type="submit" class="btn btn-primary btn-lg px-5 shadow">
                    <i class="bi bi-play-circle-fill me-2"></i> Calculer maintenant
                </button>
            </form>
        </div>
    </div>

    <?php if (isset($villes_simulees) && !empty($villes_simulees)): ?>
        <h5 class="fw-bold text-dark mb-4">
            <i class="bi bi-grid-3x3-gap-fill text-primary me-2"></i>Résultats par ville
        </h5>

        <div class="row g-4 mb-5">
            <?php foreach ($villes_simulees as $nom_ville => $besoins_ville): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 rounded-3 h-100 border-top border-primary border-3">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                                    <i class="bi bi-geo-alt-fill me-1"></i> <?= htmlspecialchars($nom_ville) ?>
                                </span>
                            </div>

                            <?php foreach ($besoins_ville as $b): 
                                $status_class = ($b['reste'] == 0) ? 'bg-success' : ($b['attribue'] > 0 ? 'bg-warning text-dark' : 'bg-danger');
                                $status_label = ($b['reste'] == 0) ? 'Complet' : ($b['attribue'] > 0 ? 'Partiel' : 'Non satisfait');
                            ?>
                                <div class="mb-4 pb-3 border-bottom border-light">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="fw-bold mb-0 text-dark"><?= htmlspecialchars($b['type_nom']) ?></h6>
                                        <span class="badge <?= $status_class ?> rounded-pill small" style="font-size: 0.7rem;">
                                            <?= $status_label ?>
                                        </span>
                                    </div>

                                    <div class="row g-2 mb-2">
                                        <div class="col-6">
                                            <div class="bg-light rounded-3 p-2 text-center">
                                                <small class="text-muted d-block" style="font-size: 0.7rem;">Demandé</small>
                                                <span class="fw-bold"><?= $b['demande'] ?></span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="bg-success bg-opacity-10 rounded-3 p-2 text-center">
                                                <small class="text-muted d-block" style="font-size: 0.7rem;">Attribué</small>
                                                <span class="fw-bold text-success">+ <?= $b['attribue'] ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-light rounded-3 p-2 text-center border">
                                        <small class="text-muted">Reste à pourvoir :</small>
                                        <strong class="<?= $b['reste'] > 0 ? 'text-danger' : 'text-success' ?> ms-1">
                                            <?= $b['reste'] ?>
                                        </strong>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="card shadow border-0 rounded-3 bg-dark text-white mb-5">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h5 class="fw-bold mb-1">Confirmer ce dispatch ?</h5>
                        <p class="text-white-50 small mb-0">L'action est irréversible et mettra à jour les stocks réels.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="/simulation" class="btn btn-outline-light px-4">Annuler</a>
                        <form action="/simulation/valider" method="POST">
                            <button type="submit" class="btn btn-success btn-lg px-5 shadow">
                                <i class="bi bi-check-circle-fill me-2"></i> Enregistrer en Base
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php elseif (Flight::request()->method == 'POST'): ?>
        <div class="alert alert-info text-center shadow-sm rounded-3">
            <i class="bi bi-info-circle me-2"></i> Aucun besoin ne peut être satisfait avec les dons actuellement en stock.
        </div>
    <?php endif; ?>
</div>