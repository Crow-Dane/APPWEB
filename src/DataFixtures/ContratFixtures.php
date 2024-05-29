<?php

namespace App\DataFixtures;

use App\Entity\Contrat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContratFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Create some contract types
        $contrat1 = new Contrat();
        $contrat1->setTypeContrat('CDI');
        $manager->persist($contrat1);

        $contrat2 = new Contrat();
        $contrat2->setTypeContrat('CDD');
        $manager->persist($contrat2);

        $contrat3 = new Contrat();
        $contrat3->setTypeContrat('Stage');
        $manager->persist($contrat3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UsersFixtures::class,
        ];
    }
}
