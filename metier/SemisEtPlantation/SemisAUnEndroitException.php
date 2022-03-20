<?php

namespace Metier\SemisEtPlantation;

use Exception;

class SemisAUnEndroitException extends Exception
{
    public function __construct()
    {
        parent::__construct('Un endroit doit être renseigné pour un semis.');
    }
}