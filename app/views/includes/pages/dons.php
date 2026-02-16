<!-- dons.php - Saisie des dons reçus -->
<div class="page-header">
    <h2>Saisie des Dons</h2>
    <p class="text-muted mb-0">Enregistrer les dons reçus pour distribution aux sinistrés</p>
</div>

<?php if (isset($success) && $success): ?>
<div class="alert alert-success alert-dismissible fade show alert-custom" role="alert">
    <strong>Succès!</strong> Le don a été enregistré avec succès.
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
            <div class="card-header" style="background: linear-gradient(135deg, #4a7c59 0%, #3d6348 100%); color: white; border-radius: 12px 12px 0 0;">
                <h5 class="mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-gift me-2" viewBox="0 0 16 16">
                        <path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A3 3 0 0 1 3 2.506zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43z"/>
                    </svg>
                    Nouveau Don
                </h5>
            </div>
            <div class="card-body">
                <form action="/dons/store" method="POST" id="formDon">
                    <!-- Catégorie -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tags me-1" viewBox="0 0 16 16">
                                <path d="M3 2v4.586l7 7L14.586 9l-7-7zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586z"/>
                            </svg>
                            Catégorie du don *
                        </label>
                        <select name="id_categorie" id="categorieSelectDon" class="form-select form-control-custom" required>
                            <option value="">-- Sélectionner une catégorie --</option>
                            <?php if (!empty($categories)): ?>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nom']) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <!-- Type de don -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box me-1" viewBox="0 0 16 16">
                                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923z"/>
                            </svg>
                            Type de don *
                        </label>
                        <select name="id_type_don" id="typeDonSelectDon" class="form-select form-control-custom" required>
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
                        <label class="form-label fw-bold">Quantité reçue *</label>
                        <input type="number" name="quantite" class="form-control form-control-custom" min="1" required placeholder="Ex: 50">
                    </div>

                    <!-- Date de réception -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Date de réception *</label>
                        <input type="date" name="date_saisie" class="form-control form-control-custom" value="<?= date('Y-m-d') ?>" required>
                        <small class="text-muted">Les dons sont dispatchés par ordre de date de saisie</small>
                    </div>

                    <button type="submit" class="btn btn-success-custom w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg me-1" viewBox="0 0 16 16">
                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
                        </svg>
                        Enregistrer le don
                    </button>
                </form>

                <!-- Ajouter nouveau type -->
                <div class="mt-4 pt-3 border-top">
                    <h6 class="text-muted mb-3">Nouveau type de don?</h6>
                    <form action="/types-don/store" method="POST" class="row g-2">
                        <div class="col-12">
                            <input type="text" name="nom_type" class="form-control form-control-custom" placeholder="Nom du nouveau type" required>
                        </div>
                        <div class="col-8">
                            <select name="id_categorie_new" class="form-select form-control-custom" required>
                                <option value="">Catégorie</option>
                                <?php if (!empty($categories)): ?>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nom']) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-outline-primary w-100">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des dons récents -->
    <div class="col-lg-7">
        <div class="card card-custom">
            <div class="card-header" style="background: #4a7c59; color: white; border-radius: 12px 12px 0 0;">
                <h5 class="mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-list-check me-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                    </svg>
                    Dons Reçus (par ordre de date)
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background: #f7fafc;">
                            <tr>
                                <th style="color: #2c5282;">Date réception</th>
                                <th style="color: #2c5282;">Type</th>
                                <th style="color: #2c5282;">Catégorie</th>
                                <th style="color: #2c5282;">Quantité</th>
                                <th style="color: #2c5282;">Disponible</th>
                                <th style="color: #2c5282;">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($dons)): ?>
                                <?php foreach ($dons as $don): ?>
                                <tr>
                                    <td><?= date('d/m/Y', strtotime($don['date_saisie'])) ?></td>
                                    <td>
                                        <span class="badge-don"><?= htmlspecialchars($don['type_don']) ?></span>
                                    </td>
                                    <td><?= htmlspecialchars($don['categorie'] ?? 'N/A') ?></td>
                                    <td><strong><?= $don['quantite'] ?></strong></td>
                                    <td><?= $don['quantite_disponible'] ?? $don['quantite'] ?></td>
                                    <td>
                                        <?php 
                                            $disponible = $don['quantite_disponible'] ?? $don['quantite'];
                                            $total = $don['quantite'];
                                            if ($disponible == 0) {
                                                echo '<span class="badge bg-secondary">Distribué</span>';
                                            } elseif ($disponible < $total) {
                                                echo '<span class="badge bg-warning text-dark">Partiel</span>';
                                            } else {
                                                echo '<span class="badge bg-success">Disponible</span>';
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        Aucun don enregistré
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Résumé par catégorie -->
        <div class="row mt-4">
            <?php if (!empty($resume_categories)): ?>
                <?php foreach ($resume_categories as $cat): ?>
                <div class="col-md-4 mb-3">
                    <div class="stat-card">
                        <div class="stat-number" style="color: #4a7c59;"><?= $cat['total'] ?></div>
                        <div class="stat-label"><?= htmlspecialchars($cat['nom']) ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
// Filtrer les types de don selon la catégorie sélectionnée
document.getElementById('categorieSelectDon').addEventListener('change', function() {
    const categorieId = this.value;
    const typeDonSelect = document.getElementById('typeDonSelectDon');
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
