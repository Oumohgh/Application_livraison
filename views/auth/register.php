<?php
/**
 * Register View
 * 
 * Displays the registration form for new users.
 */

// Page title is set by controller
$pageTitle = $pageTitle ?? 'Inscription';
?>

<h2>Inscription</h2>

<form method="POST" action="/public/index.php?action=doRegister" class="form">
    <div class="form-group">
        <label for="name">Nom:</label>
        <input type="text" id="name" name="name" required>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>

    <div class="form-group">
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>
    </div>

    <div class="form-group">
        <label for="role">Rôle:</label>
        <select id="role" name="role" required>
            <option value="client">Client</option>
            <option value="livreur">Livreur</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>

<p>Déjà un compte? <a href="/public/index.php?action=login">Connectez-vous ici</a></p>