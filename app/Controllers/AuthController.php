<?php
/**
 * AuthController - Handles Authentication
 * 
 * Manages user login, registration, and logout.
 * Does NOT require authentication (users must login first).
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Flash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Display login form
     * Redirects to dashboard if already logged in
     */
    public function showLoginForm(): void
    {
        if ($this->isLoggedIn()) {
            $this->redirect('/public/index.php');
        }

        $this->loadView('auth/login', ['pageTitle' => 'Connexion']);
    }

    /**
     * Process login form submission
     * Validates credentials and creates session
     */
    public function handleLogin(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            Flash::error("Veuillez remplir tous les champs.");
            $this->redirect('/public/index.php?action=login');
        }

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if (!$user || !$user->verifyPassword($password)) {
            Flash::error("Email ou mot de passe incorrect.");
            $this->redirect('/public/index.php?action=login');
        }

        // Create session
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_role'] = $user->role;
        $_SESSION['user_email'] = $user->email;

        Flash::success("Connexion réussie! Bienvenue " . $user->name);
        $this->redirect('/public/index.php');
    }

    /**
     * Display registration form
     * Redirects to dashboard if already logged in
     */
    public function showRegisterForm(): void
    {
        if ($this->isLoggedIn()) {
            $this->redirect('/public/index.php');
        }

        $this->loadView('auth/register', ['pageTitle' => 'Inscription']);
    }

    /**
     * Process registration form submission
     * Validates input and creates new user account
     */
    public function handleRegister(): void
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? 'client';

        if (empty($name) || empty($email) || empty($password)) {
            Flash::error("Veuillez remplir tous les champs.");
            $this->redirect('/public/index.php?action=register');
        }

        if (!in_array($role, ['client', 'livreur', 'admin'], true)) {
            $role = 'client';
        }

        $userModel = new User();
        if ($userModel->findByEmail($email)) {
            Flash::error("Cet email est déjà utilisé.");
            $this->redirect('/public/index.php?action=register');
        }

        // Create new user
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $password; // Will be hashed in save() method
        $user->role = $role;

        if ($user->save()) {
            Flash::success("Inscription réussie! Vous pouvez maintenant vous connecter.");
            $this->redirect('/public/index.php?action=login');
        } else {
            Flash::error("Une erreur est survenue lors de l'inscription.");
            $this->redirect('/public/index.php?action=register');
        }
    }

    /**
     * Logout user and destroy session
     */
    public function handleLogout(): void
    {
        session_destroy();
        session_start(); // Start new empty session

        Flash::success("Déconnexion réussie.");
        $this->redirect('/public/index.php?action=login');
    }
}