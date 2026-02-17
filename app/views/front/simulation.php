<div class="container py-5">
    <div class="d-flex align-items-center mb-4">
        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
            <i class="bi bi-cpu-fill text-primary fs-3"></i>
        </div>
        <div>
            <h2 class="fw-bold mb-0">Intelligence de Répartition</h2>
            <p class="text-muted mb-0">Simulez le dispatch des dons selon différents algorithmes</p>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-3 mb-5">
        <div class="card-body p-4">
            <form action="<?= BASE_URL ?>/simulation/lancer" method="POST">
                <div class="row align-items-end g-3">
                    <div class="col-md-8">
                        <label class="form-label fw-bold">Méthode de distribution</label>
                        <select name="mode" class="form-select form-select-lg">
                            <option value="fifo">FIFO : Premier arrivé, premier servi</option>
                            <option value="petit_besoin">Équité : Combler les petits besoins d'abord</option>
                            <option value="proportionnel">Prorata : Distribution proportionnelle (Partage)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm">
                            <i class="bi bi-play-fill me-1"></i> Lancer la simulation
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php if (!empty($villes_simulees)): ?>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold m-0 text-dark">Résultats : <span class="text-primary"><?= $mode_actuel ?></span></h4>
            <form action="<?= BASE_URL ?>/simulation/valider" method="POST">
                <button type="submit" class="btn btn-success btn-lg px-5 shadow">
                    <i class="bi bi-check-all me-1"></i> Valider et appliquer en BDD
                </button>
            </form>
        </div>

        <div class="row g-4">
            <?php foreach ($villes_simulees as $ville => $details): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0 pt-4 px-4">
                            <h5 class="fw-bold mb-0"><i class="bi bi-geo-alt text-danger me-2"></i><?= $ville ?></h5>
                        </div>
                        <div class="card-body px-4 pb-4">
                            <?php foreach ($details as $d): ?>
                                <div class="mb-3 p-3 bg-light rounded-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="fw-bold"><?= $d['type_nom'] ?></span>
                                        <span class="badge bg-<?= $d['reste'] == 0 ? 'success' : 'warning text-dark' ?>">
                                            <?= $d['reste'] == 0 ? 'Comblé' : 'Partiel' ?>
                                        </span>
                                    </div>
                                    <div class="row g-1 small text-center">
                                        <div class="col-4 border-end">Demande<br><strong><?= $d['demande'] ?></strong></div>
                                        <div class="col-4 border-end text-success">Attribué<br><strong>+<?= $d['attribue'] ?></strong></div>
                                        <div class="col-4 text-danger">Reste<br><strong><?= $d['reste'] ?></strong></div>
                                    </div>
                                    <div class="progress mt-2" style="height: 6px;">
                                        <?php $pct = ($d['demande'] > 0) ? ($d['attribue'] / $d['demande']) * 100 : 0; ?>
                                        <div class="progress-bar bg-success" style="width: <?= $pct ?>%"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php elseif(isset($_POST['mode'])): ?>
        <div class="text-center py-5">
            <i class="bi bi-inbox text-muted display-1"></i>
            <p class="text-muted mt-3">Aucun dispatch possible : soit pas de besoins, soit pas de dons disponibles.</p>
        </div>
    <?php endif; ?>
</div>