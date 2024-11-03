<?php

declare(strict_types=1);
namespace iutnc\deefy\audio\tracks;

/**
 * Class AudioTrack
 */
class AudioTrack
{
    /**
     * @var string
     */
    private string $titre, $genre, $nomFichier;

    /**
     * @var int
     */
    private int $duree;


    /**
     * AudioTrack constructor.
     * @param string $titre
     * @param string $nomFichier
     * @param int $duree
     * @param string $genre
     */
    public function __construct(string $titre, string $nomFichier, int $duree, string $genre)
    {
        $this->titre = $titre;
        $this->nomFichier = $nomFichier;
        $this->duree = $duree;
        $this->genre = $genre;
    }

    /**
     * @return string
     */
    public function toString():string{
        return json_encode(($this));
    }

    /**
     * @return string
     * magic method get
     */
    public function __get(string $name) {
        if (property_exists($this, $name)) {
            if ($name == "duree") {
                if ($this->duree <0) {
                    throw new InvalidPropertyValueException('durée négative', $this->duree);
                }
            }
            return $this->$name;

        } else {
            throw new InvalidPropertyValueException("variable inexistant: $name");
        }
    }

    /**
     * @param string $name
     * @param string $value
     * magic method set
     */
    public function __set(string $name, string $value) {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            throw new Exception("Invalid property: $name");
        }
    }
}