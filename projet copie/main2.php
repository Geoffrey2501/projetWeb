<?php
require_once "vendor/autoload.php";

use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\dispatcher\Dispatcher;

error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

$dispatcher = new Dispatcher();
$dispatcher->run();


