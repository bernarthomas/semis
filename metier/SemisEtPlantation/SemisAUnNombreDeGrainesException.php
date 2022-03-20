<?php

namespace Metier\SemisEtPlantation;

use Exception;

class SemisAUnNombreDeGrainesException extends Exception
{
    public function __construct()
    {
        parent::__construct('Un semis a obligatoirement un nombre de graines.');
    }
}