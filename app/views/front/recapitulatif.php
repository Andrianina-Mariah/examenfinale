<div class="container py-5">
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
            <li class="breadcrumb-item active">Récapitulatif</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-end mb-4">
        <button class="btn btn-primary shadow-sm" id="btn-actualiser">
            <i class="bi bi-arrow-clockwise me-1"></i> Actualiser les données
        </button>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 h-100 border-start border-primary border-4">
                <div class="card-body p-4">
                    <h6 class="text-muted small mb-3">TOTAL BESOINS</h6>
                    <h3 class="fw-bold text-dark mb-1" id="stat-besoins">... Ar</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 text-success">
             <div class="card shadow-sm border-0 rounded-3 h-100 border-start border-success border-4">
                <div class="card-body p-4">
                    <h6 class="text-muted small mb-3">SATISFAITS</h6>
                    <h3 class="fw-bold mb-1" id="stat-satisfaits">... Ar</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 text-danger">
             <div class="card shadow-sm border-0 rounded-3 h-100 border-start border-danger border-4">
                <div class="card-body p-4">
                    <h6 class="text-muted small mb-3">RESTANTS</h6>
                    <h3 class="fw-bold mb-1" id="stat-restants">... Ar</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 text-info">
             <div class="card shadow-sm border-0 rounded-3 h-100 border-start border-info border-4">
                <div class="card-body p-4">
                    <h6 class="text-muted small mb-3">TOTAL DONS</h6>
                    <h3 class="fw-bold mb-1" id="stat-dons">0</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-3 mb-5">
        <div class="card-body p-4">
            <h6 class="fw-bold text-dark mb-3">Taux de couverture global</h6>
            <div class="progress rounded-pill" style="height: 28px;">
                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" id="progress-couverture" style="width: 0%;">0%</div>
            </div>
        </div>
    </div>

    <h5 class="fw-bold text-dark mb-3">Récapitulatif par ville</h5>
    <div class="row g-4 mb-4" id="villes-container">
        </div>
</div>

<script src="public/assets/js/V2_ajax.js"></script>