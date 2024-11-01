<?php

namespace iutnc\deefy\auth;

use iutnc\deefy\exception\AuthzException;
use iutnc\deefy\repository\DeefyRepository;

class Authz
{

    public static function checkRole(string $expectedRole): bool
    {
        $user = AuthnProvider::getSignedInUser();

        if ($user['role'] != $expectedRole) {
            throw new AuthzException("User does not have the required role");
        }
        return true;
    }

    public static function checkPlaylistOwner(int $playlistId)
    {
        $user = AuthnProvider::getSignedInUser();
        $repo = DeefyRepository::getInstance();
        $stmt = $repo->getPDO()->prepare("SELECT id_pl FROM user2playlist WHERE id_user = :id");
        $stmt->execute([':id' => $user]);

        $trouver = false;
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            if ($row['id_pl'] == $playlistId) {
                $trouver = true;
            }
        }

        if (!$trouver and  !self::checkRole(100)) {
            throw new AuthzException("User is not the owner of the playlist");
        }
    }
}