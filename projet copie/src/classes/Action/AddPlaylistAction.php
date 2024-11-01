<?php
declare(strict_types=1);
namespace iutnc\deefy\Action;

use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\auth\AuthnProvider;
use iutnc\deefy\render\AudioListRenderer;
use iutnc\deefy\repository\DeefyRepository;

class AddPlaylistAction extends Action
{
    public function execute(): string
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Traiter la soumission du formulaire
            $id = AuthnProvider::getSignedInUser();
            $playlistName = filter_var($_POST['playlist_name'],FILTER_SANITIZE_SPECIAL_CHARS);
            $playlist = new Playlist($playlistName, 0, 0,[]);
            $repo = DeefyRepository::getInstance();
            $repo->addPlaylistVide($playlist, $id);

            $_SESSION['playlist'] = serialize($playlist);


            $renderer = new AudioListRenderer($playlist);

            $html = $renderer->render();
            $html .= '<a href="?action=add-track">Ajouter une piste</a>';
        } else {
            $html= "<form method='post'>
                <label for='playlist_name'>Nom de la playlist</label>
                <input type='text' id='playlist_name' name='playlist_name'>
                <button type='submit'>Créer la playlist</button>";
        }
        return $html;


    }
}