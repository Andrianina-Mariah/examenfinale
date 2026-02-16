<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'BNGRC - Gestion des Dons' ?></title>

    <link href="/public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        html, body {
            height: 100%;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
        }

        main {
            flex: 1;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }

        .hover-shadow {
            transition: all 0.3s ease;
        }

        .hover-shadow:hover {
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15) !important;
            transform: translateY(-2px);
        }

        .card {
            transition: all 0.3s ease;
        }

        footer {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            box-shadow: 0 -2px 10px rgba(0,0,0,.1);
        }

        .nav-link {
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            transform: translateY(-1px);
        }
    </style>

</head>

<body>

<main>
    <!-- HEADER -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-0">
        <div class="container py-2">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="/">
                <i class="bi bi-heart-fill text-danger me-2"></i>
                BNGRC - Suivi des Dons
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="nav" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="/" class="nav-link">
                            <i class="bi bi-house-door"></i> Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/besoin/nouveau" class="nav-link">
                            <i class="bi bi-clipboard-plus"></i> Ajout Besoin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/don/nouveau" class="nav-link">
                            <i class="bi bi-gift"></i> Ajout Don
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTENU DYNAMIQUE -->
    <div class="container-fluid px-0">
        <?php include $var; ?>
    </div>
</main>

<!-- FOOTER -->
<footer class="text-white py-4 mt-5">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-md-4">
                <div class="p-3">
                    <i class="bi bi-person-circle display-6 mb-2"></i>
                    <h6 class="fw-bold mb-1">Idealy</h6>
                    <p class="mb-0 small opacity-75">ETU : 4269</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-3 border-start border-end border-secondary">
                    <i class="bi bi-person-circle display-6 mb-2"></i>
                    <h6 class="fw-bold mb-1">Mariah</h6>
                    <p class="mb-0 small opacity-75">ETU : Aucun donné</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-3">
                    <i class="bi bi-person-circle display-6 mb-2"></i>
                    <h6 class="fw-bold mb-1">Mirantsoa</h6>
                    <p class="mb-0 small opacity-75">ETU : Aucun donné</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-4 pt-3 border-top border-secondary">
            <p class="mb-0 small opacity-75">
                <i class="bi bi-c-circle"></i> <?= date('Y') ?> BNGRC - Tous droits réservés
            </p>
        </div>
    </div>
</footer>

<script src="/public/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
