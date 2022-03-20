<?php

namespace Metier\SemisEtPlantation;

use DateTimeImmutable;

class Semis
{
    private int $uuid;
    private Jardinier|null $jardinier;
    private DateTimeImmutable|null $date;
    private int|null $nombreGraines;
    private VarieteVO|null $variete;
    private EndroitVO|null $endroit;

    public function __construct(
        ?Jardinier $jardinier = null,
        ?DateTimeImmutable $date = null,
        ?int $nombreGraines = null,
        ?VarieteVO $variete = null,
        ?EndroitVO $endroit = null
    ) {
        $this->uuid = random_int(0, PHP_INT_MAX);
        if (empty($jardinier)) {
            throw new SemisAUnJardinierException();
        }
        $this->jardinier = $jardinier;
        if (empty($date)) {
            throw new SemisAUneDateException();
        }
        $this->date = $date;
        if (empty($nombreGraines)) {
            throw new SemisAUnNombreDeGrainesException();
        }
        $this->variete = $variete;
        if (empty($variete)) {
            throw new SemisAUneVarieteException();
        }
        $this->endroit = $endroit;
        if (empty($endroit)) {
            throw new SemisAUnEndroitException();
        }
    }

    /**
     * @return int
     */
    public function getUuid(): int
    {
        return $this->uuid;
    }

    /**
     * @return Jardinier
     */
    public function getJardinier(): Jardinier
    {
        return $this->jardinier;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getNombreGraines(): int
    {
        return $this->nombreGraines;
    }

    /**
     * @return VarieteVO
     */
    public function getVariete(): VarieteVO
    {
        return $this->variete;
    }

    /**
     * @return EndroitVO
     */
    public function getEndroit(): EndroitVO
    {
        return $this->endroit;
    }
}
