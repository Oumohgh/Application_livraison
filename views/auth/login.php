<?php
/**
 * Login View
 * 
 * Displays the login form for users to authenticate.
 */

// Page title is set by controller
$pageTitle = $pageTitle ?? 'Connexion';
?>

<h2>Connexion</h2>

<form method="POST" action="/public/index.php?action=doLogin" class="form">
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>

    <div class="form-group">
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>
    </div>

    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>

<p>Pas encore de compte? <a href="/public/index.php?action=register">Inscrivez-vous ici</a></p>