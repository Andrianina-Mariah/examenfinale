<div class="container py-5">

    <!-- En-tête -->
    <div class="d-flex align-items-center mb-2">
        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width:54px;height:54px;">
            <i class="bi bi-shuffle text-primary fs-4"></i>
        </div>
        <div>
            <h2 class="fw-bold text-dark mb-0">Simulation du Dispatch</h2>
            <p class="text-muted mb-0">Répartir les dons reçus vers les villes selon leurs besoins</p>
        </div>
    </div>

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none"><i class="bi bi-house-door"></i> Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Simulation dispatch</li>
        </ol>
    </nav>

    <!-- Configuration de la simulation -->
    <div class="card shadow-sm border-0 rounded-3 mb-5">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <i class="bi bi-cpu text-primary display-4 d-block mb-3"></i>
                <h5 class="fw-bold text-dark mb-2">Configuration de la simulation</h5>
                <p class="text-muted mb-0">
                    Choisissez le mode de répartition des dons avant de lancer la simulation
                </p>
            </div>

            <!-- Choix du mode de répartition -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <label class="form-label fw-bold text-dark">
                        <i class="bi bi-sliders me-2"></i>Mode de répartition
                    </label>
                </div>

                <!-- Option 1: Par ordre (date de saisie) -->
                <div class="col-md-4">
                    <input type="radio" class="btn-check" name="mode-repartition" id="mode-ordre" value="ordre" checked>
                    <label class="btn btn-outline-primary w-100 h-100 p-3 text-start" for="mode-ordre">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-calendar-event fs-3 me-3 mt-1"></i>
                            <div>
                                <div class="fw-bold mb-2">Par ordre chronologique</div>
                                <small class="text-muted">
                                    Les dons sont distribués selon l'ordre de saisie des besoins (FIFO - First In First Out)
                                </small>
                            </div>
                        </div>
                    </label>
                </div>

                <!-- Option 2: Priorité aux moins demandeurs -->
                <div class="col-md-4">
                    <input type="radio" class="btn-check" name="mode-repartition" id="mode-minimum" value="minimum">
                    <label class="btn btn-outline-success w-100 h-100 p-3 text-start" for="mode-minimum">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-arrow-down-circle fs-3 me-3 mt-1"></i>
                            <div>
                                <div class="fw-bold mb-2">Ville avec moins de besoins</div>
                                <small class="text-muted">
                                    Priorité aux villes ayant le total de besoins le plus faible
                                </small>
                            </div>
                        </div>
                    </label>
                </div>

                <!-- Option 3: Répartition proportionnelle -->
                <div class="col-md-4">
                    <input type="radio" class="btn-check" name="mode-repartition" id="mode-proportionnel" value="proportionnel">
                    <label class="btn btn-outline-warning w-100 h-100 p-3 text-start" for="mode-proportionnel">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-pie-chart fs-3 me-3 mt-1"></i>
                            <div>
                                <div class="fw-bold mb-2">Répartition proportionnelle</div>
                                <small class="text-muted">
                                    Distribution équitable selon le nombre de besoins de chaque ville
                                </small>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Bouton lancer simulation -->
            <div class="text-center">
                <button class="btn btn-primary btn-lg px-5 shadow" id="btn-simuler">
                    <i class="bi bi-play-circle-fill me-2"></i> Lancer la Simulation
                </button>
            </div>
        </div>
    </div>

    <!-- Résultat de la simulation -->
    <h5 class="fw-bold text-dark mb-3">
        <i class="bi bi-grid-3x3-gap-fill text-primary me-2"></i>Résultat de la simulation
    </h5>

    <div class="row g-4 mb-4">

        <!-- Card dispatch 1 -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3 h-100 hover-shadow">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <div class="d-flex justify-content-between align-items-start">
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                            <i class="bi bi-geo-alt-fill me-1"></i> Ville A
                        </span>
                        <span class="badge bg-success rounded-pill px-3 py-2">
                            <i class="bi bi-arrow-right me-1"></i> Attribué
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <h6 class="fw-bold text-dark mb-3">Aucun donné</h6>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Demandé</small>
                                <strong class="text-primary">0</strong>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-success bg-opacity-10 rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Attribué</small>
                                <strong class="text-success">0</strong>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light rounded-3 p-3 text-center">
                        <small class="text-muted d-block mb-1">Reste à pourvoir</small>
                        <h5 class="fw-bold text-danger mb-0">0</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card dispatch 2 -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3 h-100 hover-shadow">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <div class="d-flex justify-content-between align-items-start">
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                            <i class="bi bi-geo-alt-fill me-1"></i> Ville B
                        </span>
                        <span class="badge bg-success rounded-pill px-3 py-2">
                            <i class="bi bi-arrow-right me-1"></i> Attribué
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <h6 class="fw-bold text-dark mb-3">Aucun donné</h6>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Demandé</small>
                                <strong class="text-primary">0</strong>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-success bg-opacity-10 rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Attribué</small>
                                <strong class="text-success">0</strong>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light rounded-3 p-3 text-center">
                        <small class="text-muted d-block mb-1">Reste à pourvoir</small>
                        <h5 class="fw-bold text-danger mb-0">0</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card dispatch 3 -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3 h-100 hover-shadow">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <div class="d-flex justify-content-between align-items-start">
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                            <i class="bi bi-geo-alt-fill me-1"></i> Ville C
                        </span>
                        <span class="badge bg-warning text-dark rounded-pill px-3 py-2">
                            <i class="bi bi-hourglass-split me-1"></i> Partiel
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <h6 class="fw-bold text-dark mb-3">Aucun donné</h6>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Demandé</small>
                                <strong class="text-primary">0</strong>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-success bg-opacity-10 rounded-3 p-2 text-center">
                                <small class="text-muted d-block">Attribué</small>
                                <strong class="text-success">0</strong>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light rounded-3 p-3 text-center">
                        <small class="text-muted d-block mb-1">Reste à pourvoir</small>
                        <h5 class="fw-bold text-danger mb-0">0</h5>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bouton valider -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h6 class="fw-bold text-dark mb-1">Confirmer cette répartition ?</h6>
                    <p class="text-muted small mb-0">Cette action enregistrera le dispatch dans la base de données.</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-secondary px-4" id="btn-recommencer">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Recommencer
                    </button>
                    <button class="btn btn-outline-secondary px-4" id="btn-annuler-simulation">
                        <i class="bi bi-x-circle me-1"></i> Annuler
                    </button>
                    <button class="btn btn-success btn-lg px-5 shadow" id="btn-valider-dispatch">
                        <i class="bi bi-check-circle-fill me-2"></i> Valider le Dispatch
                    </button>
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
