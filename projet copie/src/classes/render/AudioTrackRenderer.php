<?php
namespace iutnc\deefy\render;

abstract class AudioTrackRenderer implements Renderer {
    protected $audioTrack;

    public function __construct(\iutnc\deefy\audio\tracks\AudioTrack $audioTrack) {
        $this->audioTrack = $audioTrack;
    }

    public function render(int $selector): string {
        if ($selector == Renderer::COMPACT) {
            return $this->renderCompact();
        } elseif ($selector == Renderer::LONG) {
            return $this->renderLong();
        }
        return '';
    }

    abstract function renderCompact(): string;
    abstract function renderLong(): string;
}

