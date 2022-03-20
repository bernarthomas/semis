<?php

namespace Metier\SemisEtPlantation;

class PrenomVO
{
    private string|null $prenom;

    public function __construct(?string $prenom)
    {
        if (empty($prenom)) {
            throw new PrenomNonVideException();
        }
        if (false === ctype_alpha(str_replace('-', '', $prenom))) {
            throw new PrenomAUniquementDesLettresException();
        }
        if (2 > strlen($prenom)) {
            throw new PrenomAMoinsDe2LettresException();
        }
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

}