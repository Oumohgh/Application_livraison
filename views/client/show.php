<?php

$pageTitle = $pageTitle ?? 'Détails de la commande';
?>

<h2>Détails de la commande #<?= $commande->id ?></h2>

<div class="card">
    <h3>Informations</h3>
    <p><strong>Description:</strong> <?= htmlspecialchars($commande->description) ?></p>
    <p><strong>Adresse de livraison:</strong> <?= htmlspecialchars($commande->adresse_livraison) ?></p>
    <p><strong>Statut:</strong> <span class="badge badge-<?= $commande->statut ?>"><?= htmlspecialchars($commande->statut) ?></span></p>
    <p><strong>Date de création:</strong> <?= date('d/m/Y H:i', strtotime($commande->created_at)) ?></p>
    
    <?php if ($commande->statut != 'en_attente'): ?>
        <p><strong>Prix final:</strong> <?= number_format($commande->prix_final, 2) ?> €</p>
    <?php endif; ?>
</div>

<a href="/public/index.php?controller=client&action=dashboard" class="btn btn-secondary">Retour</a>

<?php if ($commande->statut == 'en_attente'): ?>
    <h3>Offres disponibles</h3>
    
    <?php if (empty($offres)): ?>
        <p class="empty-message">Aucune offre pour le moment. Les livreurs peuvent faire des offres pour cette commande.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Livreur</th>
                    <th>Prix</th>
                    <th>Durée (minutes)</th>
                    <th>Date de l'offre</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($offres as $offre): ?>
                    <tr>
                        <td><?= htmlspecialchars($offre->livreur_name ?? 'N/A') ?></td>
                        <td><?= number_format($offre->prix, 2) ?> €</td>
                        <td><?= $offre->duree ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($offre->created_at)) ?></td>
                        <td>
                            <form method="POST" action="/public/index.php?controller=client&action=acceptOffer" style="display: inline;">
                                <input type="hidden" name="offre_id" value="<?= $offre->id ?>">
                                <input type="hidden" name="commande_id" value="<?= $commande->id ?>">
                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Êtes-vous sûr de vouloir accepter cette offre?')">Accepter</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php endif; ?>