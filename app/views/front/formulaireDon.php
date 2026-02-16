<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Saisie d'un Nouveau Don</h4>
            </div>
            <div class="card-body">
                <form action="/don/enregistrer" method="POST">
                    
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Date de Réception du Don</label>
                            <input type="date" name="date_saisie" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>

                    <div class="p-3 border rounded bg-light mb-4">
                        <h5 class="text-secondary border-bottom pb-2 mb-3">Informations sur l'article</h5>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Type de Don (Existant)</label>
                                <select name="id_type_don" class="form-select">
                                    <option value="">-- Sélectionner si présent --</option>
                                    <?php foreach($types as $t): ?>
                                        <option value="<?= $t->getId() ?>"><?= $t->getNom() ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 border-start border-success bg-white shadow-sm">
                                    <label class="form-label fw-bold text-success">Ou créer un nouveau type</label>
                                    <input type="text" name="nouveau_type_nom" class="form-control mb-2" placeholder="Ex: Kit hygiène">
                                    
                                    <label class="form-label small fw-bold">Catégorie</label>
                                    <select name="id_categorie_nouveau" class="form-select form-select-sm">
                                        <option value="">-- Choisir une catégorie --</option>
                                        <?php foreach($categories as $c): ?>
                                            <option value="<?= $c->getId() ?>"><?= $c->getNom() ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-bold">Quantité Offerte</label>
                                <input type="number" name="quantite" class="form-control" placeholder="0" required>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="/accueil" class="btn btn-outline-secondary">Annuler</a>
                        <button type="submit" class="btn btn-success px-5 fw-bold">Enregistrer le Don</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>