<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Tests\Repository;

use App\Entity\Formation;
use App\Repository\FormationRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of FormationRepositoryTest
 *
 * @author sandd
 */
class FormationRepositoryTest extends KernelTestCase {
    
   
    /**
     * Récupère le repository de Formation
     * @return FormationRepository
     */
    public function recupRepository(): FormationRepository{
        self::bootKernel();
        $repository = self::getContainer()->get(FormationRepository::class);
        return $repository;
    }
    /**
     * Création d'une instance de Formation avec ville, pays et dateCreation
     * @return Formation
     */
    public function newFormation(): Formation{
        $formation = (new Formation())
                ->setDescription("Utilisation de l'outil ObjectAid sous Eclipse pour..")
                ->setTitle("Eclipse n°2 : rétroconception avec ObjectAid")
                ->setPublishedAt(new DateTime("now")); 
       return $formation;
     }
     /**
      * Test de la methode add dans Formation
      */
     public function testAddFormation(){
        $repository = $this->recupRepository();
        $formation = $this->newFormation();
        $nbformations = $repository->count([]);
        $repository->add($formation, true);
        $this->assertEquals($nbformations + 1, $repository->count([]), "erreur lors de l'ajout");
    }
     public function testRemoveFormation(){
        $repository = $this->recupRepository();
        $formation = $this->newFormation();
        $repository->add($formation, true);
        $nbFormations = $repository->count([]);
        $repository->remove($formation, true);
        $this->assertEquals($nbFormations - 1, $repository->count([]), "erreur lors de la suppression");        
    }
   
    
}
