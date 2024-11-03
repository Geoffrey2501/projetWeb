<?php

declare(strict_types=1);
namespace iutnc\deefy\audio\lists;
use iutnc\deefy\audio\tracks\AudioTrack;

/**
 * Class Playlist
 */
class Playlist extends AudioList
{
    /**
     * Playlist constructor.
     * @param string $nom
     * @param int $nbPistes
     * @param int $dureeTotal
     * @param array $audios
     */
    public function __construct(string $nom, int $nbPistes, int $dureeTotal, array $audios = [])
    {
        parent::__construct($nom, $nbPistes, $dureeTotal, $audios);
    }

    /**
     * @param AudioTrack $track
     */
    public function add(AudioTrack $track)
    {
        $a = $this->__get('audios');
        $a[] = $track;
        $this->__set('audios', $a);
        $this->dureeTotal+= $track->duree;
        $this->nbPistes++;
    }

    /**
     * @param array $liste
     */
    public function addliste(array $liste){
        foreach ($liste as $track){
            $i=1;
            foreach ($this->audios as $audio) {
                if ($audio->nomFichier == $track->nomFichier) {
                    $i=0;
                    break;
                }
            }
            if($i==1){
                $this->add($track);
            }
        }
    }

    /**
     * @param int $i
     */
    public function remove(int $i)
    {
        unset($this->audios[$i]);
    }

}