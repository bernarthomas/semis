<?php

namespace Metier\SemisEtPlantation;

use Exception;

class SemisAUneDateException extends Exception
{
    public function __construct()
    {
        parent::__construct('Un semis a obligatoirement une date.');
    }
}