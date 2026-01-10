<?php

if (!isset($viewFile)) {
    $viewFile = __DIR__ . '/auth/login.php';
}

if (!file_exists($viewFile)) {
    $viewFile = __DIR__ . '/auth/login.php';
}

$pageTitle = $pageTitle ?? 'Delivry';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Delivry' ?> - Delivry</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <h1><a href="/public/index.php">Delivry</a></h1>
            <nav>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span>Bonjour, <?= htmlspecialchars($_SESSION['user_name']) ?> (<?= htmlspecialchars($_SESSION['user_role']) ?>)</span>
                    <a href="/public/index.php">Tableau de bord</a>
                    <a href="/public/index.php?action=logout">Déconnexion</a>
                <?php else: ?>
                    <a href="/public/index.php?action=login">Connexion</a>
                    <a href="/public/index.php?action=register">Inscription</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <!-- Flash Messages -->
    <div class="container">
        <?php if (\App\Core\Flash::has(\App\Core\Flash::SUCCESS)): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars(\App\Core\Flash::get(\App\Core\Flash::SUCCESS)) ?>
            </div>
        <?php endif; ?>

        <?php if (\App\Core\Flash::has(\App\Core\Flash::ERROR)): ?>
            <div class="alert alert-error">
                <?= htmlspecialchars(\App\Core\Flash::get(\App\Core\Flash::ERROR)) ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Main Content -->
    <main class="container">
        <?php include $viewFile; ?>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2026 Delivry - Application de livraison simple</p>
        </div>
    </footer>
</body>
</html>