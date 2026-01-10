<?php
/**
 * Livreur Dashboard View
 * 
 * Displays available commandes and livreur's accepted commandes.
 */

// Page title is set by controller
$pageTitle = $pageTitle ?? 'Tableau de bord Livreur';
?>

<h2>Commandes disponibles</h2>

<?php if (empty($availableCommandes)): ?>
    <p class="empty-message">Aucune commande disponible pour le moment.</p>
<?php else: ?>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Adresse de livraison</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($availableCommandes as $commande): ?>
                <tr>
                    <td><?= $commande->id ?></td>
                    <td><?= htmlspecialchars($commande->description) ?></td>
                    <td><?= htmlspecialchars($commande->adresse_livraison) ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($commande->created_at)) ?></td>
                    <td>
                        <a href="/public/index.php?controller=livreur&action=createOffer&commande_id=<?= $commande->id ?>" class="btn btn-sm btn-primary">Faire une offre</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<h2>Mes commandes acceptées</h2>

<?php if (empty($myCommandes)): ?>
    <p class="empty-message">Vous n'avez pas encore de commandes acceptées.</p>
<?php else: ?>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Adresse de livraison</th>
                <th>Statut</th>
                <th>Prix</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($myCommandes as $commande): ?>
                <tr>
                    <td><?= $commande->id ?></td>
                    <td><?= htmlspecialchars($commande->description) ?></td>
                    <td><?= htmlspecialchars($commande->adresse_livraison) ?></td>
                    <td>
                        <span class="badge badge-<?= $commande->statut ?>">
                            <?= htmlspecialchars($commande->statut) ?>
                        </span>
                    </td>
                    <td><?= number_format($commande->prix_final, 2) ?> €</td>
                    <td><?= date('d/m/Y H:i', strtotime($commande->created_at)) ?></td>
                    <td>
                        <?php if ($commande->statut == 'acceptee'): ?>
                            <form method="POST" action="/public/index.php?controller=livreur&action=markDelivered" style="display: inline;">
                                <input type="hidden" name="commande_id" value="<?= $commande->id ?>">
                                <button type="submit" class="btn btn-sm btn-success">Marquer comme livrée</button>
                            </form>
                        <?php elseif ($commande->statut == 'livree'): ?>
                            <form method="POST" action="/public/index.php?controller=livreur&action=markCompleted" style="display: inline;">
                                <input type="hidden" name="commande_id" value="<?= $commande->id ?>">
                                <button type="submit" class="btn btn-sm">Marquer comme terminée</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>