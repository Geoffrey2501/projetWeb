<?php

declare(strict_types=1);

/**
 * Main entry point for the application
 */

//Load the Composer autoloader
require_once "vendor/autoload.php";

//Import the necessary classes
use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\dispatcher\Dispatcher;

//Set the error reporting level
error_reporting(E_ALL);
ini_set('display_errors', '1');


//Start the session
session_start();

//Create a new instance of the Dispatcher and run it
$dispatcher = new Dispatcher();
$dispatcher->run();


