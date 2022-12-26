<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Tests\Repository;

use App\Entity\Playlist;
use App\Repository\PlaylistRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of PlaylistRepositoryTest
 *
 * @author sandd
 */
class PlaylistRepositoryTest extends KernelTestCase {
    /**
     * Récupère le repository de Playlist
     * @return PlaylistRepository
     */
    public function recupRepository(): PlaylistRepository{
        self::bootKernel();
        $repository = self::getContainer()->get(PlaylistRepository::class);
        return $repository;
    }
    /**
     * Création d'une instance de Playlist 
     * @return Playlist
     */
    public function newFormation(): Playlist{
        $playlist = (new Playlist())
                ->setDescription("Utilisation de l'outil ObjectAid sous Eclipse pour..")
                ->setName("eclipse");
                
       return $playlist;
     }
     /**
      * Test de la methode add dans Playlist
      */
     public function testAddPlaylist(){
        $repository = $this->recupRepository();
        $playlist = $this->newFormation();
        $nbplaylists = $repository->count([]);
        $repository->add($playlist, true);
        $this->assertEquals($nbplaylists + 1, $repository->count([]), "erreur lors de l'ajout");
    }
     public function testRemovePlaylist(){
        $repository = $this->recupRepository();
        $playlist = $this->newFormation();
        $repository->add($playlist, true);
        $nbplaylists = $repository->count([]);
        $repository->remove($playlist, true);
        $this->assertEquals($nbplaylists- 1, $repository->count([]), "erreur lors de la suppression");        
    }
}
