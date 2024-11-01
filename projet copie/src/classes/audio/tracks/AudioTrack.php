<?php

namespace iutnc\deefy\audio\tracks;




class AudioTrack
{
    private string $titre, $genre, $nomFichier;
    private int $duree;

    public function __construct(string $titre, string $nomFichier, int $duree, string $genre)
    {
        $this->titre = $titre;
        $this->nomFichier = $nomFichier;
        $this->duree = $duree;
        $this->genre = $genre;
    }

    public function toString():string{
        return json_encode(($this));
    }
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
    public function __set(string $name, string $value) {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            throw new Exception("Invalid property: $name");
        }
    }
}