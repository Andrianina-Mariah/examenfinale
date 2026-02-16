<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mb-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Saisie don</li>
                    </ol>
                </nav>
            </div>

            <div class="card shadow border-0">
                <div class="card-header bg-success text-white py-3">
                    <h4 class="mb-0"><i class="bi bi-gift"></i> Saisie d'un Nouveau Don</h4>
                </div>
                <div class="card-body p-4">
                    <form action="/don/enregistrer" method="POST">
                        
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label class="form-label fw-bold text-dark">
                                    <i class="bi bi-calendar-check text-success"></i> Date de Réception du Don
                                </label>
                                <input type="date" name="date_saisie" class="form-control form-control-lg" value="<?= date('Y-m-d') ?>" required>
                            </div>
                        </div>

                        <div class="p-4 border rounded bg-light mb-4">
                            <h5 class="text-dark border-bottom pb-3 mb-4">
                                <i class="bi bi-info-circle text-success"></i> Informations sur l'article
                            </h5>
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">
                                        <i class="bi bi-tag-fill text-success me-1"></i> Catégorie
                                    </label>
                                    <select id="categorie_don" class="form-select form-select-lg mb-3">
                                        <option value="">-- Choisir une catégorie --</option>
                                        <?php foreach($categories as $c): ?>
                                            <option value="<?= $c->getId() ?>" data-nom="<?= strtolower(htmlspecialchars($c->getNom())) ?>"><?= htmlspecialchars($c->getNom()) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    
                                    <!-- Liste déroulante des types (pour Nature et Materiel) -->
                                    <div id="type_don_container_don">
                                        <label class="form-label fw-bold text-dark">Type de Don</label>
                                        <select name="id_type_don" id="type_don_select_don" class="form-select form-select-lg">
                                            <option value="">-- Sélectionnez d'abord une catégorie --</option>
                                        </select>
                                    </div>
                                    
                                    <!-- Input montant (pour Argent) -->
                                    <div id="montant_container_don" style="display: none;">
                                        <label class="form-label fw-bold text-dark">
                                            <i class="bi bi-cash-coin text-success me-1"></i> Montant en Ariary
                                        </label>
                                        <div class="input-group input-group-lg">
                                            <input type="number" name="montant_argent" id="montant_argent_don" class="form-control" placeholder="0" min="0" step="1">
                                            <span class="input-group-text bg-light fw-bold">Ar</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-4 border-start border-success border-3 bg-white shadow-sm rounded h-100">
                                        <label class="form-label fw-bold text-success">
                                            <i class="bi bi-plus-circle-fill"></i> Ou créer un nouveau type
                                        </label>
                                        <input type="text" name="nouveau_type_nom" class="form-control mb-3" placeholder="Ex: Kit hygiène">
                                        
                                        <label class="form-label small fw-bold text-dark">Catégorie</label>
                                        <select name="id_categorie_nouveau" class="form-select">
                                            <option value="">-- Choisir une catégorie --</option>
                                            <?php foreach($categories as $c): ?>
                                                <option value="<?= $c->getId() ?>"><?= htmlspecialchars($c->getNom()) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Script pour le formulaire don -->
                                <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Données des types groupés par catégorie
                                    const typesByCategorie = {
                                        <?php foreach($categories as $c): ?>
                                        <?= $c->getId() ?>: [
                                            <?php foreach($types as $t): ?>
                                                <?php if($t->getIdCategorie() == $c->getId()): ?>
                                            {id: <?= $t->getId() ?>, nom: "<?= addslashes(htmlspecialchars($t->getNom())) ?>"},
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        ],
                                        <?php endforeach; ?>
                                    };
                                    
                                    const categorieSelect = document.getElementById('categorie_don');
                                    const typeDonContainer = document.getElementById('type_don_container_don');
                                    const typeDonSelect = document.getElementById('type_don_select_don');
                                    const montantContainer = document.getElementById('montant_container_don');
                                    const montantInput = document.getElementById('montant_argent_don');
                                    const quantiteContainer = document.getElementById('quantite_container_don');
                                    const quantiteInput = document.getElementById('quantite_don');
                                    const typeCategorieInput = document.getElementById('type_categorie');
                                    
                                    categorieSelect.addEventListener('change', function() {
                                        const selectedOption = this.options[this.selectedIndex];
                                        const categorieNom = selectedOption.dataset.nom || '';
                                        const categorieId = this.value;
                                        
                                        if (categorieNom.includes('argent')) {
                                            // Afficher l'input montant, cacher la liste des types et la quantité
                                            typeDonContainer.style.display = 'none';
                                            montantContainer.style.display = 'block';
                                            quantiteContainer.style.display = 'none';
                                            typeDonSelect.value = '';
                                            typeDonSelect.removeAttribute('required');
                                            quantiteInput.removeAttribute('required');
                                            quantiteInput.value = '';
                                            montantInput.setAttribute('required', 'required');
                                            typeCategorieInput.value = 'argent';
                                        } else {
                                            // Afficher la liste des types et la quantité, cacher l'input montant
                                            typeDonContainer.style.display = 'block';
                                            montantContainer.style.display = 'none';
                                            quantiteContainer.style.display = 'block';
                                            montantInput.value = '';
                                            montantInput.removeAttribute('required');
                                            quantiteInput.setAttribute('required', 'required');
                                            typeCategorieInput.value = 'materiel';
                                            
                                            // Remplir la liste des types
                                            typeDonSelect.innerHTML = '<option value="">-- Choisir un type --</option>';
                                            if (categorieId && typesByCategorie[categorieId]) {
                                                typesByCategorie[categorieId].forEach(function(type) {
                                                    const option = document.createElement('option');
                                                    option.value = type.id;
                                                    option.textContent = type.nom;
                                                    typeDonSelect.appendChild(option);
                                                });
                                            }
                                        }
                                    });
                                });
                                </script>

                                <!-- Champ caché pour le type de catégorie -->
                                <input type="hidden" name="type_categorie" id="type_categorie" value="materiel">

                                <div class="col-md-12" id="quantite_container_don">
                                    <label class="form-label fw-bold text-dark">
                                        <i class="bi bi-box text-success"></i> Quantité Offerte
                                    </label>
                                    <input type="number" name="quantite" id="quantite_don" class="form-control form-control-lg" placeholder="0" required>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <a href="/" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-success btn-lg px-5 fw-bold">
                                <i class="bi bi-check-circle"></i> Enregistrer le Don
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>