<div class="container">

    <h2 class="fw-bold mb-4">Détails des besoins - Ville : <?= $ville->nom ?></h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold text-primary border-bottom pb-2 mb-3">Informations générales</h5>

            <?php 
                // Calcul des totaux globaux pour le résumé
                $totalDemandeGlobal = 0;
                $totalRecuGlobal = 0;
                foreach ($besoins as $b) {
                    $totalDemandeGlobal += $b['quantite_demandee'];
                    $totalRecuGlobal += $b['quantite_attribuee'];
                }
            ?>

            <p class="mb-1"><strong>ID Ville :</strong> #<?= $ville->id ?></p>
            <p class="mb-1"><strong>Total des articles demandés :</strong> <span class="badge bg-secondary"><?= number_format($totalDemandeGlobal, 0, ',', ' ') ?></span></p>
            <p class="mb-1"><strong>Total des articles reçus :</strong> <span class="badge bg-success"><?= number_format($totalRecuGlobal, 0, ',', ' ') ?></span></p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <h4 class="fw-bold mb-3">Récapitulatif par Type de Don</h4>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-start">Type de besoin</th>
                            <th>Quantité demandée</th>
                            <th>Quantité attribuée</th>
                            <th>Prix unitaire</th>
                            <th>Valeur Totale</th>
                            <th>Reste à pourvoir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($besoins)): ?>
                            <tr>
                                <td colspan="6" class="text-muted italic">Aucun besoin enregistré pour cette ville.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($besoins as $b): ?>
                                <tr>
                                    <td class="text-start fw-bold"><?= $b['type_nom'] ?></td>
                                    <td><?= number_format($b['quantite_demandee'], 0, ',', ' ') ?></td>
                                    <td class="text-success fw-bold"><?= number_format($b['quantite_attribuee'], 0, ',', ' ') ?></td>
                                    <td><?= number_format($b['prix_unitaire'], 2, ',', ' ') ?> Ar</td>
                                    <td class="fw-bold"><?= number_format($b['valeur_totale'], 2, ',', ' ') ?> Ar</td>
                                    <td>
                                        <?php if($b['reste'] <= 0): ?>
                                            <span class="badge bg-success">Satisfait</span>
                                        <?php else: ?>
                                            <span class="text-danger fw-bold"><?= number_format($b['reste'], 0, ',', ' ') ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="mt-4">
        <a href="/accueil" class="btn btn-outline-dark">
            <i class="bi bi-arrow-left"></i> Retour à la liste des villes
        </a>
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
