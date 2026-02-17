<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-11 col-lg-10">
            <!-- Breadcrumb et en-tête -->
            <div class="mb-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/" class="text-decoration-none"><i class="bi bi-house-door"></i> Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Saisie besoin</li>
                    </ol>
                </nav>
                <div class="d-flex align-items-center mb-2">
                    <div class="bg-primary text-white rounded-circle p-3 me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-clipboard-heart fs-4"></i>
                    </div>
                    <div>
                        <h2 class="mb-0 fw-bold text-dark">Enregistrer un Besoin</h2>
                        <p class="text-muted mb-0 small">Déclarez les besoins des sinistrés pour votre ville</p>
                    </div>
                </div>
            </div>

            <form action="<?= BASE_URL ?>/besoin/enregistrer" method="POST">
                
                <!-- ÉTAPE 1 : Localisation -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-gradient py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <h5 class="mb-0 text-white fw-bold">
                            <span class="badge bg-white text-primary rounded-circle me-2">1</span>
                            Localisation et Date
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark d-flex align-items-center mb-2">
                                    <i class="bi bi-geo-alt-fill text-danger me-2 fs-5"></i> 
                                    Ville concernée <span class="text-danger">*</span>
                                </label>
                                <select name="id_ville" class="form-select form-select-lg shadow-sm" required>
                                    <option value="">Choisissez la ville...</option>
                                    <?php foreach($villes as $v): ?>
                                        <option value="<?= $v->getId() ?>"><?= htmlspecialchars($v->getNom()) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="form-text">
                                    <i class="bi bi-info-circle"></i> Sélectionnez la ville où se trouve le besoin
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark d-flex align-items-center mb-2">
                                    <i class="bi bi-calendar3 text-primary me-2 fs-5"></i> 
                                    Date de saisie <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="date_saisie" class="form-control form-control-lg shadow-sm" value="<?= date('Y-m-d') ?>" required>
                                <div class="form-text">
                                    <i class="bi bi-info-circle"></i> Date d'enregistrement du besoin
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ÉTAPE 2 : Type de besoin -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-gradient py-3" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <h5 class="mb-0 text-white fw-bold">
                            <span class="badge bg-white text-danger rounded-circle me-2">2</span>
                            Type de Besoin
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="alert alert-info border-0 shadow-sm mb-4">
                            <i class="bi bi-lightbulb-fill me-2"></i>
                            <strong>Conseil :</strong> Choisissez un type existant OU créez-en un nouveau si nécessaire
                        </div>

                        <div class="row g-4">
                            <!-- Option 1 : Type existant -->
                            <div class="col-md-6">
                                <div class="card h-100 border-2 border-primary">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="bg-primary bg-opacity-10 rounded p-2 me-2">
                                                <i class="bi bi-list-check text-primary fs-4"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold text-dark">Option 1</h6>
                                                <small class="text-muted">Type existant</small>
                                            </div>
                                        </div>
                                        
                                        <!-- Sélection de la catégorie -->
                                        <label class="form-label fw-bold text-dark small mb-2">
                                            <i class="bi bi-tag-fill text-primary me-1"></i> Catégorie
                                        </label>
                                        <select id="categorie_besoin" class="form-select form-select-lg shadow-sm mb-3">
                                            <option value="">-- Choisir une catégorie --</option>
                                            <?php foreach($categories as $c): ?>
                                                <option value="<?= $c->getId() ?>" data-nom="<?= strtolower(htmlspecialchars($c->getNom())) ?>"><?= htmlspecialchars($c->getNom()) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        
                                        <!-- Liste déroulante des types (pour Nature et Materiel) -->
                                        <div id="type_don_container_besoin">
                                            <label class="form-label fw-bold text-dark small mb-2">
                                                Type de don
                                            </label>
                                            <select name="id_type_don" id="type_don_select_besoin" class="form-select form-select-lg shadow-sm">
                                                <option value="">-- Sélectionnez d'abord une catégorie --</option>
                                            </select>
                                        </div>
                                        
                                        <!-- Input montant (pour Argent) -->
                                        <div id="montant_container_besoin" style="display: none;">
                                            <label class="form-label fw-bold text-dark small mb-2">
                                                <i class="bi bi-cash-coin text-success me-1"></i> Montant en Ariary
                                            </label>
                                            <div class="input-group input-group-lg shadow-sm">
                                                <input type="number" name="montant_argent" id="montant_argent_besoin" class="form-control" placeholder="0" min="0" step="1">
                                                <span class="input-group-text bg-light fw-bold">Ar</span>
                                            </div>
                                        </div>
                                        
                                        <div class="form-text mt-2">
                                            Types déjà enregistrés dans le système
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Option 2 : Nouveau type -->
                            <div class="col-md-6">
                                <div class="card h-100 border-2 border-success bg-light">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="bg-success bg-opacity-10 rounded p-2 me-2">
                                                <i class="bi bi-plus-circle-fill text-success fs-4"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold text-dark">Option 2</h6>
                                                <small class="text-muted">Créer un nouveau</small>
                                            </div>
                                        </div>

                                        <label class="form-label fw-bold text-success small mb-2">
                                            Nom du nouveau type
                                        </label>
                                        <input type="text" name="nouveau_type_nom" class="form-control form-control-lg mb-3 shadow-sm" placeholder="Ex: Kit hygiène, Couverture...">
                                        
                                        <label class="form-label fw-bold text-success small mb-2">
                                            Catégorie associée
                                        </label>
                                        <select name="id_categorie_nouveau" class="form-select shadow-sm">
                                            <option value="">-- Sélectionner --</option>
                                            <?php foreach($categories as $c): ?>
                                                <option value="<?= $c->getId() ?>"><?= htmlspecialchars($c->getNom()) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="form-text mt-2">
                                            Si le type n'existe pas encore
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Script pour le formulaire besoin -->
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
                            
                            const categorieSelect = document.getElementById('categorie_besoin');
                            const typeDonContainer = document.getElementById('type_don_container_besoin');
                            const typeDonSelect = document.getElementById('type_don_select_besoin');
                            const montantContainer = document.getElementById('montant_container_besoin');
                            const montantInput = document.getElementById('montant_argent_besoin');
                            const quantitePrixCard = document.getElementById('quantite_prix_card_besoin');
                            const quantiteInput = document.getElementById('quantite_besoin');
                            const prixInput = document.getElementById('prix_unitaire_besoin');
                            const typeCategorieInput = document.getElementById('type_categorie_besoin');
                            
                            categorieSelect.addEventListener('change', function() {
                                const selectedOption = this.options[this.selectedIndex];
                                const categorieNom = selectedOption.dataset.nom || '';
                                const categorieId = this.value;
                                
                                if (categorieNom.includes('argent')) {
                                    // Afficher l'input montant, cacher la liste des types et la section quantité/prix
                                    typeDonContainer.style.display = 'none';
                                    montantContainer.style.display = 'block';
                                    quantitePrixCard.style.display = 'none';
                                    typeDonSelect.value = '';
                                    typeDonSelect.removeAttribute('required');
                                    quantiteInput.removeAttribute('required');
                                    prixInput.removeAttribute('required');
                                    quantiteInput.value = '';
                                    prixInput.value = '';
                                    montantInput.setAttribute('required', 'required');
                                    typeCategorieInput.value = 'argent';
                                } else {
                                    // Afficher la liste des types et la section quantité/prix, cacher l'input montant
                                    typeDonContainer.style.display = 'block';
                                    montantContainer.style.display = 'none';
                                    quantitePrixCard.style.display = 'block';
                                    montantInput.value = '';
                                    montantInput.removeAttribute('required');
                                    quantiteInput.setAttribute('required', 'required');
                                    prixInput.setAttribute('required', 'required');
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
                        <input type="hidden" name="type_categorie" id="type_categorie_besoin" value="materiel">
                    </div>
                </div>

                <!-- ÉTAPE 3 : Quantité et Prix -->
                <div class="card shadow-sm border-0 mb-4" id="quantite_prix_card_besoin">
                    <div class="card-header bg-gradient py-3" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                        <h5 class="mb-0 text-white fw-bold">
                            <span class="badge bg-white text-warning rounded-circle me-2">3</span>
                            Quantité et Valeur
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark d-flex align-items-center mb-2">
                                    <i class="bi bi-boxes text-warning me-2 fs-5"></i> 
                                    Quantité nécessaire <span class="text-danger">*</span>
                                </label>
                                <div class="input-group input-group-lg shadow-sm">
                                    <input type="number" name="quantite" id="quantite_besoin" class="form-control" placeholder="Nombre d'unités" min="1" required>
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-hash"></i> unités
                                    </span>
                                </div>
                                <div class="form-text">
                                    <i class="bi bi-info-circle"></i> Nombre total d'unités requises
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark d-flex align-items-center mb-2">
                                    <i class="bi bi-cash-coin text-success me-2 fs-5"></i> 
                                    Prix Unitaire <span class="text-danger">*</span>
                                </label>
                                <div class="input-group input-group-lg shadow-sm">
                                    <input type="number" step="0.01" name="prix_unitaire" id="prix_unitaire_besoin" class="form-control" placeholder="0.00" min="0" required>
                                    <span class="input-group-text bg-light fw-bold">Ar</span>
                                </div>
                                <div class="form-text">
                                    <i class="bi bi-info-circle"></i> Prix pour une unité en Ariary
                                </div>
                            </div>
                        </div>

                        <!-- Calcul automatique visuel -->
                        <div class="alert alert-light border mt-4 mb-0">
                            <div class="row text-center">
                                <div class="col">
                                    <i class="bi bi-calculator text-muted d-block fs-3 mb-2"></i>
                                    <small class="text-muted">Valeur totale calculée automatiquement lors de la soumission</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <a href="/" class="btn btn-lg btn-outline-secondary px-4">
                                <i class="bi bi-x-circle me-2"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-lg btn-success px-5 shadow">
                                <i class="bi bi-check-circle-fill me-2"></i> Enregistrer le Besoin
                            </button>
                        </div>
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                <i class="bi bi-shield-check"></i> Toutes les données sont sécurisées
                            </small>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>