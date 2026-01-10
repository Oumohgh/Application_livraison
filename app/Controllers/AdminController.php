<?php
/**
 * AdminController - Handles Admin Actions
 * 
 * Manages actions specific to admins:
 * - View all users
 * - View all commandes
 * - View system statistics
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Flash;
use App\Models\User;
use App\Models\Commande;
use App\Models\Offre;

class AdminController extends Controller
{
    /**
     * Constructor - Require admin role for all actions
     */
    public function __construct()
    {
        $this->requireRole('admin');
    }

    /**
     * Display admin dashboard with statistics
     */
    public function showDashboard(): void
    {
        $userModel = new User();
        $commandeModel = new Commande();

        $totalUsers = count($userModel->findAll());
        $totalClients = count($userModel->findByRole('client'));
        $totalLivreurs = count($userModel->findByRole('livreur'));
        $totalCommandes = count($commandeModel->findAll());
        $allCommandes = $commandeModel->findAll();
        $allUsers = $userModel->findAll();

        $this->loadView('admin/dashboard', [
            'pageTitle' => 'Tableau de bord Admin',
            'totalUsers' => $totalUsers,
            'totalClients' => $totalClients,
            'totalLivreurs' => $totalLivreurs,
            'totalCommandes' => $totalCommandes,
            'commandes' => $allCommandes,
            'users' => $allUsers
        ]);
    }
}