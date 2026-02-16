<div class="container py-5">

    <!-- En-tête -->
    <div class="d-flex align-items-center mb-2">
        <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width:54px;height:54px;">
            <i class="bi bi-receipt-cutoff text-info fs-4"></i>
        </div>
        <div>
            <h2 class="fw-bold text-dark mb-0">Historique des Achats</h2>
            <p class="text-muted mb-0">Tous les achats réalisés pour les besoins des sinistrés</p>
        </div>
    </div>

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none"><i class="bi bi-house-door"></i> Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Historique achats</li>
        </ol>
    </nav>

    <!-- Filtres -->
    <div class="card shadow-sm border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <h6 class="fw-bold text-dark mb-3"><i class="bi bi-funnel-fill text-info me-2"></i>Filtres</h6>
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small text-muted">Ville</label>
                    <select class="form-select shadow-sm" id="filtre-ville">
                        <option value="">Toutes les villes</option>
                        <!-- données dynamiques ici -->
                        <option disabled class="text-muted">Aucun donné</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-muted">Date début</label>
                    <input type="date" class="form-control shadow-sm" id="filtre-date-debut">
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-muted">Date fin</label>
                    <input type="date" class="form-control shadow-sm" id="filtre-date-fin">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-info text-white btn-lg w-100 shadow-sm">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Résumé -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body p-3 text-center">
                    <i class="bi bi-bag-fill text-info fs-3 mb-2"></i>
                    <h6 class="text-muted small mb-1">TOTAL ACHATS</h6>
                    <h4 class="fw-bold text-dark mb-0">0</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body p-3 text-center">
                    <i class="bi bi-boxes text-primary fs-3 mb-2"></i>
                    <h6 class="text-muted small mb-1">QUANTITÉ TOTALE</h6>
                    <h4 class="fw-bold text-dark mb-0">0</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body p-3 text-center">
                    <i class="bi bi-percent text-warning fs-3 mb-2"></i>
                    <h6 class="text-muted small mb-1">FRAIS TOTAUX</h6>
                    <h4 class="fw-bold text-warning mb-0">0 Ar</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body p-3 text-center">
                    <i class="bi bi-cash-coin text-success fs-3 mb-2"></i>
                    <h6 class="text-muted small mb-1">MONTANT GLOBAL</h6>
                    <h4 class="fw-bold text-success mb-0">0 Ar</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des achats en cards -->
    <h5 class="fw-bold text-dark mb-3">
        <i class="bi bi-grid-3x3-gap-fill text-info me-2"></i>Détails des achats
    </h5>

    <div class="row g-4">

        <!-- Card achat 1 -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3 h-100 hover-shadow">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-2">
                            <i class="bi bi-geo-alt-fill me-1"></i> Ville A
                        </span>
                        <span class="badge bg-light text-muted border small">
                            <i class="bi bi-calendar3 me-1"></i> --/--/----
                        </span>
                    </div>
                    <h6 class="fw-bold text-dark mb-3">Aucun donné</h6>
                    <div class="row g-2 mb-3">
                        <div class="col-4">
                            <div class="bg-light rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Qté</small>
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
                                <strong class="text-warning">0%</strong>
                            </div>
                        </div>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-3 p-3 text-center">
                        <small class="text-muted d-block mb-1">Total payé</small>
                        <h5 class="fw-bold text-success mb-0">0 Ar</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card achat 2 -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3 h-100 hover-shadow">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-2">
                            <i class="bi bi-geo-alt-fill me-1"></i> Ville B
                        </span>
                        <span class="badge bg-light text-muted border small">
                            <i class="bi bi-calendar3 me-1"></i> --/--/----
                        </span>
                    </div>
                    <h6 class="fw-bold text-dark mb-3">Aucun donné</h6>
                    <div class="row g-2 mb-3">
                        <div class="col-4">
                            <div class="bg-light rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Qté</small>
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
                                <strong class="text-warning">0%</strong>
                            </div>
                        </div>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-3 p-3 text-center">
                        <small class="text-muted d-block mb-1">Total payé</small>
                        <h5 class="fw-bold text-success mb-0">0 Ar</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card achat 3 -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3 h-100 hover-shadow">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-2">
                            <i class="bi bi-geo-alt-fill me-1"></i> Ville C
                        </span>
                        <span class="badge bg-light text-muted border small">
                            <i class="bi bi-calendar3 me-1"></i> --/--/----
                        </span>
                    </div>
                    <h6 class="fw-bold text-dark mb-3">Aucun donné</h6>
                    <div class="row g-2 mb-3">
                        <div class="col-4">
                            <div class="bg-light rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Qté</small>
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
                                <strong class="text-warning">0%</strong>
                            </div>
                        </div>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-3 p-3 text-center">
                        <small class="text-muted d-block mb-1">Total payé</small>
                        <h5 class="fw-bold text-success mb-0">0 Ar</h5>
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
