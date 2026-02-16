<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Saisie des besoins des sinistrés</h4>
    </div>
    <div class="card-body">
        <form action="/besoin/enregistrer" method="POST">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Ville</label>
                    <select name="id_ville" class="form-select" required>
                        <?php foreach($villes as $v): ?>
                            <option value="<?= $v->getId() ?>"><?= $v->getNom() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Date de saisie</label>
                    <input type="date" name="date_saisie" class="form-control" value="<?= date('Y-m-d') ?>" required>
                </div>
            </div>

            <div class="border p-3 mb-3 bg-light">
                <h6>Nature du besoin</h6>
                <div class="row">
                    <div class="col-md-6">
                        <label class="small">Type de don existant</label>
                        <select name="id_type_don" class="form-select">
                            <option value="">-- Sélectionner --</option>
                            <?php foreach($types as $t): ?>
                                <option value="<?= $t->getId() ?>"><?= $t->getNom() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="small text-primary">Ou créer un nouveau type</label>
                        <input type="text" name="nouveau_type_nom" class="form-control mb-1" placeholder="Nom">
                        <select name="id_categorie_nouveau" class="form-select form-select-sm">
                            <option value="">-- Catégorie --</option>
                            <?php foreach($categories as $c): ?>
                                <option value="<?= $c->getId() ?>"><?= $c->getNom() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Quantité</label>
                    <input type="number" name="quantite" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Prix Unitaire</label>
                    <input type="number" step="0.01" name="prix_unitaire" class="form-control" required>
                </div>
            </div>

            <button type="submit" class="btn btn-success mt-4 w-100">Enregistrer le besoin</button>
        </form>
    </div>
</div>