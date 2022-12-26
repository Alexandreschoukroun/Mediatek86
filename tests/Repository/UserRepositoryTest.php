<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Tests\Repository;

use App\Entity\Playlist;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of UserRepositoryTest
 *
 * @author sandd
 */
class UserRepositoryTest extends KernelTestCase {
   /**
     * Récupère le repository de Playlist
     * @return UserRepository
     */
    public function recupRepository(): UserRepository{
        self::bootKernel();
        $repository = self::getContainer()->get(UserRepository::class);
        return $repository;
    }
    /**
     * Création d'une instance de Playlist 
     * @return Playlist
     */
    public function newFormation(): User{
        $user = (new User())
                ->setEmail("alrl")
                ->setPassword("pascal");
                    
                
                
       return $user;
     }
     /**
      * Test de la methode add dans Playlist
      */
     public function testAddUser(){
        $repository = $this->recupRepository();
        $user = $this->newFormation();
        $nbUsers = $repository->count([]);
        $repository->add($user, true);
        $this->assertEquals($nbUsers + 1, $repository->count([]), "erreur lors de l'ajout");
    }
     public function testRemoveUser(){
        $repository = $this->recupRepository();
        $user = $this->newFormation();
        $repository->add($user, true);
        $nbUsers = $repository->count([]);
        $repository->remove($user, true);
        $this->assertEquals($nbUsers- 1, $repository->count([]), "erreur lors de la suppression");        
    }
}
