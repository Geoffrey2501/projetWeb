<?php

declare(strict_types=1);
namespace iutnc\deefy\render;

/**
 * Class AlbumTrackRenderer
 * @package iutnc\deefy\render
 */
class AlbumTrackRenderer extends AudioTrackRenderer {

    /**
     * @return string
     * render the audio track in a compact way
     */
    public function renderCompact(): string {
        return "<div>
                    <p>{$this->audioTrack->genre}</p>
                    <p> {$this->audioTrack->artiste}</p>
                    <p>{$this->audioTrack->titre}</p>
                    <p>{$this->audioTrack->nomFichier}</p>
                </div>";
    }

    /**
     * @return string
     * render the audio track in a long way
     */
    public function renderLong(): string {
        return "
            <div>
                <h1>{$this->audioTrack->titre}</h1>
                <p>Artist: {$this->audioTrack->artiste}</p>
                <p>Album: {$this->audioTrack->album}</p>
                <p>Year: {$this->audioTrack->annee}</p>
                <audio controls>
                    <source src='{$this->audioTrack->nomFichier}' type='audio/mpeg'>
                    Your browser does not support the audio element.
                </audio>
            </div>
        ";
    }
}


