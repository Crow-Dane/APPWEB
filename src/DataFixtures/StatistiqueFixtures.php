<?php

namespace App\DataFixtures;

use App\Entity\Statistique;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatistiqueFixtures extends Fixture
{

    
    
        public function load(ObjectManager $manager)
        {
            // Create some statistics
            $stat1 = new Statistique();
            $stat1->setNombreEtudiantChomage(20);
            $stat1->setNombreEtudiantEmploye(30);
            $stat1->setNombreEtudiantLicence(15);
            $stat1->setNombreEtudiantDUT(10);
            $stat1->setNombreEtudiantEntrepreneur(5);
            $stat1->setNombreEtudiantFonctionneur(10);
            $stat1->setPourcentageEtudiantChomage(20);
            $stat1->setPourcentageEtudiantEmploye(30);
            $stat1->setPourcentageEtudiantAutoEntrepreneur(10);
            

            $manager->persist($stat1);
    
            $manager->flush();
        }
    
     public function getDependencies()
    {
        return [
            UsersFixtures::class,
            ContratFixtures::class,
            StatutTravailFixtures::class,

        ];
    }
}

