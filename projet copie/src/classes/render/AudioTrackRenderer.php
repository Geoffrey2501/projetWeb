<?php

declare(strict_types=1);
namespace iutnc\deefy\render;

/**
 * Abstract class for rendering audio tracks.
 */
abstract class AudioTrackRenderer implements Renderer {

    /**
     * The audio track to render.
     * @var \iutnc\deefy\audio\tracks\AudioTrack
     */
    protected $audioTrack;

    /**
     * Constructor.
     * @param \iutnc\deefy\audio\tracks\AudioTrack $audioTrack The audio track to render.
     */
    public function __construct(\iutnc\deefy\audio\tracks\AudioTrack $audioTrack) {
        $this->audioTrack = $audioTrack;
    }

    /**
     * Renders the audio track.
     * @param int $selector The rendering selector.
     * @return string The rendered audio track.
     */
    public function render(int $selector): string {
        if ($selector == Renderer::COMPACT) {
            return $this->renderCompact();
        } elseif ($selector == Renderer::LONG) {
            return $this->renderLong();
        }
        return '';
    }

    /**
     * Renders the audio track in compact form.
     * @return string The rendered audio track.
     */
    abstract function renderCompact(): string;

    /**
     * Renders the audio track in long form.
     * @return string The rendered audio track.
     */
    abstract function renderLong(): string;
}

