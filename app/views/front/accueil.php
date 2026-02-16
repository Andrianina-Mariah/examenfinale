<!-- accueil.php -->
<?php include '/Header.php'; ?>

<div class="container">
    <h2 class="mb-4">Liste des Villes et leurs besoins</h2>

    <div class="row g-4">

        <!-- Ville en div -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">

                    <h5 class="card-title">Nom de la ville</h5>
                    <p class="text-muted">Région : Aucun donné</p>

                    <h6>Besoins :</h6>
                    <ul>
                        <li>Aucun donné</li>
                    </ul>

                    <a href="/villes?id=1" class="btn btn-primary btn-sm">Voir détails</a>
                </div>
            </div>
        </div>

        <!-- Dupliquer ce block selon le nombre de villes -->

    </div>
</div>

<?php include '/Footer.php'; ?>
