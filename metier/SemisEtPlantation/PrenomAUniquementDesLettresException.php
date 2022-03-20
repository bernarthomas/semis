<?php

namespace Metier\SemisEtPlantation;

use Exception;

class PrenomAUniquementDesLettresException extends Exception
{
    public function __construct()
    {
        parent::__construct('Le prénom doit être exclusivement composé de lettres.');
    }
}