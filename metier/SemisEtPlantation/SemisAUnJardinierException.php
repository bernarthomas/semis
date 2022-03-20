<?php

namespace Metier\SemisEtPlantation;

use Exception;

class SemisAUnJardinierException extends Exception
{
    public function __construct()
    {
        parent::__construct('Un semis doit être affecté à un jardinier');
    }
}