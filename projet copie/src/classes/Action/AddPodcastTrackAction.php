<?php
declare(strict_types=1);

namespace iutnc\deefy\Action;

use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\AudioTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\render\AudioListRenderer;
use iutnc\deefy\repository\DeefyRepository;

/**
 * Class AddPodcastTrackAction
 * Action pour ajouter une piste de podcast
 */
class AddPodcastTrackAction extends Action
{

    /**
     * @return string
     * en fonction de la méthode HTTP, affiche un formulaire
     * pour ajouter une piste de podcast ou l'ajoute
     */
    public function execute(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérifier si le fichier est téléchargé et si c'est un fichier MP3
            if (isset($_FILES['track_file']) &&
                str_ends_with($_FILES['track_file']['name'], '.mp3') &&
                $_FILES['track_file']['type'] === 'audio/mpeg') {

                // Générer un nom aléatoire pour le fichier
                $nameFile = filter_var($_FILES['track_file']['name'], FILTER_SANITIZE_SPECIAL_CHARS);
                $uploadDir = __DIR__ . '/../../../audio/';
                $uploadFile = $uploadDir . $nameFile;

                // Déplacer le fichier téléchargé dans le répertoire audio
                if (move_uploaded_file($_FILES['track_file']['tmp_name'], $uploadFile)) {
                    // Récupérer et nettoyer les données de la piste
                    $trackName = filter_var($_POST['track_name'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $trackAuthor = filter_var($_POST['track_author'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $trackDate = filter_var($_POST['track_date'], FILTER_SANITIZE_SPECIAL_CHARS);
                    // Convertir la date en format Y-m-d
                    $trackDate = date('Y-m-d', strtotime($trackDate));
                    $trackDuration = (int)filter_var($_POST['track_duration'], FILTER_SANITIZE_NUMBER_INT);
                    $trackCategory = filter_var($_POST['track_category'], FILTER_SANITIZE_SPECIAL_CHARS);


                    $track = new PodcastTrack($trackName, $nameFile, $trackAuthor, $trackDate, $trackDuration, $trackCategory);


                    $playlist = unserialize($_SESSION['playlist']);
                    // Ajouter la piste à la base de données et à la playlist
                    $repo = DeefyRepository::getInstance();
                    $id=$repo->addTrack($track);
                    $repo->addTrackToPlaylist($id, $playlist);
                    // Dé-sérialiser la playlist de la session
                    // Ajouter le podcast à la playlist
                    $playlist->add($track);
                    // Ré-serialiser la playlist pour stocker dans la session
                    $_SESSION['playlist'] = serialize($playlist);
                    $renderer = new AudioListRenderer($playlist);
                    $html = $renderer->render();

                } else {
                    // Gérer l'erreur de téléchargement
                    $html = "<p>Erreur lors du téléchargement du fichier.</p>";
                }
            } else {
                // Gérer les erreurs de validation de fichier
                $html = "<p>Le fichier doit être un fichier MP3 valide.</p>";
            }
        } else {
            $html = "<form method='post' enctype='multipart/form-data'>
            <label for='track_name'>Nom</label>
            <input type='text' id='track_name' name='track_name'>
            
            <label for='track_file'>Fichier audio</label>
            <input type='file' id='track_file' name='track_file'>
            
            <label for='track_author'>Auteur</label>
            <input type='text' id='track_author' name='track_author'>
            
            <label for='track_date'>Date de publication</label>
            <input type='date' id='track_date' name='track_date'>
            
            <label for='track_duration'>Durée</label>
            <input type='number' id='track_duration' name='track_duration'>
            
            <label for='track_category'>Catégorie</label>
            <input type='text' id='track_category' name='track_category'>
            
            <button type='submit'>Ajouter la piste</button>
          </form>";

        }

        return $html;
    }

}