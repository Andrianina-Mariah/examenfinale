<div class="container py-5">

    <!-- En-tête -->
    <div class="d-flex align-items-center mb-2">
        <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width:54px;height:54px;">
            <i class="bi bi-bar-chart-line-fill text-success fs-4"></i>
        </div>
        <div>
            <h2 class="fw-bold text-dark mb-0">Récapitulatif Général</h2>
            <p class="text-muted mb-0">Vue d'ensemble des besoins, dons et dispatch</p>
        </div>
    </div>

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none"><i class="bi bi-house-door"></i> Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Récapitulatif</li>
        </ol>
    </nav>

    <!-- Bouton Actualiser AJAX -->
    <div class="d-flex justify-content-end mb-4">
        <button class="btn btn-primary shadow-sm" id="btn-actualiser">
            <i class="bi bi-arrow-clockwise me-1"></i> Actualiser les données
        </button>
    </div>

    <!-- Cards statistiques principales -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 h-100 border-start border-primary border-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width:42px;height:42px;">
                            <i class="bi bi-clipboard-data text-primary fs-5"></i>
                        </div>
                        <h6 class="text-muted small mb-0">TOTAL BESOINS</h6>
                    </div>
                    <h3 class="fw-bold text-dark mb-1" id="stat-besoins">0 Ar</h3>
                    <small class="text-muted">Montant total des besoins enregistrés</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 h-100 border-start border-success border-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width:42px;height:42px;">
                            <i class="bi bi-check-circle text-success fs-5"></i>
                        </div>
                        <h6 class="text-muted small mb-0">SATISFAITS</h6>
                    </div>
                    <h3 class="fw-bold text-success mb-1" id="stat-satisfaits">0 Ar</h3>
                    <small class="text-muted">Besoins complètement comblés</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 h-100 border-start border-danger border-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width:42px;height:42px;">
                            <i class="bi bi-exclamation-circle text-danger fs-5"></i>
                        </div>
                        <h6 class="text-muted small mb-0">RESTANTS</h6>
                    </div>
                    <h3 class="fw-bold text-danger mb-1" id="stat-restants">0 Ar</h3>
                    <small class="text-muted">Besoins non encore satisfaits</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 h-100 border-start border-info border-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width:42px;height:42px;">
                            <i class="bi bi-gift text-info fs-5"></i>
                        </div>
                        <h6 class="text-muted small mb-0">TOTAL DONS</h6>
                    </div>
                    <h3 class="fw-bold text-info mb-1" id="stat-dons">0</h3>
                    <small class="text-muted">Nombre de dons reçus</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Barre de progression -->
    <div class="card shadow-sm border-0 rounded-3 mb-5">
        <div class="card-body p-4">
            <h6 class="fw-bold text-dark mb-3"><i class="bi bi-speedometer2 text-success me-2"></i>Taux de couverture global</h6>
            <div class="progress rounded-pill" style="height: 28px;">
                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated rounded-pill"
                     role="progressbar"
                     style="width: 0%;"
                     id="progress-couverture">
                    0%
                </div>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <small class="text-muted">0% satisfait</small>
                <small class="text-muted">Objectif : 100%</small>
            </div>
        </div>
    </div>

    <!-- Détails par ville -->
    <h5 class="fw-bold text-dark mb-3">
        <i class="bi bi-grid-3x3-gap-fill text-success me-2"></i>Récapitulatif par ville
    </h5>

    <div class="row g-4 mb-4">

        <!-- Card ville 1 -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3 h-100 hover-shadow">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h6 class="fw-bold text-dark mb-0">
                            <i class="bi bi-geo-alt-fill text-primary me-1"></i> Ville A
                        </h6>
                        <span class="badge bg-success rounded-pill">Comblé</span>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-muted">Progression</span>
                            <span class="fw-bold">0%</span>
                        </div>
                        <div class="progress rounded-pill" style="height: 10px;">
                            <div class="progress-bar bg-success rounded-pill" style="width: 0%;"></div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-4">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Besoins</small>
                                <strong class="text-primary">0</strong>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="bg-success bg-opacity-10 rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Reçus</small>
                                <strong class="text-success">0</strong>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="bg-danger bg-opacity-10 rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Reste</small>
                                <strong class="text-danger">0</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card ville 2 -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3 h-100 hover-shadow">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h6 class="fw-bold text-dark mb-0">
                            <i class="bi bi-geo-alt-fill text-primary me-1"></i> Ville B
                        </h6>
                        <span class="badge bg-warning text-dark rounded-pill">Partiel</span>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-muted">Progression</span>
                            <span class="fw-bold">0%</span>
                        </div>
                        <div class="progress rounded-pill" style="height: 10px;">
                            <div class="progress-bar bg-warning rounded-pill" style="width: 0%;"></div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-4">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Besoins</small>
                                <strong class="text-primary">0</strong>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="bg-success bg-opacity-10 rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Reçus</small>
                                <strong class="text-success">0</strong>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="bg-danger bg-opacity-10 rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Reste</small>
                                <strong class="text-danger">0</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card ville 3 -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3 h-100 hover-shadow">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h6 class="fw-bold text-dark mb-0">
                            <i class="bi bi-geo-alt-fill text-primary me-1"></i> Ville C
                        </h6>
                        <span class="badge bg-danger rounded-pill">En attente</span>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-muted">Progression</span>
                            <span class="fw-bold">0%</span>
                        </div>
                        <div class="progress rounded-pill" style="height: 10px;">
                            <div class="progress-bar bg-danger rounded-pill" style="width: 0%;"></div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-4">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Besoins</small>
                                <strong class="text-primary">0</strong>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="bg-success bg-opacity-10 rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Reçus</small>
                                <strong class="text-success">0</strong>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="bg-danger bg-opacity-10 rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Reste</small>
                                <strong class="text-danger">0</strong>
                            </div>
                        </div>
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
