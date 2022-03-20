<?php

namespace Metier\SemisEtPlantation;

use Exception;

class SemisAUneVarieteException extends Exception
{
    public function __construct()
    {
        parent::__construct('Une variété doit être renseignée pour un semis.');
    }
}