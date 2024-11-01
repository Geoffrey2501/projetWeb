<?php

declare(strict_types=1);
namespace iutnc\deefy\audio\lists;

/**
 * Class Album
 */
class Album extends AudioList {

    /**
     * @var string
     */
    protected string $artiste,$dateSortie;

    /**
     * Album constructor.
     * @param string $nom
     * @param int $nbPistes
     * @param int $dureeTotal
     * @param string $artiste
     * @param string $dateSortie
     * @param array $audios
     */
    public function __construct(string $nom, int $nbPistes, int $dureeTotal, string $artiste, string $dateSortie, array $audios) {
        parent::__construct( $nom,  $nbPistes, $dureeTotal, $audios);
        $this->dateSortie = $dateSortie;
        $this->artiste = $artiste;
    }
}