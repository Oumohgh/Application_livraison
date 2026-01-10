<?php

$pageTitle = $pageTitle ?? 'Créer une commande';
?>

<h2>Créer une nouvelle commande</h2>

<form method="POST" action="/public/index.php?controller=client&action=store" class="form">
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea>
    </div>

    <div class="form-group">
        <label for="adresse_livraison">Adresse de livraison:</label>
        <input type="text" id="adresse_livraison" name="adresse_livraison" required>
    </div>

    <button type="submit" class="btn btn-primary">Créer la commande</button>
    <a href="/public/index.php?controller=client&action=dashboard" class="btn btn-secondary">Annuler</a>
</form>