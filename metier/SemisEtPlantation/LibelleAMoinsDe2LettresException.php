<?php

namespace Metier\SemisEtPlantation;

use Exception;

class LibelleAMoinsDe2LettresException extends Exception
{
    public function __construct()
    {
        parent::__construct('Le libellé ne peut pas avoir moins de deux lettres');
    }
}