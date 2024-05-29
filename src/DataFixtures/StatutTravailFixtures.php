<?php

namespace App\DataFixtures;

use App\Entity\StatutTravail;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatutTravailFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Create some employment statuses
        $statut1 = new StatutTravail();
        $statut1->setTypeStatut('Étudiant');
        $manager->persist($statut1);

        $statut2 = new StatutTravail();
        $statut2->setTypeStatut('Chômeur');
        $manager->persist($statut2);

        $statut3 = new StatutTravail();
        $statut3->setTypeStatut('Employé');

        $statut4 = new StatutTravail();
        $statut4->setTypeStatut('Entrepreneur');

        $statut5 = new StatutTravail();
        $statut5->setTypeStatut('Fonctionnaire');

        $statut6 = new StatutTravail();
        $statut6->setTypeStatut('AutoEtrepreneur');
        $manager->persist($statut3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UsersFixtures::class,
            ContratFixtures::class,
        ];
    }

}
