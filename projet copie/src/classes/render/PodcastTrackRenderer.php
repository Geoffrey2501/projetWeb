<?php
namespace iutnc\deefy\render;
class PodcastTrackRenderer extends AudioTrackRenderer {

    public function renderCompact(): string {
        return "<div><strong>{$this->audioTrack->titre}</strong> by {$this->audioTrack->auteur}</div>";
    }

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


