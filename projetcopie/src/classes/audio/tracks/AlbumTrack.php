<?php

declare(strict_types=1);
namespace iutnc\deefy\audio\tracks;

/**
 * Class AlbumTrack
 */
class AlbumTrack extends AudioTrack
{
    /**
     * @var string
     */
    protected string  $artiste, $album;

    /**
     * @var int
     */
    protected int $numPiste, $annee;


    /**
     * AlbumTrack constructor.
     * @param string $titre
     * @param string $nomFichier
     * @param string $album
     * @param int $numPiste
     * @param int $duree
     * @param string $genre
     * @param int $annee
     * @param string $artiste
     */
    public function __construct(string $titre, string $nomFichier, string $album, int $numPiste,int $duree, string $genre, int $annee, string $artiste)
    {
        parent::__construct($titre, $nomFichier,$duree,$genre);
        $this->album = $album;
        $this->numPiste = $numPiste;
        $this->artiste = $artiste;
        $this->annee = $annee;
    }

}