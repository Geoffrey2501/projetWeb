<?php

declare(strict_types=1);
namespace iutnc\deefy\Action;

use iutnc\deefy\auth\Authz;
use iutnc\deefy\exception\AuthzException;
use iutnc\deefy\render\AudioListRenderer;
use iutnc\deefy\repository\DeefyRepository;

/**
 * Class DisplayPlaylist
 * Action pour afficher une playlist
 */
class DisplayPlaylist extends Action
{

    /**
     * @return string
     * en fonction de la méthode HTTP, affiche un formulaire
     * pour ajouter une piste de podcast ou l'ajoute
     */
    public function execute(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id'])){
                try{
                    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
                    Authz::checkPlaylistOwner($id);
                    $_SESSION['playlist'] = serialize(DeefyRepository::getInstance()->getPlaylist($id));
                }catch (AuthzException $e){
                    return $e->getMessage();
                }

            }
        }
        $html="connectez vous";
        if(isset($_SESSION['playlist'])){$playlist = unserialize($_SESSION['playlist']);
        $render = new AudioListRenderer($playlist);
        $html = $render->render();
        $html.="<a href='?action=add-track'>Ajouter une piste</a>";}
        return $html;
    }
}