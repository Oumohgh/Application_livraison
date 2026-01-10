<?php
/**
 * Create Offer View
 * 
 * Displays the form for livreurs to create an offer for a commande.
 */

// Page title is set by controller
$pageTitle = $pageTitle ?? 'Faire une offre';
?>

<h2>Faire une offre pour la commande #<?= $commande->id ?></h2>

<div class="card">
    <h3>Détails de la commande</h3>
    <p><strong>Description:</strong> <?= htmlspecialchars($commande->description) ?></p>
    <p><strong>Adresse de livraison:</strong> <?= htmlspecialchars($commande->adresse_livraison) ?></p>
</div>

<form method="POST" action="/public/index.php?controller=livreur&action=storeOffer" class="form">
    <input type="hidden" name="commande_id" value="<?= $commande->id ?>">

    <div class="form-group">
        <label for="prix">Prix (€):</label>
        <input type="number" id="prix" name="prix" step="0.01" min="0" required>
    </div>

    <div class="form-group">
        <label for="duree">Durée de livraison (minutes):</label>
        <input type="number" id="duree" name="duree" min="1" required>
    </div>

    <button type="submit" class="btn btn-primary">Envoyer l'offre</button>
    <a href="/public/index.php?controller=livreur&action=dashboard" class="btn btn-secondary">Annuler</a>
</form>