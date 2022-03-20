<?php

namespace Metier\SemisEtPlantation;

use Exception;

class PrenomNonVideException extends Exception
{
    public function __construct()
    {
        parent::__construct('Le prénom ne peut pas être vide');
    }
}