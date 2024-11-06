<?php

declare(strict_types=1);
namespace iutnc\deefy\Action;

use iutnc\deefy\auth\AuthnProvider;
use iutnc\deefy\auth\Authz;
use iutnc\deefy\exception\AuthnException;
use iutnc\deefy\exception\AuthzException;
use iutnc\deefy\render\AudioListRenderer;
use iutnc\deefy\repository\DeefyRepository;

/**
 * Class DisplayPlaylistAction
 * Action pour afficher une playlist
 */
class DisplayPlaylistAction extends Action
{

    /**
     * @return string
     * en fonction de la méthode HTTP, affiche un formulaire
     * pour ajouter une piste de podcast ou l'ajoute
     */
    public function execute(): string
    {
            if(!isset($_SESSION['user'])) {
                $html= "<h1>Vous devez être connecté pour accéder à cette page</h1>";
            }else{
                $html = "<h1>My playlists</h1>";
                $repo = DeefyRepository::getInstance();
                $playlists = $repo->findAllPlaylists((int)AuthnProvider::getSignedInUser());
                foreach ($playlists as $id => $playlist) {
                    $render = new AudioListRenderer($playlist);
                    $playlistContent = $render->render(); // Récupère le HTML généré par le render

                    // Formulaire pour définir la playlist courante avec render comme bouton submit
                    $html .= "<form method='post' action='main2.php?action=display-playlist'>";
                    $html .= "<input type='hidden' name='id' value='{$id}'>";
                    $html .= "<button type='submit'>";
                    $html .= $playlistContent; // Utilise le HTML rendu par le renderer comme contenu du bouton
                    $html .= "</button>";
                    $html .= "</form>";
                    $html .= "<br>";
                }
        }
        return $html;
    }
}