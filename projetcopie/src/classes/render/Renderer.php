<?php

declare(strict_types=1);

namespace iutnc\deefy\render;

/**
 * Interface Renderer
 */
interface Renderer {
    const COMPACT = 1;
    const LONG = 2;

    /**
     * @param int $selector
     * @return string
     * fonction qui permet le rendu de l'objet
     */
    public function render(int $selector): string;
}
