const orders = [
    { id: "CMD-2025-01", dest: "Casablanca, Maroc", status: "en attente", client: "Ahmed", offres: 3 },
    { id: "CMD-2025-02", dest: "Rabat, Maroc", status: "expédiée", client: "Sami", offres: 1 }
];

function switchInterface() {
    const role = document.getElementById('roleSelect').value;
    const headerAction = document.getElementById('header-action');
    const stats = document.getElementById('admin-stats');
    const navAdmin = document.getElementById('nav-admin-only');

    // Reset UI
    stats.classList.add('d-none');
    navAdmin.classList.add('d-none');
    headerAction.innerHTML = "";

    if (role === 'client') {
        document.getElementById('ui-title').innerText = "Mes Livraisons";
        headerAction.innerHTML = `<button class="btn-dp btn-dp-primary shadow" data-bs-toggle="modal" data-bs-target="#modalOrder">Nouvelle Commande</button>`;
    } else if (role === 'livreur') {
        document.getElementById('ui-title').innerText = "Opportunités de Livraison";
    } else if (role === 'admin') {
        document.getElementById('ui-title').innerText = "Contrôle Administrateur";
        stats.classList.remove('d-none');
        navAdmin.classList.remove('d-none');
        renderAdminStats();
    }
    renderTable(role);
}

function renderTable(role) {
    const tbody = document.getElementById('main-table-body');
    tbody.innerHTML = "";

    orders.forEach(o => {
        let actions = "";
        
        if(role === 'client') {
            actions = `<button class="btn btn-sm btn-light rounded-pill mx-1"><i class="bi bi-pencil"></i></button>
                       <button class="btn btn-sm btn-light text-danger rounded-pill mx-1"><i class="bi bi-trash"></i></button>`;
        } else if(role === 'livreur') {
            actions = `<button class="btn btn-sm btn-dp-primary rounded-pill px-3">Envoyer Offre</button>`;
        } else {
            actions = `<div class="form-check form-switch"><input class="form-check-input" type="checkbox" checked></div>`;
        }

        tbody.innerHTML += `
            <tr>
                <td class="fw-bold text-primary">#${o.id}</td>
                <td><div class="small fw-semibold">${o.dest}</div><div class="text-muted x-small">Client: ${o.client}</div></td>
                <td><span class="badge-status status-${o.status.replace(' ', '-')}">${o.status}</span></td>
                <td class="text-end">${actions}</td>
            </tr>
        `;
    });
}

function renderAdminStats() {
    const stats = document.getElementById('admin-stats');
    stats.innerHTML = `
        <div class="col-md-3"><div class="card-custom text-center"><h3 class="fw-bold mb-0">124</h3><small class="text-muted">Commandes</small></div></div>
        <div class="col-md-3"><div class="card-custom text-center"><h3 class="fw-bold mb-0">85</h3><small class="text-muted">Terminées</small></div></div>
        <div class="col-md-3"><div class="card-custom text-center"><h3 class="fw-bold mb-0">310</h3><small class="text-muted">Offres</small></div></div>
        <div class="col-md-3"><div class="card-custom text-center"><h3 class="fw-bold mb-0">12</h3><small class="text-muted">Livreurs</small></div></div>
    `;
}

// Initialisation
window.onload = switchInterface;