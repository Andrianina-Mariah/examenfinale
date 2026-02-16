<!-- Header.php - Partie navigation uniquement (appelé par Layout.php) -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="/dashboard">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-heart-pulse me-2" viewBox="0 0 16 16">
                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                <path d="M5.438 12 4 5.5l2 2 2-4 2 4 2-2L10.562 12z"/>
            </svg>
            <span>BNGRC - Suivi des Dons</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= ($currentPage ?? '') === 'dashboard' ? 'active' : '' ?>" href="/dashboard">
                        Tableau de bord
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        Gestion
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/besoins">Saisir les besoins</a></li>
                        <li><a class="dropdown-item" href="/dons">Saisir les dons</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/dispatch">Dispatch des dons</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($currentPage ?? '') === 'regions' ? 'active' : '' ?>" href="/regions">
                        Régions
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <span class="text-light me-3">
                    <small><?= date('d/m/Y') ?></small>
                </span>
            </div>
        </div>
    </div>
</nav>
