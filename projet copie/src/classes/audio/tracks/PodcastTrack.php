<?php

namespace iutnc\deefy\audio\tracks;

class PodcastTrack extends AudioTrack
{
    protected String $auteur, $date;
    public function __construct(string $titre, string $nomFichier, string $auteur, string $date, int $duree, string $genre)
    {
        parent::__construct($titre, $nomFichier,$duree,$genre);
        $this->date = $date;
        $this->auteur = $auteur;
    }
}