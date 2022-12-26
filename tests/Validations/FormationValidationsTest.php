<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Tests\Validations;

use App\Entity\Formation;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use DateTime;

/**
 * Description of FormationValidationsTest
 *
 * @author sandd
 */
class FormationValidationsTest extends KernelTestCase{
    
    /**
     * Création d'un objet de type Formation, avec informations minimales
     * @return Formation
     */
    public function getFormation(): Formation{
        return (new Formation())
               ->setPublishedAt(new DateTime("now"))
               ->setTitle("formation");
               
    }
    public function testValidPublishedAt(){
        $formation = $this->getFormation()->setPublishedAt(new DateTime("now"));
        $this->assertErrors($formation, 0);
    }
    /*
     * 
     * Utilisaiton du Kernel pour tester une règle de validation
     * @param Formation $formation
     * @param int $nbErreursAttendues
     * 
     */
     
     public function assertErrors(Formation $formation, int $nbErreursAttendues){
        self::bootKernel();
        $validator = self::getContainer()->get(ValidatorInterface::class);
        $error = $validator->validate($formation);
        $this->assertCount($nbErreursAttendues, $error);
    }
}
