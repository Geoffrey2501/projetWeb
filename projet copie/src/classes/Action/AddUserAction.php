<?php
declare(strict_types=1);
namespace iutnc\deefy\Action;

use iutnc\deefy\repository\DeefyRepository;

class AddUserAction extends Action
{

    public function execute(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $email = $_POST['email'];
                $password= filter_var($_POST['mdp'], FILTER_SANITIZE_SPECIAL_CHARS);
                echo $password;

                $repo = DeefyRepository::getInstance();
                try {
                    \iutnc\deefy\auth\AuthnProvider::register($repo->getPDO(), $email, $password);
                    $html="<h1>Vous êtes insrcit</h1>";
                } catch (\iutnc\deefy\exception\AuthnException $e) {
                    $html="<h1>Identification incorrect</h1>
                <p>".$e->getMessage()."</p>";
                }

            } else {
                $res = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
                $html = "<h1>Erreur de saisie</h1> 
                            <br>
                            <p>$res</p>";
            }
        } else {
            $html= "<form method='post'>
                <label for='email'>Email</label>
                <input type='text' id='email' name='email'>
                <br>
                <label for='mdp'>Password</label>
                <input type='password' id='mpd' name='mdp'>
                <br>
                <button type='submit'>Connexion</button>";
        }
        return $html;
    }
}