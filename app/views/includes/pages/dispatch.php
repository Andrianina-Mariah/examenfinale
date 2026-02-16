<!-- dispatch.php - Simulation du dispatch des dons par ordre de date et saisie -->
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h2>Dispatch des Dons</h2>
        <p class="text-muted mb-0">Distribution automatique des dons par ordre de date de saisie</p>
    </div>
    <div>
        <form action="/dispatch/run" method="POST" class="d-inline">
            <button type="submit" class="btn btn-danger-custom" onclick="return confirm('Voulez-vous lancer le dispatch automatique des dons?')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-fill me-1" viewBox="0 0 16 16">
                    <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                </svg>
                Lancer le Dispatch Automatique
            </button>
        </form>
    </div>
</div>

<?php if (isset($success) && $success): ?>
<div class="alert alert-success alert-dismissible fade show alert-custom" role="alert">
    <strong>Succès!</strong> Le dispatch a été effectué. <?= $dispatches_count ?? 0 ?> attribution(s) réalisée(s).
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<?php if (isset($error) && $error): ?>
<div class="alert alert-danger alert-dismissible fade show alert-custom" role="alert">
    <strong>Erreur!</strong> <?= htmlspecialchars($error) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<!-- Explication du processus -->
<div class="card card-custom mb-4">
    <div class="card-body">
        <h6 class="fw-bold text-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-circle me-2" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
            </svg>
            Comment fonctionne le dispatch?
        </h6>
        <ol class="mb-0 text-muted">
            <li>Les dons sont traités par <strong>ordre chronologique de date de saisie</strong></li>
            <li>Pour chaque don, le système cherche les besoins du <strong>même type</strong> (aussi par ordre de date)</li>
            <li>Le don est attribué aux villes ayant le plus de besoins en priorité</li>
            <li>La quantité est distribuée jusqu'à épuisement du don ou satisfaction des besoins</li>
        </ol>
    </div>
</div>

<div class="row">
    <!-- Dons disponibles pour dispatch -->
    <div class="col-lg-6 mb-4">
        <div class="card card-custom h-100">
            <div class="card-header" style="background: #4a7c59; color: white; border-radius: 12px 12px 0 0;">
                <h5 class="mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-gift me-2" viewBox="0 0 16 16">
                        <path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A3 3 0 0 1 3 2.506z"/>
                    </svg>
                    Dons à Distribuer
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background: #f7fafc;">
                            <tr>
                                <th style="color: #2c5282;">Date</th>
                                <th style="color: #2c5282;">Type</th>
                                <th style="color: #2c5282;">Qté Disponible</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($dons_disponibles)): ?>
                                <?php foreach ($dons_disponibles as $don): ?>
                                <tr>
                                    <td><?= date('d/m/Y', strtotime($don['date_saisie'])) ?></td>
                                    <td><span class="badge-don"><?= htmlspecialchars($don['type_don']) ?></span></td>
                                    <td><strong><?= $don['quantite_disponible'] ?></strong></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">
                                        Aucun don disponible pour dispatch
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Besoins en attente -->
    <div class="col-lg-6 mb-4">
        <div class="card card-custom h-100">
            <div class="card-header" style="background: #ed8936; color: white; border-radius: 12px 12px 0 0;">
                <h5 class="mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clipboard-x me-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6.146 7.146a.5.5 0 0 1 .708 0L8 8.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 9l1.147 1.146a.5.5 0 0 1-.708.708L8 9.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 9 6.146 7.854a.5.5 0 0 1 0-.708"/>
                    </svg>
                    Besoins Non Satisfaits
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background: #f7fafc;">
                            <tr>
                                <th style="color: #2c5282;">Ville</th>
                                <th style="color: #2c5282;">Type</th>
                                <th style="color: #2c5282;">Qté Restante</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($besoins_non_satisfaits)): ?>
                                <?php foreach ($besoins_non_satisfaits as $besoin): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($besoin['ville_nom']) ?></strong></td>
                                    <td><span class="badge-besoin"><?= htmlspecialchars($besoin['type_don']) ?></span></td>
                                    <td><strong><?= $besoin['quantite_restante'] ?></strong></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">
                                        Tous les besoins sont satisfaits!
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Historique des dispatches -->
<div class="card card-custom">
    <div class="card-header card-header-custom">
        <h5 class="mb-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clock-history me-2" viewBox="0 0 16 16">
                <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z"/>
                <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z"/>
                <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5"/>
            </svg>
            Historique des Dispatches
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead style="background: #f7fafc;">
                    <tr>
                        <th style="color: #2c5282;">Date Dispatch</th>
                        <th style="color: #2c5282;">Type de Don</th>
                        <th style="color: #2c5282;">Ville Bénéficiaire</th>
                        <th style="color: #2c5282;">Quantité Attribuée</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($dispatches)): ?>
                        <?php foreach ($dispatches as $dispatch): ?>
                        <tr>
                            <td><?= date('d/m/Y H:i', strtotime($dispatch['date_dispatch'])) ?></td>
                            <td><span class="badge-dispatch"><?= htmlspecialchars($dispatch['type_don']) ?></span></td>
                            <td><strong><?= htmlspecialchars($dispatch['ville_nom']) ?></strong></td>
                            <td><?= $dispatch['quantite_attribuee'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                Aucun dispatch effectué
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Dispatch manuel (optionnel) -->
<div class="card card-custom mt-4">
    <div class="card-header" style="background: #718096; color: white; border-radius: 12px 12px 0 0;">
        <h5 class="mb-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-hand-index me-2" viewBox="0 0 16 16">
                <path d="M6.75 1a.75.75 0 0 1 .75.75V8a.5.5 0 0 0 1 0V5.467l.086-.004c.317-.012.637-.008.816.027.134.027.294.096.448.182.077.042.15.147.15.314V8a.5.5 0 1 0 1 0V6.435a4.9 4.9 0 0 1 .106-.01c.316-.024.584-.01.708.04.118.046.3.207.486.43.081.096.15.19.2.259V8.5a.5.5 0 0 0 1 0v-1h.342a1 1 0 0 1 .995 1.1l-.271 2.715a2.5 2.5 0 0 1-.317.991l-1.395 2.442a.5.5 0 0 1-.434.252H6.035a.5.5 0 0 1-.416-.223l-1.433-2.15a1.5 1.5 0 0 1-.243-.666l-.345-3.105a.5.5 0 0 1 .399-.546L5 8.11V9a.5.5 0 0 0 1 0V1.75A.75.75 0 0 1 6.75 1"/>
            </svg>
            Dispatch Manuel
        </h5>
    </div>
    <div class="card-body">
        <form action="/dispatch/manual" method="POST" class="row g-3">
            <div class="col-md-3">
                <label class="form-label fw-bold">Don à distribuer</label>
                <select name="id_don" class="form-select form-control-custom" required>
                    <option value="">-- Sélectionner --</option>
                    <?php if (!empty($dons_disponibles)): ?>
                        <?php foreach ($dons_disponibles as $don): ?>
                            <option value="<?= $don['id'] ?>">
                                <?= htmlspecialchars($don['type_don']) ?> (<?= $don['quantite_disponible'] ?> dispo)
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold">Ville bénéficiaire</label>
                <select name="id_ville" class="form-select form-control-custom" required>
                    <option value="">-- Sélectionner --</option>
                    <?php if (!empty($villes)): ?>
                        <?php foreach ($villes as $ville): ?>
                            <option value="<?= $ville['id'] ?>"><?= htmlspecialchars($ville['nom']) ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold">Quantité</label>
                <input type="number" name="quantite" class="form-control form-control-custom" min="1" required>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary-custom w-100">
                    Attribuer manuellement
                </button>
            </div>
        </form>
    </div>
</div>
