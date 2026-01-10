<?php
/**
 * ClientController - Handles Client Actions
 * 
 * Manages actions specific to clients:
 * - View their commandes
 * - Create new commandes
 * - View offers for their commandes
 * - Accept an offer
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Flash;
use App\Models\User;
use App\Models\Commande;
use App\Models\Offre;

class ClientController extends Controller
{
    /**
     * Constructor - Require client role for all actions
     */
    public function __construct()
    {
        $this->requireRole('client');
    }

    /**
     * Display client dashboard with all their commandes
     */
    public function showDashboard(): void
    {
        $commandeModel = new Commande();
        $commandes = $commandeModel->findByClient($_SESSION['user_id']);

        $this->loadView('client/dashboard', [
            'pageTitle' => 'Tableau de bord Client',
            'commandes' => $commandes
        ]);
    }

    /**
     * Display form to create new commande
     */
    public function showCreateForm(): void
    {
        $this->loadView('client/create', ['pageTitle' => 'Créer une commande']);
    }

    /**
     * Process new commande creation
     * Validates input and saves to database
     */
    public function handleCreate(): void
    {
        $description = $_POST['description'] ?? '';
        $adresseLivraison = $_POST['adresse_livraison'] ?? '';

        if (empty($description) || empty($adresseLivraison)) {
            Flash::error("Veuillez remplir tous les champs.");
            $this->redirect('/public/index.php?controller=client&action=create');
        }

        $commande = new Commande();
        $commande->client_id = $_SESSION['user_id'];
        $commande->description = $description;
        $commande->adresse_livraison = $adresseLivraison;
        $commande->statut = Commande::STATUS_EN_ATTENTE;

        if ($commande->save()) {
            Flash::success("Commande créée avec succès! Les livreurs peuvent maintenant faire des offres.");
            $this->redirect('/public/index.php?controller=client&action=dashboard');
        } else {
            Flash::error("Une erreur est survenue lors de la création de la commande.");
            $this->redirect('/public/index.php?controller=client&action=create');
        }
    }

    /**
     * Display commande details and all offers for it
     * 
     * @param int $commandeId Commande ID from URL parameter
     */
    public function showCommandeDetails(int $commandeId): void
    {
        $commandeModel = new Commande();
        $commande = $commandeModel->find($commandeId);

        if (!$commande || $commande->client_id != $_SESSION['user_id']) {
            Flash::error("Commande introuvable.");
            $this->redirect('/public/index.php?controller=client&action=dashboard');
        }

        $offreModel = new Offre();
        $offres = $offreModel->findByCommande($commandeId);

        $this->loadView('client/show', [
            'pageTitle' => 'Détails de la commande',
            'commande' => $commande,
            'offres' => $offres
        ]);
    }

    /**
     * Accept an offer for a commande
     * Updates commande with livreur_id and prix_final
     */
    public function handleAcceptOffer(): void
    {
        $offreId = (int)($_POST['offre_id'] ?? 0);
        $commandeId = (int)($_POST['commande_id'] ?? 0);

        $offreModel = new Offre();
        $offre = $offreModel->find($offreId);

        $commandeModel = new Commande();
        $commande = $commandeModel->find($commandeId);

        if (!$offre || !$commande || 
            $commande->client_id != $_SESSION['user_id'] || 
            $commande->statut != Commande::STATUS_EN_ATTENTE ||
            $offre->commande_id != $commandeId) {
            Flash::error("Impossible d'accepter cette offre.");
            $this->redirect('/public/index.php?controller=client&action=dashboard');
        }

        if ($commande->acceptOffer($offre->livreur_id, $offre->prix)) {
            Flash::success("Offre acceptée! La commande est maintenant en cours de livraison.");
        } else {
            Flash::error("Une erreur est survenue.");
        }

        $this->redirect('/public/index.php?controller=client&action=show&id=' . $commandeId);
    }
}