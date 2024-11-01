<?php
namespace iutnc\deefy\audio\lists;
use iutnc\deefy\exception\InvalidPropertyValueException;

class AudioList
{
   private string $nom;
   private int $nbPistes;
   private int $dureeTotal;
   private array $audios;


   public function __construct(String $nom, int $nbPistes, int $dureeTotal, array $audios=[])
   {
       $this->nom = $nom;
       $this->nbPistes = $nbPistes;
       $this->dureeTotal = $dureeTotal;
       $this->audios = $audios;
   }

   public function __get(string $name):mixed
   {
       if (property_exists($this, $name)) {
           return $this->$name;

       } else {
           throw new InvalidPropertyValueException("variable inexistant: $name");
       }
   }

    public function __set(string $name, string|array|int $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            throw new \iutnc\deefy\exception\InvalidPropertyValueException("variable inexistant: $name");
        }
    }
}