<?php
namespace iutnc\deefy\audio\lists;
class Album extends AudioList {

    protected string $artiste,$dateSortie;
    public function __construct(string $nom, int $nbPistes, int $dureeTotal, string $artiste, string $dateSortie, array $audios) {
        parent::__construct( $nom,  $nbPistes, $dureeTotal, $audios);
        $this->dateSortie = $dateSortie;
        $this->artiste = $artiste;
    }
}