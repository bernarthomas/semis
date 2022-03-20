<?php

namespace Metier\SemisEtPlantation;

use Exception;

class PrenomAMoinsDe2LettresException extends Exception
{
    public function __construct()
    {
        parent::__construct('Le prénom ne peut pas avoir moins de deux lettres');
    }
}