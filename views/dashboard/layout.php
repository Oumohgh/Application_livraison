<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>DeliveryPro Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<style>
    :root {
    --dp-primary: #6a5af9;
    --dp-gradient: linear-gradient(135deg, #6a5af9 0%, #a855f7 100%);
    --dp-bg: #f4f7fe;
    --dp-card-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
}

body {
    background-color: var(--dp-bg);
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: #1e1b4b;
}

/* Sidebar de style App Moderne */
.sidebar {
    width: 280px; height: 100vh; position: fixed;
    background: white; border-right: 1px solid #eef2ff;
    padding: 2.5rem 1.5rem; z-index: 100;
}

.nav-link {
    color: #64748b; font-weight: 600; border-radius: 16px;
    padding: 12px 18px; margin-bottom: 8px; transition: 0.3s;
}

.nav-link.active {
    background: var(--dp-gradient); color: white !important;
    box-shadow: 0 8px 20px rgba(106, 90, 249, 0.3);
}

/* Boutons style Accueil */
.btn-dp {
    border-radius: 50px; font-weight: 700; padding: 10px 24px; transition: 0.3s;
}

.btn-dp-primary {
    background: var(--dp-gradient); color: white; border: none;
}

.btn-dp-primary:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(106, 90, 249, 0.4); color: white;}

/* Cards & Badges */
.card-custom {
    border: none; border-radius: 24px; background: white;
    box-shadow: var(--dp-card-shadow); padding: 25px;
}

.badge-status {
    padding: 6px 16px; border-radius: 50px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase;
}
.status-attente { background: #fff7ed; color: #f97316; }
.status-terminee { background: #f0fdf4; color: #22c55e; }
.status-expediee { background: #eff6ff; color: #3b82f6; }
</style>
<body>

    <aside class="sidebar d-flex flex-column">
        <div class="brand mb-5 d-flex align-items-center gap-2">
            <div style="background: var(--dp-gradient); width: 40px; height: 40px; border-radius: 12px; display: grid; place-items: center; color: white;">
                <i class="bi bi-box-seam-fill"></i>
            </div>
            <span class="h4 mb-0 fw-bold">DeliveryPro</span>
        </div>

        <nav class="nav flex-column mb-auto">
            <a href="#" class="nav-link active"><i class="bi bi-grid-fill me-2"></i> Dashboard</a>
            <a href="#" class="nav-link"><i class="bi bi-box-seam me-2"></i> Commandes</a>
            <div id="nav-admin-only" class="d-none">
                <a href="#" class="nav-link"><i class="bi bi-people-fill me-2"></i> Utilisateurs</a>
                <a href="#" class="nav-link"><i class="bi bi-bar-chart-fill me-2"></i> Statistiques</a>
            </div>
        </nav>

        <div class="p-3 bg-light rounded-4 mt-4">
            <label class="small fw-bold text-muted mb-2 d-block text-uppercase">Rôle de test</label>
            <select id="roleSelect" class="form-select border-0 bg-transparent fw-bold p-0" onchange="switchInterface()">
                <option value="client">Espace Client</option>
                <option value="livreur">Espace Livreur</option>
                <option value="admin">Espace Admin</option>
            </select>
        </div>
    </aside>

    <main class="main-content" style="margin-left: 280px; padding: 40px 50px;">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-bold mb-1" id="ui-title">Mon Dashboard</h2>
                <p class="text-muted" id="ui-subtitle">Gérez vos opérations en toute simplicité.</p>
            </div>
            <div id="header-action"></div>
        </header>

        <div id="admin-stats" class="row g-4 mb-5 d-none">
            </div>

        <div class="card-custom">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0" id="list-title">Liste des commandes</h5>
            </div>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="text-muted small text-uppercase">
                        <tr>
                            <th>Référence</th>
                            <th>Détails</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="main-table-body"></tbody>
                </table>
            </div>
        </div>
    </main>

    <div class="modal fade" id="modalOrder" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-5 border-0 p-4">
                <h4 class="fw-bold mb-4">Créer une commande</h4>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Lieu de livraison</label>
                    <input type="text" class="form-control rounded-3" placeholder="Adresse complète">
                </div>
                <button class="btn btn-dp-primary w-100 py-3 mt-3">Lancer la livraison</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>