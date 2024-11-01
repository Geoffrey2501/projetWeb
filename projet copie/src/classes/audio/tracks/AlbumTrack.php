<?php
namespace iutnc\deefy\audio\tracks;

class AlbumTrack extends AudioTrack
{
    protected string  $artiste, $album;
    protected int $numPiste, $annee;


    public function __construct(string $titre, string $nomFichier, string $album, int $numPiste,int $duree, string $genre, int $annee, string $artiste)
    {
        parent::__construct($titre, $nomFichier,$duree,$genre);
        $this->album = $album;
        $this->numPiste = $numPiste;
        $this->artiste = $artiste;
        $this->annee = $annee;
    }

}