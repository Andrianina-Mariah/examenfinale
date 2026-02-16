<div class="container">

    <h2 class="fw-bold mb-4">
        Détails des besoins - Ville : <?= $ville ? htmlspecialchars($ville->getNom()) : 'Aucun donné' ?>
    </h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold">Informations générales</h5>

            <?php
                $totalBesoin = 0;
                $totalAttribue = 0;

                if (!empty($besoins)) {
                    foreach ($besoins as $item) {
                        $b = $item['besoin'];
                        $totalBesoin += $b->getQuantite();
                        $totalAttribue += $item['quantite_attribuee'];
                    }
                }


                $regionNom = 'Aucun donné';
                if (isset($ville) && method_exists($ville, 'getIdRegion')) {
                    $regionNom = $ville->getIdRegion();
                }
            ?>

            <p class="mb-1"><strong>Région :</strong> <?= htmlspecialchars($regionNom) ?></p>
            <p class="mb-1"><strong>Total besoins :</strong> <?= $totalBesoin ?></p>
            <p class="mb-1"><strong>Total dons attribués :</strong> <?= $totalAttribue ?></p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <h4 class="fw-bold mb-3">Liste des besoins</h4>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Besoin</th>
                            <th>Quantité demandée</th>
                            <th>Quantité attribuée</th>
                            <th>Prix unitaire</th>
                            <th>Total valeur</th>
                            <th>Reste</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (!empty($besoins)): ?>
                            <?php foreach ($besoins as $item): ?>
                                <?php
                                    $b = $item['besoin'];
                                    $attribue = $item['quantite_attribuee'];
                                    $reste = $b->getQuantite() - $attribue;
                                    $totalValeur = $b->getQuantite() * $b->getPrixUnitaire();
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['type_nom']) ?></td>
                                    <td><?= $b->getQuantite() ?></td>
                                    <td><?= $attribue ?></td>
                                    <td><?= $b->getPrixUnitaire() ?></td>
                                    <td><?= $totalValeur ?></td>
                                    <td><?= $reste ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Aucun donné</td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<!-- <div class="container">

    <h2 class="fw-bold mb-4">Détails des besoins - Ville : Aucun donné</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold">Informations générales</h5>

            <p class="mb-1"><strong>Région :</strong> Aucun donné</p>
            <p class="mb-1"><strong>Total besoins :</strong> Aucun donné</p>
            <p class="mb-1"><strong>Total dons attribués :</strong> Aucun donné</p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <h4 class="fw-bold mb-3">Liste des besoins</h4>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Besoin</th>
                            <th>Quantité demandée</th>
                            <th>Quantité attribuée</th>
                            <th>Prix unitaire</th>
                            <th>Total valeur</th>
                            <th>Reste</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>Nom du besoin</td>
                            <td>Aucun donné</td>
                            <td>Aucun donné</td>
                            <td>Aucun donné</td>
                            <td>Aucun donné</td>
                            <td>Aucun donné</td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div> -->
