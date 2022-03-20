<?php

namespace Metier\SemisEtPlantation;

use Exception;

class LibelleNonVideException extends Exception
{
    public function __construct()
    {
        parent::__construct('Le libellé ne peut pas être vide');
    }
}