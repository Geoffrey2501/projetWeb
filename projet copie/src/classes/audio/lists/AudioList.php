<?php

declare(strict_types=1);
namespace iutnc\deefy\audio\lists;
use iutnc\deefy\exception\InvalidPropertyValueException;

/**
 * Class AudioList
 */
class AudioList
{
   /**
    * @var string
    */
   private string $nom;

    /**
     * @var int
     */
   private int $nbPistes;

    /**
     * @var int
     */
   private int $dureeTotal;

    /**
     * @var array
     */
   private array $audios;

    /**
     * AudioList constructor.
     * @param string $nom
     * @param int $nbPistes
     * @param int $dureeTotal
     * @param array $audios
     */
   public function __construct(String $nom, int $nbPistes, int $dureeTotal, array $audios=[])
   {
       $this->nom = $nom;
       $this->nbPistes = $nbPistes;
       $this->dureeTotal = $dureeTotal;
       $this->audios = $audios;
   }

    /**
     * @param string $name
     * @return mixed
     * magic method __get
     */
   public function __get(string $name):mixed
   {
       if (property_exists($this, $name)) {
           return $this->$name;

       } else {
           throw new InvalidPropertyValueException("variable inexistant: $name");
       }
   }

    /**
     * @param string $name
     * @param string|array|int $value
     * magic method __set
     */
    public function __set(string $name, string|array|int $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        } else {
            throw new \iutnc\deefy\exception\InvalidPropertyValueException("variable inexistant: $name");
        }
    }
}