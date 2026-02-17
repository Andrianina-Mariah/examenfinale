<form action="<?= BASE_URL ?>/achats/besoins" method="GET" class="card shadow-sm border-0 rounded-3 mb-4">
    <div class="card-body p-4 row align-items-end g-3">
        <div class="col-md-6">
            <label class="form-label fw-bold text-dark">
                <i class="bi bi-funnel-fill text-primary me-1"></i> Filtrer par ville
            </label>
            <select name="id_ville" class="form-select form-select-lg shadow-sm">
                <option value="">Toutes les villes</option>
                <?php foreach($villes as $v): ?>
                    <option value="<?= $v->getId() ?>" <?= (isset($id_ville_selectionnee) && $id_ville_selectionnee == $v->getId()) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($v->getNom()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm">
                <i class="bi bi-search me-1"></i> Filtrer
            </button>
        </div>
        <div class="col-md-3">
            <a href="<?= BASE_URL ?>/achats/besoins" class="btn btn-outline-secondary btn-lg w-100">
                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
            </a>
        </div>
    </div>
</form>

<div class="row g-4">
    <?php if(empty($besoins)): ?>
        <div class="col-12 text-center py-5">
            <i class="bi bi-check2-circle text-success display-1"></i>
            <p class="mt-3 text-muted">Tous les besoins sont comblés ou aucun besoin ne correspond à votre filtre.</p>
        </div>
    <?php endif; ?>

    <?php foreach ($besoins as $b): 
        // Bloquer l'achat si un don en nature (quantité) existe encore
        $disabled = ($b['stock_nature_dispo'] > 0); 
    ?>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm rounded-3 <?= $disabled ? 'bg-light bg-opacity-50' : '' ?>">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                        <i class="bi bi-geo-alt-fill me-1"></i> <?= $b['ville_nom'] ?>
                    </span>
                    <span class="badge bg-light text-dark border"><?= $b['type_nom'] ?></span>
                </div>

                <?php if($disabled): ?>
                    <div class="alert alert-warning py-2 small mb-3 border-0">
                        <i class="bi bi-info-circle-fill me-1"></i> Don direct dispo (<?= (int)$b['stock_nature_dispo'] ?>)
                    </div>
                <?php endif; ?>

                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="bg-light rounded-3 p-2 text-center">
                            <small class="text-muted d-block">Reste</small>
                            <strong class="text-dark"><?= $b['qte_restante'] ?></strong>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-light rounded-3 p-2 text-center">
                            <small class="text-muted d-block">P.U.</small>
                            <strong class="text-dark"><?= number_format($b['prix_unitaire'], 0, '.', ' ') ?> Ar</strong>
                        </div>
                    </div>
                </div>

                <form action="/achats/effectuer" method="POST">
                    <input type="hidden" name="id_besoin" value="<?= $b['besoin_id'] ?>">
                    
                    <div class="mb-3">
                        <label class="form-label small text-muted fw-bold">Quantité à acheter</label>
                        <input type="number" name="quantite" class="form-control shadow-sm" 
                               min="1" max="<?= $b['qte_restante'] ?>" placeholder="Saisir qté..."
                               oninput="calculerTotalAchat(this, <?= $b['prix_unitaire'] ?>, <?= $frais ?>)"
                               required <?= $disabled ? 'disabled' : '' ?>>
                    </div>

                    <div class="bg-warning bg-opacity-10 rounded-3 p-3 mb-3 text-center">
                        <small class="text-muted d-block mb-1">Total (avec <?= $frais ?>% frais)</small>
                        <h5 class="fw-bold text-warning mb-0 total-affichage">0 Ar</h5>
                    </div>

                    <button type="submit" class="btn btn-success w-100 shadow-sm py-2" <?= $disabled ? 'disabled' : '' ?>>
                        <i class="bi bi-cart-plus-fill me-1"></i> Confirmer l'achat
                    </button>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<script>
function calculerTotalAchat(input, pu, tauxFrais) {
    const qte = input.value;
    const container = input.closest('.card-body').querySelector('.total-affichage');
    if (qte > 0) {
        // Logique : (Quantité * PU) + (Quantité * PU * Frais/100)
        let total = (qte * pu) * (1 + (tauxFrais / 100));
        container.innerText = new Intl.NumberFormat('fr-FR').format(total) + ' Ar';
    } else {
        container.innerText = '0 Ar';
    }
}
</script>