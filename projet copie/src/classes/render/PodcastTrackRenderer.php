<?php
declare(strict_types=1);
namespace iutnc\deefy\render;

/**
 * Class PodcastTrackRenderer
 * @package iutnc\deefy\render
 */
class PodcastTrackRenderer extends AudioTrackRenderer {

    /**
     * @return string
     * implémentation de la méthode renderCompact
     */
    public function renderCompact(): string {
        return "<div><strong>{$this->audioTrack->titre}</strong> by {$this->audioTrack->auteur}</div>";
    }

    /**
     * @return string
     * implémentation de la méthode renderLong
     */
    public function renderLong(): string {
        return "
            <div>
                <h1>{$this->audioTrack->titre}</h1>
                <p>Author: {$this->audioTrack->auteur}</p>
                <p>Date: {$this->audioTrack->date}</p>
                <audio controls>
                    <source src='{$this->audioTrack->nomFichier}' type='audio/mpeg'>
                    Your browser does not support the audio element.
                </audio>
            </div>
        ";
    }
}


