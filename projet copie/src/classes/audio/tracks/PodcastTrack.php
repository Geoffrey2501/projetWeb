<?php

declare(strict_types=1);
namespace iutnc\deefy\audio\tracks;

/**
 * Class PodcastTrack
 * @package iutnc\deefy\audio\tracks
 */
class PodcastTrack extends AudioTrack
{
    /**
     * @var string
     */
    protected String $auteur, $date;

    /**
     * PodcastTrack constructor.
     * @param string $titre
     * @param string $nomFichier
     * @param string $auteur
     * @param string $date
     * @param int $duree
     * @param string $genre
     */
    public function __construct(string $titre, string $nomFichier, string $auteur, string $date, int $duree, string $genre)
    {
        parent::__construct($titre, $nomFichier,$duree,$genre);
        $this->date = $date;
        $this->auteur = $auteur;
    }
}