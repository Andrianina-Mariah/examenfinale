<!-- ajouterBesoin.php -->
<?php include '/Header.php'; ?>

<div class="container">
    <h2 class="mb-4">Ajouter besoin pour la ville : Aucun donné</h2>

    <form class="card p-4 shadow">

        <div class="mb-3">
            <label class="form-label">Catégorie</label>
            <select class="form-select">
                <option>Aucun donné</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Nom du don</label>
            <select class="form-select">
                <option>Aucun donné</option>
            </select>
        </div>

        <hr>

        <h5>Ajouter un nouveau don</h5>

        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" class="form-control" placeholder="Nom du don">
        </div>

        <div class="mb-3">
            <label class="form-label">Prix unitaire</label>
            <input type="number" class="form-control" placeholder="0">
        </div>

        <div class="mb-3">
            <label class="form-label">Quantité</label>
            <input type="number" class="form-control" placeholder="0">
        </div>

        <button type="button" class="btn btn-secondary mb-3">Ajouter besoin supplémentaire</button>
        <button type="submit" class="btn btn-primary">Sauvegarder</button>

    </form>

</div>

<?php include '/Footer.php'; ?>
