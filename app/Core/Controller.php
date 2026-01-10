<?php
/**
 * Base Controller Class
 * 
 * Parent class for all controllers (AuthController, ClientController, etc.).
 * Provides common functionality: view loading, redirecting, authentication checks.
 * 
 * Why Base Controller?
 * - Common methods shared by all controllers
 * - Ensures consistent behavior across controllers
 * - Reduces code duplication
 */

namespace App\Core;

use App\Core\Flash;

abstract class Controller
{
    /**
     * Load a view file with data
     * 
     * Extracts data array to variables and includes layout.php
     * 
     * @param string $viewName View file path (without .php extension)
     * @param array $data Data to pass to view (extracted as variables)
     */
    protected function loadView(string $viewName, array $data = []): void
    {
        // Extract data array to variables for use in view
        // Example: $data = ['name' => 'John'] becomes $name = 'John' in view
        extract($data);
        
        // Set view file path for layout.php to include
        $viewFile = __DIR__ . '/../../views/' . $viewName . '.php';
        $pageTitle = $data['pageTitle'] ?? ucfirst(str_replace(['/', '_'], ' ', $viewName));
        
        // Include layout which wraps the specific view
        require __DIR__ . '/../../views/layout.php';
    }

    /**
     * Redirect to a URL and exit
     * 
     * @param string $url URL to redirect to
     */
    protected function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }

    /**
     * Check if user is currently logged in
     * 
     * @return bool True if user is logged in
     */
    protected function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }

    /**
     * Check if logged-in user has specific role
     * 
     * @param string $role Role to check ('client', 'livreur', or 'admin')
     * @return bool True if user has the role
     */
    protected function hasRole(string $role): bool
    {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === $role;
    }

    /**
     * Require user to be authenticated
     * Redirects to login page if not logged in
     */
    protected function requireAuth(): void
    {
        if (!$this->isLoggedIn()) {
            Flash::error("Vous devez être connecté pour accéder à cette page.");
            $this->redirect('/public/index.php?action=login');
        }
    }

    /**
     * Require user to have specific role
     * Redirects if user is not authenticated or doesn't have required role
     * 
     * @param string $role Required role ('client', 'livreur', or 'admin')
     */
    protected function requireRole(string $role): void
    {
        $this->requireAuth();
        
        if (!$this->hasRole($role)) {
            Flash::error("Accès refusé. Vous n'avez pas les permissions nécessaires.");
            $this->redirect('/public/index.php');
        }
    }
}