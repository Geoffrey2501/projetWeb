<?php

namespace iutnc\deefy\auth;

use iutnc\deefy\exception\AuthnException;
use iutnc\deefy\exception\AuthzException;

class AuthnProvider
{

    public static function register(\PDO $repo, string $email, string $password)
    {

        if (strlen($password) < 10) {
            throw new AuthnException("Password must be at least 10 characters long");
        }

        $stmt = $repo->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->execute([':email' => $email]);
        if ($stmt->fetch(\PDO::FETCH_ASSOC)) {
            throw new AuthnException("User already exists");
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $repo->prepare("INSERT INTO user (email, passwd) VALUES (:email, :password)");
        $stmt->execute([
            ':email' => $email,
            ':password' => $hashedPassword
        ]);
    }

    public static function signin(\PDO $repo,string $email, string $password)
    {
        $stmt = $repo->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (password_verify($password, $user['passwd'])) {
            $_SESSION['user'] = $user;
        } else {
            throw new AuthnException("Invalid email or password");
        }
    }
    public static function getSignedInUser()
    {
        if (!isset($_SESSION['user'])) {
            throw new AuthzException("No user is signed in");
        }
        return $_SESSION['user']['id'];
    }


}