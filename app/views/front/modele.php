<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'BNGRC' ?></title>

    <link href="/public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<!-- HEADER -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/accueil">BNGRC - Suivi des Dons</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="nav" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="/accueil" class="nav-link">Villes</a></li>
                <li class="nav-item"><a href="/regions" class="nav-link">Régions</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- CONTENU DYNAMIQUE -->
<div class="container mb-5">
    <?php include $var; ?>
</div>

<!-- FOOTER -->
<footer class="bg-dark text-white py-4 mt-5">
    <div class="container text-center">
        <div class="row">

            <div class="col-md-4">
                <h6 class="fw-bold">Idealy</h6>
                <p class="mb-0">ETU : 4269</p>
            </div>

            <div class="col-md-4">
                <h6 class="fw-bold">Mariah</h6>
                <p class="mb-0">ETU : </p>
            </div>

            <div class="col-md-4">
                <h6 class="fw-bold">Mirantsoa</h6>
                <p class="mb-0">ETU : </p>
            </div>

        </div>
    </div>
</footer>

<script src="/public/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
