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
                                    <label class="form-label fw-bold text-dark">Type de Don (Existant)</label>
                                    <select name="id_type_don" class="form-select form-select-lg">
                                        <option value="">-- Sélectionner si présent --</option>
                                        <?php foreach($types as $t): ?>
                                            <option value="<?= $t->getId() ?>"><?= htmlspecialchars($t->getNom()) ?></option>
                                        <?php endforeach; ?>
                                    </select>
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

                                <div class="col-md-12">
                                    <label class="form-label fw-bold text-dark">
                                        <i class="bi bi-box text-success"></i> Quantité Offerte
                                    </label>
                                    <input type="number" name="quantite" class="form-control form-control-lg" placeholder="0" required>
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