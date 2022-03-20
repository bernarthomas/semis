<?php

namespace Metier\SemisEtPlantation;

use Exception;

class LibelleDoitEtreAlphanumeriqueException extends Exception
{
    public function __construct()
    {
        parent::__construct('Le libellé doit être alphanumérique.');
    }
}