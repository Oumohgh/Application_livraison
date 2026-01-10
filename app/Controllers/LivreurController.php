<?php
/**
 * LivreurController - Handles Livreur Actions
 * 
 * Manages actions specific to livreurs:
 * - View available commandes (en_attente)
 * - Create offers for commandes
 * - View their accepted commandes
 * - Mark commandes as delivered
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Flash;
use App\Models\User;
use App\Models\Commande;
use App\Models\Offre;

class LivreurController extends Controller
{
    /**
     * Constructor - Require livreur role for all actions
     */
    public function __construct()
    {
        $this->requireRole('livreur');
    }

    /**
     * Display dashboard with available commandes and livreur's commandes
     */
    public function showDashboard(): void
    {
        $commandeModel = new Commande();
        $availableCommandes = $commandeModel->findAvailable();
        $myCommandes = $commandeModel->findByLivreur($_SESSION['user_id']);

        $this->loadView('livreur/dashboard', [
            'pageTitle' => 'Tableau de bord Livreur',
            'availableCommandes' => $availableCommandes,
            'myCommandes' => $myCommandes
        ]);
    }

    /**
     * Display form to create offer for commande
     */
    public function showCreateOfferForm(): void
    {
        $commandeId = (int)($_GET['commande_id'] ?? 0);

        $commandeModel = new Commande();
        $commande = $commandeModel->find($commandeId);

        if (!$commande || $commande->statut != Commande::STATUS_EN_ATTENTE) {
            Flash::error("Cette commande n'est plus disponible.");
            $this->redirect('/public/index.php?controller=livreur&action=dashboard');
        }

        $offreModel = new Offre();
        if ($offreModel->exists($commandeId, $_SESSION['user_id'])) {
            Flash::error("Vous avez déjà fait une offre pour cette commande.");
            $this->redirect('/public/index.php?controller=livreur&action=dashboard');
        }

        $this->loadView('livreur/create-offer', [
            'pageTitle' => 'Faire une offre',
            'commande' => $commande
        ]);
    }

    /**
     * Process offer creation
     * Validates input and saves offer to database
     */
    public function handleCreateOffer(): void
    {
        $commandeId = (int)($_POST['commande_id'] ?? 0);
        $prix = (float)($_POST['prix'] ?? 0);
        $duree = (int)($_POST['duree'] ?? 0);

        if (empty($commandeId) || $prix <= 0 || $duree <= 0) {
            Flash::error("Veuillez remplir tous les champs correctement.");
            $this->redirect('/public/index.php?controller=livreur&action=createOffer&commande_id=' . $commandeId);
        }

        $commandeModel = new Commande();
        $commande = $commandeModel->find($commandeId);

        if (!$commande || $commande->statut != Commande::STATUS_EN_ATTENTE) {
            Flash::error("Cette commande n'est plus disponible.");
            $this->redirect('/public/index.php?controller=livreur&action=dashboard');
        }

        $offreModel = new Offre();
        if ($offreModel->exists($commandeId, $_SESSION['user_id'])) {
            Flash::error("Vous avez déjà fait une offre pour cette commande.");
            $this->redirect('/public/index.php?controller=livreur&action=dashboard');
        }

        $offre = new Offre();
        $offre->commande_id = $commandeId;
        $offre->livreur_id = $_SESSION['user_id'];
        $offre->prix = $prix;
        $offre->duree = $duree;

        if ($offre->save()) {
            Flash::success("Offre créée avec succès! Le client pourra la voir et l'accepter.");
        } else {
            Flash::error("Une erreur est survenue lors de la création de l'offre.");
        }

        $this->redirect('/public/index.php?controller=livreur&action=dashboard');
    }

    /**
     * Mark commande as delivered
     * Changes status from "acceptee" to "livree"
     */
    public function handleMarkDelivered(): void
    {
        $commandeId = (int)($_POST['commande_id'] ?? 0);

        $commandeModel = new Commande();
        $commande = $commandeModel->find($commandeId);

        if (!$commande || 
            $commande->livreur_id != $_SESSION['user_id'] || 
            $commande->statut != Commande::STATUS_ACCEPTEE) {
            Flash::error("Impossible de marquer cette commande comme livrée.");
            $this->redirect('/public/index.php?controller=livreur&action=dashboard');
        }

        if ($commande->updateStatus(Commande::STATUS_LIVREE)) {
            Flash::success("Commande marquée comme livrée!");
        } else {
            Flash::error("Une erreur est survenue.");
        }

        $this->redirect('/public/index.php?controller=livreur&action=dashboard');
    }

    /**
     * Mark commande as completed
     * Changes status from "livree" to "terminee"
     */
    public function handleMarkCompleted(): void
    {
        $commandeId = (int)($_POST['commande_id'] ?? 0);

        $commandeModel = new Commande();
        $commande = $commandeModel->find($commandeId);

        if (!$commande || 
            $commande->livreur_id != $_SESSION['user_id'] || 
            $commande->statut != Commande::STATUS_LIVREE) {
            Flash::error("Impossible de marquer cette commande comme terminée.");
            $this->redirect('/public/index.php?controller=livreur&action=dashboard');
        }

        if ($commande->updateStatus(Commande::STATUS_TERMINEE)) {
            Flash::success("Commande terminée!");
        } else {
            Flash::error("Une erreur est survenue.");
        }

        $this->redirect('/public/index.php?controller=livreur&action=dashboard');
    }
}