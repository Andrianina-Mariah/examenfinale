<div class="container mt-4">

    <h2 class="fw-bold mb-4">
        Détails des besoins - Ville : <?= $ville ? htmlspecialchars($ville->getNom()) : 'Aucun donné' ?>
    </h2>

    <div class="card shadow-sm mb-4 border-0 bg-light">
        <div class="card-body">
            <h5 class="fw-bold text-primary mb-3">Informations générales</h5>

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

                // Pour la région, si vous avez l'objet Région chargé
                $regionNom = (isset($region) && $region) ? $region->getNom() : 'Non spécifiée';
            ?>

            <div class="row">
                <div class="col-md-4">
                    <p class="mb-1 text-muted">Total besoins (Unités)</p>
                    <p class="fw-bold fs-5 text-secondary"><?= number_format($totalBesoin, 0, '.', ' ') ?></p>
                </div>
                <div class="col-md-4">
                    <p class="mb-1 text-muted">Total attribué (Unités)</p>
                    <p class="fw-bold fs-5 text-success"><?= number_format($totalAttribue, 0, '.', ' ') ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="fw-bold mb-3">Liste détaillée par article</h4>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-start">Type de Besoin</th>
                            <th>Quantité demandée</th>
                            <th>Quantité attribuée</th>
                            <th>Prix unitaire</th>
                            <th>Valeur Totale</th>
                            <th>Reste à pourvoir</th>
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
                                    <td class="text-start fw-bold"><?= htmlspecialchars($item['type_nom']) ?></td>
                                    <td><?= number_format($b->getQuantite(), 0, '.', ' ') ?></td>
                                    <td class="text-success fw-bold"><?= number_format($attribue, 0, '.', ' ') ?></td>
                                    <td class="text-end"><?= number_format($b->getPrixUnitaire(), 2, '.', ' ') ?> Ar</td>
                                    <td class="text-end fw-bold"><?= number_format($totalValeur, 2, '.', ' ') ?> Ar</td>
                                    <td class="<?= $reste > 0 ? 'text-danger fw-bold' : 'text-muted' ?>">
                                        <?= $reste <= 0 ? '<span class="badge bg-success">Comblé</span>' : number_format($reste, 0, '.', ' ') ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4">Aucun besoin enregistré pour cette ville.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- <div class="container">

    <h2 class="fw-bold mb-4">
        Détails des besoins - Ville : <0= $ville ? htmlspecialchars($ville->getNom()) : 'Aucun donné' ?>
    </h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold">Informations générales</h5>

            <0php
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

            <p class="mb-1"><strong>Région :</strong> <0= htmlspecialchars($regionNom) ?></p>
            <p class="mb-1"><strong>Total besoins :</strong> <0= $totalBesoin ?></p>
            <p class="mb-1"><strong>Total dons attribués :</strong> <0= $totalAttribue ?></p>
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

                        <0php if (!empty($besoins)): ?>
                            <0php foreach ($besoins as $item): ?>
                                <0php
                                    $b = $item['besoin'];
                                    $attribue = $item['quantite_attribuee'];
                                    $reste = $b->getQuantite() - $attribue;
                                    $totalValeur = $b->getQuantite() * $b->getPrixUnitaire();
                                ?>
                                <tr>
                                    <td><0= htmlspecialchars($item['type_nom']) ?></td>
                                    <td><0= $b->getQuantite() ?></td>
                                    <td><0= $attribue ?></td>
                                    <td><0= $b->getPrixUnitaire() ?></td>
                                    <td><0= $totalValeur ?></td>
                                    <td><0= $reste ?></td>
                                </tr>
                            <0php endforeach; ?>
                        <0php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Aucun donné</td>
                            </tr>
                        <0php endif; ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div> -->
