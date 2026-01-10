<?php

$pageTitle = $pageTitle ?? 'Tableau de bord Client';
?>

<h2>Mes Commandes</h2>

<a href="/public/index.php?controller=client&action=create" class="btn btn-primary">Créer une nouvelle commande</a>

<?php if (empty($commandes)): ?>
    <p class="empty-message">Vous n'avez pas encore de commandes.</p>
<?php else: ?>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Adresse de livraison</th>
                <th>Statut</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commandes as $commande): ?>
                <tr>
                    <td><?= $commande->id ?></td>
                    <td><?= htmlspecialchars($commande->description) ?></td>
                    <td><?= htmlspecialchars($commande->adresse_livraison) ?></td>
                    <td>
                        <span class="badge badge-<?= $commande->statut ?>">
                            <?= htmlspecialchars($commande->statut) ?>
                        </span>
                    </td>
                    <td><?= date('d/m/Y H:i', strtotime($commande->created_at)) ?></td>
                    <td>
                        <a href="/public/index.php?controller=client&action=show&id=<?= $commande->id ?>" class="btn btn-sm">Voir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>