<?php

declare(strict_types=1);
namespace iutnc\deefy\Action;

use iutnc\deefy\repository\DeefyRepository;

/**
 * Class Signin
 * Action pour se connecter
 */
class Signin extends Action
{

    /**
     * @return string
     * en fonction de la méthode HTTP, affiche un formulaire
     * pour se connecter ou connecte l'utilisateur
     */
    public function execute(): string
    {
        $repo = DeefyRepository::getInstance();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
            try {
                \iutnc\deefy\auth\AuthnProvider::signin($repo->getPDO(), $email, $password);
                $html="<h1>Vous êtes connecté</h1>";
            } catch (\iutnc\deefy\exception\AuthnException $e) {

                $html="<h1>Identification incorrect</h1>
                <p>".$e->getMessage()."</p>";
            }
        }
        else{
                $html ="
                            <form method='post'>
                                <label for='email'>Email:</label>
                                <input type='email' id='email' name='email' required><br>
                                <label for='password'>Mot de passe:</label>
                                <input type='password' id='password' name='password' required><br>
                                <button type='submit'>Se connecter</button>
                            </form>";
            }

        return $html;
        }

}