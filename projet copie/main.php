<?php


require_once  __DIR__ . '/../../vendor/autoload.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');
echo "ok";
\iutnc\deefy\repository\DeefyRepository::setConfig(__DIR__ . '/../config/deefy.db.ini');
echo "ok";
$repo = \iutnc\deefy\repository\DeefyRepository::getInstance();
echo "ok";
$playlists = $repo->findAllPlaylists();
foreach ($playlists as $pl) {
    echo "playlist  : " . $pl->nom . ":". $pl->id . "\n";
}

