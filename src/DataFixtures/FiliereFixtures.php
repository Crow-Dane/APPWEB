<?php

namespace App\DataFixtures;

use App\Entity\Filiere;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FiliereFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Create some fields of study
        $filiere1 = new Filiere();
        $filiere1->setNom('Informatique');
        $manager->persist($filiere1);

        $filiere2 = new Filiere();
        $filiere2->setNom('Génie logiciel');
        $manager->persist($filiere2);

        $filiere3 = new Filiere();
        $filiere3->setNom('Réseaux informatiques');
        $manager->persist($filiere3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UsersFixtures::class,
            ContratFixtures::class,
            StatutTravailFixtures::class,
            StatistiqueFixtures::class,
            DiplomeFixtures::class,
 
        ];
    }

}
