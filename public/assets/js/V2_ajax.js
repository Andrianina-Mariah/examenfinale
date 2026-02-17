document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('btn-actualiser');
    const baseUrl = typeof BASE_URL !== 'undefined' ? BASE_URL : '';
    
    function chargerStats() {
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Chargement...';
        
        fetch(baseUrl + '/api/stats')
            .then(res => res.json())
            .then(data => {
                // 1. Mise à jour des compteurs globaux
                document.getElementById('stat-besoins').innerText = data.global.total_besoins;
                document.getElementById('stat-satisfaits').innerText = data.global.total_satisfaits;
                document.getElementById('stat-restants').innerText = data.global.total_restants;
                document.getElementById('stat-dons').innerText = data.global.nb_dons;

                // 2. Barre de progression globale
                const progress = document.getElementById('progress-couverture');
                progress.style.width = data.global.pourcentage + '%';
                progress.innerText = data.global.pourcentage + '%';

                // 3. Liste des villes (on vide et on reconstruit)
                const container = document.getElementById('villes-container');
                container.innerHTML = ''; // Nettoyage

                data.villes.forEach(v => {
                    const total = parseFloat(v.qte_besoin) || 0;
                    const recu = parseFloat(v.qte_recue) || 0;
                    const reste = total - recu;
                    const pct = total > 0 ? Math.round((recu / total) * 100) : 0;
                    
                    let badgeColor = 'bg-danger';
                    if(pct >= 100) badgeColor = 'bg-success';
                    else if(pct > 0) badgeColor = 'bg-warning text-dark';

                    container.innerHTML += `
                        <div class="col-md-4">
                            <div class="card shadow-sm border-0 rounded-3 h-100">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <h6 class="fw-bold text-dark mb-0">${v.ville_nom}</h6>
                                        <span class="badge ${badgeColor} rounded-pill">${pct}%</span>
                                    </div>
                                    <div class="progress rounded-pill mb-3" style="height: 10px;">
                                        <div class="progress-bar ${badgeColor}" style="width: ${pct}%"></div>
                                    </div>
                                    <div class="row g-2 text-center">
                                        <div class="col-4 small">
                                            <div class="bg-light p-2 rounded">Besoins<br><strong>${total}</strong></div>
                                        </div>
                                        <div class="col-4 small">
                                            <div class="bg-light p-2 rounded">Reçus<br><strong>${recu}</strong></div>
                                        </div>
                                        <div class="col-4 small">
                                            <div class="bg-light p-2 rounded">Reste<br><strong>${reste}</strong></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                });
                
                btn.innerHTML = '<i class="bi bi-arrow-clockwise me-1"></i> Actualiser les données';
            });
    }

    btn.addEventListener('click', chargerStats);
    chargerStats(); // Chargement auto à l'ouverture
});