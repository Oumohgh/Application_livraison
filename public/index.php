<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../vendor/autoload.php';


use App\Controllers\AuthController;
use App\Controllers\ClientController;
use App\Controllers\LivreurController;
use App\Controllers\AdminController;
use App\Core\Flash;


$action = $_GET['action'] ?? '';
$controller = $_GET['controller'] ?? '';

try {
   
    if ($action === 'login') {
        $authController = new AuthController();
        $authController->showLoginForm();
    } 
    elseif ($action === 'doLogin') {
        $authController = new AuthController();
        $authController->handleLogin();
    } 
    elseif ($action === 'register') {
        $authController = new AuthController();
        $authController->showRegisterForm();
    } 
    elseif ($action === 'doRegister') {
        $authController = new AuthController();
        $authController->handleRegister();
    } 
    elseif ($action === 'logout') {
        $authController = new AuthController();
        $authController->handleLogout();
    }

    elseif ($controller === 'client') {
        $clientController = new ClientController();
        $action = $action ?: 'dashboard';
       
        $methodMap = [
            'dashboard' => 'showDashboard',
            'create' => 'showCreateForm',
            'store' => 'handleCreate',
            'show' => 'showCommandeDetails',
            'acceptOffer' => 'handleAcceptOffer'
        ];
        
        $methodName = $methodMap[$action] ?? 'showDashboard';
        
        if ($action === 'show') {
            $commandeId = (int)($_GET['id'] ?? 0);
            $clientController->showCommandeDetails($commandeId);
        } elseif (method_exists($clientController, $methodName)) {
            $clientController->$methodName();
        } else {
            Flash::error("Action non trouvée.");
            header("Location: /public/index.php");
            exit;
        }
    }
    
    elseif ($controller === 'livreur') {
        $livreurController = new LivreurController();
        $action = $action ?: 'dashboard';
        
       
        $methodMap = [
            'dashboard' => 'showDashboard',
            'createOffer' => 'showCreateOfferForm',
            'storeOffer' => 'handleCreateOffer',
            'markDelivered' => 'handleMarkDelivered',
            'markCompleted' => 'handleMarkCompleted'
        ];
        
        $methodName = $methodMap[$action] ?? 'showDashboard';
        
        if (method_exists($livreurController, $methodName)) {
            $livreurController->$methodName();
        } else {
            Flash::error("Action non trouvée.");
            header("Location: /public/index.php");
            exit;
        }
    }
    
    elseif ($controller === 'admin') {
        $adminController = new AdminController();
        $action = $action ?: 'dashboard';
        
       
        $methodMap = [
            'dashboard' => 'showDashboard'
        ];
        
        $methodName = $methodMap[$action] ?? 'showDashboard';
        
        if (method_exists($adminController, $methodName)) {
            $adminController->$methodName();
        } else {
            Flash::error("Action non trouvée.");
            header("Location: /public/index.php");
            exit;
        }
    }
   
    else {
        if (isset($_SESSION['user_id'])) {
            $role = $_SESSION['user_role'] ?? 'client';
            header("Location: /public/index.php?controller=$role&action=dashboard");
        } else {
            header("Location: /public/index.php?action=login");
        }
        exit;
    }
} catch (Exception $e) {
    die("Erreur: " . $e->getMessage());
}