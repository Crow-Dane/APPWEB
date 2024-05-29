<?php

namespace App\DataFixtures;

use App\Entity\AncienEtudiant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Users;
use App\Entity\Filiere;
use App\Entity\Diplome;
use App\Entity\Contrat;
use App\Entity\StatutTravail;
use App\Entity\Statistique;

class AncienEtudiantFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Create some users
        $userAdmin = new Users();
        // Set user admin properties
        $userAdmin->setEmail('admin1@example.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword('admin_password')
            ->setNom('Admin')
            ->setPrenom('User');
        $manager->persist($userAdmin);

        // Create some ancien etudiants
        for ($i = 0; $i < 5; $i++) {
            $ancienEtudiant = new AncienEtudiant();
            $ancienEtudiant->setNom('Nom' . $i)
                ->setPrenom('Prenom' . $i)
                ->setTel('0601020304')
                ->setAnneeSortie(new \DateTimeImmutable('now'))
                ->setPosteOccuper('Poste' . $i)
                ->setUser($userAdmin); // Assigning all ancien etudiants to the admin user for simplicity

            // Add random filieres
            $filiere = new Filiere();
            $filiere->setNom('Filiere' . $i);
            $manager->persist($filiere);
            $ancienEtudiant->addFiliere($filiere);

            // Add random diplomes
            $diplome = new Diplome();
            $diplome->setNom('Diplome' . $i);
            $manager->persist($diplome);
            $ancienEtudiant->addDiplome($diplome);

            // Add random contrat
            $contrat = new Contrat();
            $contrat->setTypeContrat('CDI');
            $manager->persist($contrat);
            $ancienEtudiant->setContrat($contrat);

            // Add random statut travail
            $statutTravail = new StatutTravail();
            $statutTravail->setTypeStatut('Employé');
            $manager->persist($statutTravail);
            $ancienEtudiant->setStatut($statutTravail);

            // Add random statistique
            $statistique = new Statistique();
            // Set statistical data
            $statistique->setNombreEtudiantChomage(10)
                ->setNombreEtudiantEmploye(20)
                ->setNombreEtudiantLicence(15) // Définir cette valeur pour éviter l'erreur de contrainte d'intégrité
                ->setNombreEtudiantDUT(10)
                ->setNombreEtudiantEntrepreneur(5)
                ->setNombreEtudiantFonctionneur(10)
                ->setPourcentageEtudiantChomage(20.5)
                ->setPourcentageEtudiantEmploye(79.5)
                ->setPourcentageEtudiantAutoEntrepreneur(10);

            $manager->persist($statistique);
            $ancienEtudiant->addStatistique($statistique);

            $manager->persist($ancienEtudiant);
        }

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
            FiliereFixtures::class,
 
        ];
    }

}


