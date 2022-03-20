<?php

namespace Metier\SemisEtPlantation;

class EndroitVO
{
    private string|null $libelle;

    public function __construct(?string $libelle = null)
    {
        if (empty($libelle)) {
            throw new LibelleNonVideException();
        }
        if (false === ctype_alnum(str_replace(' ', '', $libelle))) {
            throw new LibelleDoitEtreAlphanumeriqueException();
        }
        if (2 > strlen($libelle)) {
            throw new LibelleAMoinsDe2LettresException();
        }
        $this->libelle = $libelle;
    }

    /**
     * @return string
     */
    public function getLibelle(): string
    {
        return $this->libelle;
    }

}