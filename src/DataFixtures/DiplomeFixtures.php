<?php

namespace App\DataFixtures;

use App\Entity\Diplome;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DiplomeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Create some diplomas
        $diplome1 = new Diplome();
        $diplome1->setNom('Baccalauréat');
        $manager->persist($diplome1);

        $diplome2 = new Diplome();
        $diplome2->setNom('Licence');
        $manager->persist($diplome2);

        $diplome3 = new Diplome();
        $diplome3->setNom('Master');
        $manager->persist($diplome3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UsersFixtures::class,
            ContratFixtures::class,
            StatutTravailFixtures::class,
            StatistiqueFixtures::class,
        ];
    }

}
