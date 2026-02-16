<div class="container py-5">

    <!-- En-tête de page -->
    <div class="d-flex align-items-center mb-2">
        <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width:54px;height:54px;">
            <i class="bi bi-cart-check-fill text-warning fs-4"></i>
        </div>
        <div>
            <h2 class="fw-bold text-dark mb-0">Achats des Besoins</h2>
            <p class="text-muted mb-0">Achetez les besoins en nature et matériaux via les <strong>dons en argent</strong></p>
        </div>
    </div>

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none"><i class="bi bi-house-door"></i> Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Achats des besoins</li>
        </ol>
    </nav>

    <!-- Filtre par ville -->
    <div class="card shadow-sm border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <div class="row align-items-end g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold text-dark">
                        <i class="bi bi-funnel-fill text-primary me-1"></i> Filtrer par ville
                    </label>
                    <select class="form-select form-select-lg shadow-sm" id="filtre-ville">
                        <option value="">Toutes les villes</option>
                        <!-- données dynamiques ici -->
                        <option disabled class="text-muted">Aucun donné</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary btn-lg w-100 shadow-sm">
                        <i class="bi bi-search me-1"></i> Filtrer
                    </button>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-outline-secondary btn-lg w-100">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Réinitialiser
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Zone d'erreur (si l'achat existe encore dans les dons restants) -->
    <div class="alert alert-danger alert-dismissible fade show d-none rounded-3 shadow-sm" role="alert" id="alerte-achat-existant">
        <div class="d-flex align-items-center">
            <i class="bi bi-exclamation-octagon-fill fs-4 me-3"></i>
            <div>
                <strong>Achat impossible !</strong>
                <span id="msg-erreur-achat">Ce besoin existe encore dans les dons restants. Utilisez le dispatch au lieu d'acheter.</span>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <!-- Info frais d'achat -->
    <div class="card shadow-sm border-0 rounded-3 mb-4 border-start border-warning border-4">
        <div class="card-body p-3 d-flex align-items-center">
            <i class="bi bi-info-circle-fill text-warning fs-4 me-3"></i>
            <div>
                <span class="fw-bold text-dark">Frais d'achat configurables :</span>
                <span class="text-muted">Un taux de <strong class="text-warning" id="taux-frais">10%</strong> est appliqué sur chaque achat.
                (Ex : achat de 100 Ar → total = <strong>110 Ar</strong>)</span>
            </div>
        </div>
    </div>

    <!-- Résumé rapide -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 h-100 border-start border-primary border-4">
                <div class="card-body p-4 text-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:48px;height:48px;">
                        <i class="bi bi-wallet2 text-primary fs-5"></i>
                    </div>
                    <h6 class="text-muted small mb-1">SOLDE DONS ARGENT</h6>
                    <h3 class="fw-bold text-primary mb-0" id="solde-argent">0 Ar</h3>
                    <small class="text-muted">Disponible pour achats</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body p-4 text-center">
                    <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:48px;height:48px;">
                        <i class="bi bi-exclamation-triangle-fill text-danger fs-5"></i>
                    </div>
                    <h6 class="text-muted small mb-1">BESOINS RESTANTS</h6>
                    <h3 class="fw-bold text-danger mb-0">0</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body p-4 text-center">
                    <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:48px;height:48px;">
                        <i class="bi bi-cash-stack text-warning fs-5"></i>
                    </div>
                    <h6 class="text-muted small mb-1">MONTANT ESTIMÉ</h6>
                    <h3 class="fw-bold text-warning mb-0">0 Ar</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body p-4 text-center">
                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:48px;height:48px;">
                        <i class="bi bi-bag-check-fill text-success fs-5"></i>
                    </div>
                    <h6 class="text-muted small mb-1">ACHATS EFFECTUÉS</h6>
                    <h3 class="fw-bold text-success mb-0">0</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des besoins restants (cards) -->
    <h5 class="fw-bold text-dark mb-3">
        <i class="bi bi-grid-3x3-gap-fill text-primary me-2"></i>Besoins restants à acheter
    </h5>

    <div class="row g-4">

        <!-- Card besoin 1 -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3 h-100 hover-shadow">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2">
                            <i class="bi bi-geo-alt-fill me-1"></i> Ville A
                        </span>
                        <span class="badge bg-light text-dark border">Nature</span>
                    </div>
                    <h6 class="fw-bold text-dark mb-2">Aucun donné</h6>
                    <div class="row g-2 mb-3">
                        <div class="col-4">
                            <div class="bg-light rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Qté restante</small>
                                <strong class="text-dark">0</strong>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="bg-light rounded-3 p-2 text-center">
                                <small class="text-muted d-block">P.U.</small>
                                <strong class="text-dark">0 Ar</strong>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="bg-warning bg-opacity-10 rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Frais</small>
                                <strong class="text-warning">10%</strong>
                            </div>
                        </div>
                    </div>
                    <!-- Saisie quantité à acheter -->
                    <div class="mb-3">
                        <label class="form-label small text-muted fw-bold">Quantité à acheter</label>
                        <input type="number" class="form-control shadow-sm qte-achat" min="1" max="0" placeholder="Saisir la quantité">
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-3 p-3 mb-3 text-center">
                        <small class="text-muted d-block mb-1">Total (P.U. × Qté + Frais)</small>
                        <h5 class="fw-bold text-warning mb-0 total-achat">0 Ar</h5>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-success shadow-sm btn-acheter">
                            <i class="bi bi-cart-plus me-1"></i> Acheter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card besoin 2 -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3 h-100 hover-shadow">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2">
                            <i class="bi bi-geo-alt-fill me-1"></i> Ville B
                        </span>
                        <span class="badge bg-light text-dark border">Matériaux</span>
                    </div>
                    <h6 class="fw-bold text-dark mb-2">Aucun donné</h6>
                    <div class="row g-2 mb-3">
                        <div class="col-4">
                            <div class="bg-light rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Qté restante</small>
                                <strong class="text-dark">0</strong>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="bg-light rounded-3 p-2 text-center">
                                <small class="text-muted d-block">P.U.</small>
                                <strong class="text-dark">0 Ar</strong>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="bg-warning bg-opacity-10 rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Frais</small>
                                <strong class="text-warning">10%</strong>
                            </div>
                        </div>
                    </div>
                    <!-- Saisie quantité à acheter -->
                    <div class="mb-3">
                        <label class="form-label small text-muted fw-bold">Quantité à acheter</label>
                        <input type="number" class="form-control shadow-sm qte-achat" min="1" max="0" placeholder="Saisir la quantité">
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-3 p-3 mb-3 text-center">
                        <small class="text-muted d-block mb-1">Total (P.U. × Qté + Frais)</small>
                        <h5 class="fw-bold text-warning mb-0 total-achat">0 Ar</h5>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-success shadow-sm btn-acheter">
                            <i class="bi bi-cart-plus me-1"></i> Acheter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card besoin 3 -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3 h-100 hover-shadow">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2">
                            <i class="bi bi-geo-alt-fill me-1"></i> Ville C
                        </span>
                        <span class="badge bg-light text-dark border">Matériaux</span>
                    </div>
                    <h6 class="fw-bold text-dark mb-2">Aucun donné</h6>
                    <div class="row g-2 mb-3">
                        <div class="col-4">
                            <div class="bg-light rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Qté restante</small>
                                <strong class="text-dark">0</strong>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="bg-light rounded-3 p-2 text-center">
                                <small class="text-muted d-block">P.U.</small>
                                <strong class="text-dark">0 Ar</strong>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="bg-warning bg-opacity-10 rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Frais</small>
                                <strong class="text-warning">10%</strong>
                            </div>
                        </div>
                    </div>
                    <!-- Saisie quantité à acheter -->
                    <div class="mb-3">
                        <label class="form-label small text-muted fw-bold">Quantité à acheter</label>
                        <input type="number" class="form-control shadow-sm qte-achat" min="1" max="0" placeholder="Saisir la quantité">
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-3 p-3 mb-3 text-center">
                        <small class="text-muted d-block mb-1">Total (P.U. × Qté + Frais)</small>
                        <h5 class="fw-bold text-warning mb-0 total-achat">0 Ar</h5>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-success shadow-sm btn-acheter">
                            <i class="bi bi-cart-plus me-1"></i> Acheter
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Retour -->
    <div class="mt-5 pt-3 border-top">
        <a href="/" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Retour à l'accueil
        </a>
    </div>

</div>
