<?php

declare(strict_types=1);
namespace iutnc\deefy\render;

use iutnc\deefy\audio\lists\Album;

/**
 * Class for rendering audio lists.
 */
class AudioListRenderer implements Renderer
{

    /**
     * The audio list to render.
     * @var \iutnc\deefy\audio\lists\AudioList
     */
    private \iutnc\deefy\audio\lists\AudioList $audioList;

    /**
     * The renderer to use for rendering audio tracks.
     * @var Renderer
     */
    private Renderer $renderer;

    /**
     * Constructor.
     * @param \iutnc\deefy\audio\lists\AudioList $audioList The audio list to render.
     */
    public function __construct(\iutnc\deefy\audio\lists\AudioList $audioList){
        $this->audioList = $audioList;

        }

    /**
     * @param int $selector
     * @return string
     * renders the audio list
     */
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