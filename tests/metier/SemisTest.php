<?php

namespace Tests;

use Metier\SemisEtPlantation\EndroitVO;
use Metier\SemisEtPlantation\Jardinier;
use Metier\SemisEtPlantation\LibelleAMoinsDe2LettresException;
use Metier\SemisEtPlantation\LibelleDoitEtreAlphanumeriqueException;
use Metier\SemisEtPlantation\LibelleNonVideException;
use Metier\SemisEtPlantation\PrenomAMoinsDe2LettresException;
use Metier\SemisEtPlantation\PrenomAUniquementDesLettresException;
use Metier\SemisEtPlantation\PrenomNonVideException;
use Metier\SemisEtPlantation\PrenomVO;
use Metier\SemisEtPlantation\Semis;
use Metier\SemisEtPlantation\SemisAUneDateException;
use Metier\SemisEtPlantation\SemisAUneVarieteException;
use Metier\SemisEtPlantation\SemisAUnJardinierException;
use Metier\SemisEtPlantation\SemisAUnNombreDeGrainesException;
use Metier\SemisEtPlantation\VarieteVO;
use PHPUnit\Framework\TestCase;
use DateTimeImmutable;

class SemisTest extends TestCase
{
    public function testLaVarieteDoitEtreRenseigneePourUnSemis()
    {
        $this->expectExceptionObject(new SemisAUneVarieteException());
        $jardinier = new Jardinier('Bernard');
        $maintenant = new DateTimeImmutable();
        $nombreDeGraines = 100;
        new Semis($jardinier, $maintenant, $nombreDeGraines);
        $libelleVariete = 'tomates cerises 2018';
        $variete = new VarieteVO($libelleVariete);
        $semis = new Semis($jardinier, $maintenant, $nombreDeGraines, $variete);
        $this->assertEquals($libelleVariete, $semis->getVariete()->getLibelle());
        $this->assertNotEquals("test$libelleVariete" , $semis->getVariete()->getLibelle());
    }

    public function testLeNombreDeGrainesEstObligatoirePourUnSemis()
    {
        $this->expectExceptionObject(new SemisAUnNombreDeGrainesException());
        $jardinier = new Jardinier('Bernard');
        $maintenant = new DateTimeImmutable();
        $nombreDeGraines = 100;
        new Semis($jardinier, $maintenant);
        $semis = new Semis($jardinier, $maintenant, $nombreDeGraines);
        $this->assertEquals($nombreDeGraines, $semis->getNombreGraines());
        $this->assertNotEquals(++$nombreDeGraines , $semis->getNombreGraines());
    }

    public function testLaDateEstObligatoirePourUnSemis()
    {
        $this->expectExceptionObject(new SemisAUneDateException());
        $jardinier = new Jardinier('Bernard');
        new Semis($jardinier);
        $maintenant = new DateTimeImmutable();
        $semis = new Semis($jardinier, $maintenant);
        $this->assertEquals($maintenant, $semis->getDate());
        $this->assertNotEquals(new DateTimeImmutable() , $semis->getDate());
    }

    public function testLeJardinierEstObligatoirePourUnSemis()
    {
        $this->expectExceptionObject(new SemisAUnJardinierException());
        new Semis();
        $prenom = 'Bernard';
        $jardinier = new Jardinier($prenom);
        new Semis($jardinier);
        $this->assertEquals($prenom, $jardinier->getPrenom());
        $this->assertNotEquals("Opus$prenom" , $jardinier->getPrenom());
    }

    public function testJardinierExiste()
    {
        $prenom = 'Bernard';
        $jardinier = new Jardinier($prenom);
        $this->assertNotEmpty($jardinier->getUuid());
        $this->assertEquals($prenom, $jardinier->getPrenom());
    }

    public function testJardinierSansPrenomProvoqueException()
    {
        $this->expectExceptionObject(new PrenomNonVideException());
        new Jardinier(null);
    }

    public function testJardinierAvecPrenomComportantDesCaracteresNonAlphaProvoqueException()
    {
        $this->expectExceptionObject(new PrenomAUniquementDesLettresException());
        new Jardinier('Bern@rd');
        new Jardinier('Bern1rd');
        new Jardinier('Bern.rd');
        new Jardinier(' Bernard');
    }

    public function testJardinierAvecPrenomUneLettreProvoqueException()
    {
        $this->expectExceptionObject(new PrenomAMoinsDe2LettresException());
        new Jardinier('B');
        new Jardinier('e');
    }

    public function testPrenomVOAccesseurPrenom()
    {
        $prenom = 'Aberstpone';
        $prenomVo = new PrenomVO($prenom);
        $this->assertEquals($prenom , $prenomVo->getPrenom());
        $this->assertNotEquals("Opus$prenom" , $prenomVo->getPrenom());
    }

    public function testVarieteVOAccesseurLibelle()
    {
        $libelle = 'tomates anciennes';
        $varieteVo = new VarieteVO($libelle);
        $this->assertEquals($libelle , $varieteVo->getLibelle());
        $this->assertNotEquals("Opus$libelle" , $varieteVo->getLibelle());
    }

    public function testLibelleVarieteVideException()
    {
        $this->expectExceptionObject(new LibelleNonVideException());
        new VarieteVO();
    }

    public function testLibelleVarieteDoitEtreAlphanumeriqueException()
    {
        $this->expectExceptionObject(new LibelleDoitEtreAlphanumeriqueException());
        new VarieteVO('..làà@@$ aubergine');
        $libelle = 'poivron 2022';
        $varieteVo = new VarieteVO($libelle);
        $this->assertEquals($libelle , $varieteVo->getLibelle());
    }

    public function testLibelleAvecMoinsDeDeuxLettresProvoqueException()
    {
        $this->expectExceptionObject(new LibelleAMoinsDe2LettresException());
        new VarieteVO('o');
    }

    public function testLibelleEndroitVideException()
    {
        $this->expectExceptionObject(new LibelleNonVideException());
        new EndroitVO();
    }

    public function testLibelleEndroitDoitEtreAlphanumeriqueException()
    {
        $this->expectExceptionObject(new LibelleDoitEtreAlphanumeriqueException());
        new EndroitVO('@Bureau chauffage pot');
        $libelle = 'Bureau chauffage pot';
        $endroitVo = new EndroitVO($libelle);
        $this->assertEquals($libelle , $endroitVo->getLibelle());
    }

    public function testEndroitAvecMoinsDeDeuxLettresProvoqueException()
    {
        $this->expectExceptionObject(new LibelleAMoinsDe2LettresException());
        new EndroitVO('o');
    }

    public function testEndroitVOAccesseurLibelle()
    {
        $libelle = 'bande 2';
        $endroitVo = new EndroitVO($libelle);
        $this->assertEquals($libelle , $endroitVo->getLibelle());
        $this->assertNotEquals("Opus$libelle" , $endroitVo->getLibelle());
    }

    public function testSemisAccesseurEndroitVO()
    {
        $libelleEndroit = 'bande 2';
        $semis = new Semis(
            new Jardinier('Bertrand'),
            new DateTimeImmutable(),
            150,
            new VarieteVO('Aubergine'),
            new EndroitVO($libelleEndroit)
        );
        $this->assertEquals($libelleEndroit, $semis->getEndroit()->getLibelle());
        $this->assertNotEquals("$libelleEndroit côté sud", $semis->getEndroit()->getLibelle());
    }
}