<?php
namespace iutnc\deefy\audio\lists;
use iutnc\deefy\audio\tracks\AudioTrack;

class Playlist extends AudioList
{
    public function __construct(string $nom, int $nbPistes, int $dureeTotal, array $audios = [])
    {
        parent::__construct($nom, $nbPistes, $dureeTotal, $audios);
    }

    public function add(AudioTrack $track)
    {
        $a = $this->__get('audios');
        $a[] = $track;
        $this->__set('audios', $a);
        $this->dureeTotal+= $track->duree;
        $this->nbPistes++;
    }
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
    public function remove(int $i)
    {
        unset($this->audios[$i]);
    }

}