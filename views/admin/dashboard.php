<?php


$pageTitle = $pageTitle ?? 'Tableau de bord Admin';
?>

<h2>Tableau de bord Administrateur</h2>

<div class="stats">
    <div class="stat-card">
        <h3>Utilisateurs</h3>
        <p class="stat-number"><?= $totalUsers ?></p>
        <p>Total</p>
    </div>
    <div class="stat-card">
        <h3>Clients</h3>
        <p class="stat-number"><?= $totalClients ?></p>
    </div>
    <div class="stat-card">
        <h3>Livreurs</h3>
        <p class="stat-number"><?= $totalLivreurs ?></p>
    </div>
    <div class="stat-card">
        <h3>Commandes</h3>
        <p class="stat-number"><?= $totalCommandes ?></p>
    </div>
</div>

<h3>Tous les utilisateurs</h3>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->id ?></td>
                <td><?= htmlspecialchars($user->name) ?></td>
                <td><?= htmlspecialchars($user->email) ?></td>
                <td><span class="badge badge-<?= $user->role ?>"><?= htmlspecialchars($user->role) ?></span></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h3>Toutes les commandes</h3>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Client ID</th>
            <th>Description</th>
            <th>Statut</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($commandes as $commande): ?>
            <tr>
                <td><?= $commande->id ?></td>
                <td><?= $commande->client_id ?></td>
                <td><?= htmlspecialchars($commande->description) ?></td>
                <td><span class="badge badge-<?= $commande->statut ?>"><?= htmlspecialchars($commande->statut) ?></span></td>
                <td><?= date('d/m/Y H:i', strtotime($commande->created_at)) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>