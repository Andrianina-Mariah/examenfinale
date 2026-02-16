<!-- besoins.php - Saisie des besoins par ville -->
<div class="page-header">
    <h2>Saisie des Besoins</h2>
    <p class="text-muted mb-0">Enregistrer les besoins des sinistrés par ville</p>
</div>

<?php if (isset($success) && $success): ?>
<div class="alert alert-success alert-dismissible fade show alert-custom" role="alert">
    <strong>Succès!</strong> Le besoin a été enregistré avec succès.
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<?php if (isset($error) && $error): ?>
<div class="alert alert-danger alert-dismissible fade show alert-custom" role="alert">
    <strong>Erreur!</strong> <?= htmlspecialchars($error) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="row">
    <!-- Formulaire de saisie -->
    <div class="col-lg-5">
        <div class="card card-custom">
            <div class="card-header card-header-custom">
                <h5 class="mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clipboard-plus me-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7"/>
                    </svg>
                    Nouveau Besoin
                </h5>
            </div>
            <div class="card-body">
                <form action="/besoins/store" method="POST" id="formBesoin">
                    <!-- Sélection de la ville -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt me-1" viewBox="0 0 16 16">
                                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                            </svg>
                            Ville sinistrée *
                        </label>
                        <select name="id_ville" class="form-select form-control-custom" required>
                            <option value="">-- Sélectionner une ville --</option>
                            <?php if (!empty($villes)): ?>
                                <?php foreach ($villes as $ville): ?>
                                    <option value="<?= $ville['id'] ?>" <?= (isset($selectedVille) && $selectedVille == $ville['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($ville['nom']) ?> (<?= htmlspecialchars($ville['region_nom'] ?? '') ?>)
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <!-- Catégorie -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tags me-1" viewBox="0 0 16 16">
                                <path d="M3 2v4.586l7 7L14.586 9l-7-7zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586z"/>
                                <path d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3M1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1z"/>
                            </svg>
                            Catégorie *
                        </label>
                        <select name="id_categorie" id="categorieSelect" class="form-select form-control-custom" required>
                            <option value="">-- Sélectionner une catégorie --</option>
                            <?php if (!empty($categories)): ?>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nom']) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <small class="text-muted">Nature (riz, huile...), Matériaux (tôle, clou...), Argent</small>
                    </div>

                    <!-- Type de don -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box me-1" viewBox="0 0 16 16">
                                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z"/>
                            </svg>
                            Type de don *
                        </label>
                        <select name="id_type_don" id="typeDonSelect" class="form-select form-control-custom" required>
                            <option value="">-- Sélectionnez d'abord une catégorie --</option>
                            <?php if (!empty($types_don)): ?>
                                <?php foreach ($types_don as $type): ?>
                                    <option value="<?= $type['id'] ?>" data-categorie="<?= $type['id_categorie'] ?>">
                                        <?= htmlspecialchars($type['nom']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <hr>

                    <!-- Quantité -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Quantité nécessaire *</label>
                        <input type="number" name="quantite" class="form-control form-control-custom" min="1" required placeholder="Ex: 100">
                    </div>

                    <!-- Prix unitaire -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Prix unitaire (Ar) *</label>
                        <input type="number" name="prix_unitaire" class="form-control form-control-custom" min="0" step="0.01" required placeholder="Ex: 2500">
                        <small class="text-muted">Le prix unitaire reste fixe une fois saisi</small>
                    </div>

                    <!-- Date de saisie -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Date de saisie</label>
                        <input type="date" name="date_saisie" class="form-control form-control-custom" value="<?= date('Y-m-d') ?>" required>
                    </div>

                    <button type="submit" class="btn btn-success-custom w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg me-1" viewBox="0 0 16 16">
                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
                        </svg>
                        Enregistrer le besoin
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Liste des besoins récents -->
    <div class="col-lg-7">
        <div class="card card-custom">
            <div class="card-header" style="background: #ed8936; color: white; border-radius: 12px 12px 0 0;">
                <h5 class="mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-list-ul me-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                    </svg>
                    Besoins Enregistrés
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background: #f7fafc;">
                            <tr>
                                <th style="color: #2c5282;">Date</th>
                                <th style="color: #2c5282;">Ville</th>
                                <th style="color: #2c5282;">Type</th>
                                <th style="color: #2c5282;">Quantité</th>
                                <th style="color: #2c5282;">Prix U.</th>
                                <th style="color: #2c5282;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($besoins)): ?>
                                <?php foreach ($besoins as $besoin): ?>
                                <tr>
                                    <td><?= date('d/m/Y', strtotime($besoin['date_saisie'])) ?></td>
                                    <td><strong><?= htmlspecialchars($besoin['ville_nom']) ?></strong></td>
                                    <td>
                                        <span class="badge-besoin"><?= htmlspecialchars($besoin['type_don']) ?></span>
                                    </td>
                                    <td><?= $besoin['quantite'] ?></td>
                                    <td><?= number_format($besoin['prix_unitaire'], 0, ',', ' ') ?> Ar</td>
                                    <td><strong><?= number_format($besoin['quantite'] * $besoin['prix_unitaire'], 0, ',', ' ') ?> Ar</strong></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        Aucun besoin enregistré
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

<script>
// Filtrer les types de don selon la catégorie sélectionnée
document.getElementById('categorieSelect').addEventListener('change', function() {
    const categorieId = this.value;
    const typeDonSelect = document.getElementById('typeDonSelect');
    const options = typeDonSelect.querySelectorAll('option[data-categorie]');
    
    typeDonSelect.value = '';
    
    options.forEach(function(option) {
        if (categorieId === '' || option.dataset.categorie === categorieId) {
            option.style.display = '';
        } else {
            option.style.display = 'none';
        }
    });
});
</script>
