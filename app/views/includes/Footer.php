<!-- Footer.php - Partie footer uniquement (appelé par Layout.php) -->
<footer class="footer-custom mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h6 class="text-white mb-2">BNGRC - Bureau National de Gestion des Risques et Catastrophes</h6>
                <p class="mb-0 small">Application de suivi des collectes et distributions de dons pour les sinistrés</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-0 small">&copy; <?= date('Y') ?> - Tous droits réservés</p>
                <p class="mb-0 small">Madagascar</p>
            </div>
        </div>
    </div>
</footer>

<script src="/public/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    // Script pour les alertes auto-dismiss
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert-dismissible');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });
</script>
