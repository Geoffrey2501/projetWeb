<?php

namespace iutnc\deefy\render;

use iutnc\deefy\audio\lists\Album;

class AudioListRenderer implements Renderer
{
    private \iutnc\deefy\audio\lists\AudioList $audioList;
    private Renderer $renderer;

    public function __construct(\iutnc\deefy\audio\lists\AudioList $audioList){
        $this->audioList = $audioList;

        }

    public function render(int $selector=0): string{
        $res=$this->audioList->nom."\n";

        foreach($this->audioList->audios as $key => $value){

            if($value instanceof \iutnc\deefy\audio\tracks\AlbumTrack){
                $renderer= new AlbumTrackRenderer($value);

            }else{
                $renderer= new PodcastTrackRenderer($value);
            }
            $res.=$renderer->render(Renderer::COMPACT);
        }

        return $res;
    }
}