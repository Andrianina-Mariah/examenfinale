<div class="container">
    <h2 class="mb-4">Liste des Villes et leurs besoins</h2>

    <div class="row g-4">

        <!-- Ville en div -->
         <?php if (isset($villes)) {
            for ($i=0; $i < count($villes); $i++) { ?><div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <h5 class="card-title"><?= $villes[$i]['ville']->getNom() ?></h5>
                        <p class="text-muted">Région : <?= $villes[$i]['region_nom'] ?></p>

                        <h6>Besoins :</h6>
                        <ul>
                            <li>Aucun donné</li>
                        </ul>

                        <a href="/villesDetails/<?= $villes[$i]['ville']->getId() ?>" class="btn btn-primary btn-sm">Voir détails</a>
                    </div>
                </div>
            </div>
            <?php }
         }
         ?>
        
        <!-- Dupliquer ce block selon le nombre de villes -->

    </div>
</div>
