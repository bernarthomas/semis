<?php

namespace Metier\SemisEtPlantation;

class Jardinier
{
    private int $uuid;

    private PrenomVO $prenom;

    public function __construct(?string $prenom)
    {
        $this->uuid = random_int(0, PHP_INT_MAX);
        $this->prenom = new PrenomVO($prenom);
    }

    /**
     * @return int
     */
    public function getUuid(): int
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom->getPrenom();
    }

}