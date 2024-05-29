<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AncienEtudiantRepository;
use App\Repository\FiliereRepository;
use App\Repository\DiplomeRepository;
use App\Entity\AncienEtudiant;
use App\Form\AncienEtudiantType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use DateTimeImmutable; 


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET', 'POST'])]
    public function index(Request $request, DiplomeRepository $diplomeRepository, FiliereRepository $filiereRepository, AncienEtudiantRepository $ancienEtudiantRepository, PaginatorInterface $paginator): Response
    {
            $nbChomage = $ancienEtudiantRepository->countByStatut('Chômage');
            $nbEmploye = $ancienEtudiantRepository->countByStatut('Employé');
        $nbDut = $ancienEtudiantRepository->countByDiplome('DUT');
        $nbLicence = $ancienEtudiantRepository->countByDiplome('Licence');
        $nbMaster = $ancienEtudiantRepository->countByDiplome('Master');
        $nbFonctionnaire = $ancienEtudiantRepository->countByFonctionnaire();
        $nbEntrepreneur = $ancienEtudiantRepository->countByEntrepreneur();
        $nbAutoEntrepreneur = $ancienEtudiantRepository->countByAutoEntrepreneur();

        $nbChomage = $ancienEtudiantRepository->countByStatut('Chomage');
        $nbEmploye = $ancienEtudiantRepository->countByStatut('Employé');
        $nbFonctionnaire = $ancienEtudiantRepository->countByFonctionnaire();
        $nbEntrepreneur = $ancienEtudiantRepository->countByEntrepreneur();
        $nbAutoEntrepreneur = $ancienEtudiantRepository->countByAutoEntrepreneur();

        $totalEtudiants = $ancienEtudiantRepository->countTotal();

        $pourcentageChomage = ($nbChomage / $totalEtudiants) * 100;
        $pourcentageEmploye = ($nbEmploye / $totalEtudiants) * 100;
        $pourcentageAutoEntrepreneur = ($nbAutoEntrepreneur / $totalEtudiants) * 100;
        $pourcentageEntrepreneur = ($nbEntrepreneur / $totalEtudiants) * 100;
        $pourcentageFonctionnaire = ($nbFonctionnaire / $totalEtudiants) * 100;

        $nbTotal = $ancienEtudiantRepository->countTotal(); // Récupérer le nombre total d'étudiants


                 // Récupérer toutes les filières
        $filieres = $filiereRepository->findAll();

        $filiereData = [
            'labels' => [],
            'employeCount' => [],
            'chomageCount' => [],
        ];

        foreach ($filieres as $filiere) {
            $filiereData['labels'][] = $filiere->getNom();

            // Filtrer les étudiants ayant un statut défini
            $employeCount = count($filiere->getAncienEtudiants()->filter(function($etudiant) {
                return $etudiant->getStatut() && $etudiant->getStatut()->getTypeStatut() === 'Employé';
            }));
            $chomageCount = count($filiere->getAncienEtudiants()->filter(function($etudiant) {
                return $etudiant->getStatut() && $etudiant->getStatut()->getTypeStatut() === 'Chomage';
            }));

            $filiereData['employeCount'][] = $employeCount;
            $filiereData['chomageCount'][] = $chomageCount;
        }


        
                    $diplomes = $diplomeRepository->findAll();
                    $data = [];
            
                    foreach ($diplomes as $diplome) {
                        $data['labels'][] = $diplome->getNom();
                    
                        // Filtrer les étudiants ayant un statut défini
                        $employeCount = count($diplome->getAncienEtudiants()->filter(function($etudiant) {
                            return $etudiant->getStatut() !== null && $etudiant->getStatut()->getTypeStatut() === 'Employé';
                        }));
                        $chomageCount = count($diplome->getAncienEtudiants()->filter(function($etudiant) {
                            return $etudiant->getStatut() !== null && $etudiant->getStatut()->getTypeStatut() === 'Chomage';
                        }));
                    
                        $data['employe'][] = $employeCount;
                        $data['chomage'][] = $chomageCount;
                    }



                    $query = $request->query->get('q');
                    $tri = $request->query->get('tri');
                    $queryBuilder = $ancienEtudiantRepository->createQueryBuilder('a');
                
                    if ($query) {
                        $queryBuilder = $ancienEtudiantRepository->findByMultipleCriteria(['q' => $query]);
                    }
                
                    if ($tri === 'nom') {
                        $queryBuilder = $ancienEtudiantRepository->sortByNom();
                    } elseif ($tri === 'prenom') {
                        $queryBuilder = $ancienEtudiantRepository->sortByPrenom();
                    } elseif ($tri === 'posteOccuper') {
                        $queryBuilder = $ancienEtudiantRepository->sortByPosteOccuper();
                    } elseif ($tri === 'anneeSortie') {
                        $queryBuilder = $ancienEtudiantRepository->sortByAnneeSortie();
                    } 
                
                    $anciensEtudiants = $paginator->paginate(
                        $queryBuilder->getQuery(),
                        $request->query->getInt('page', 1),
                        5 // Nombre d'éléments par page
                    );
                
                


        return $this->render('home/index.html.twig', [
            'nbChomage' => $nbChomage,
            'nbEmploye' => $nbEmploye,
            'nbDut' => $nbDut,
            'nbLicence' => $nbLicence,
            'nbMaster' => $nbMaster,
            'nbFonctionnaire' => $nbFonctionnaire,
            'nbEntrepreneur' => $nbEntrepreneur,
            'nbAutoEntrepreneur' => $nbAutoEntrepreneur,

            'pourcentageChomage' => $pourcentageChomage,
            'pourcentageEmploye' => $pourcentageEmploye,
            'pourcentageAutoEntrepreneur' => $pourcentageAutoEntrepreneur,
            'pourcentageEntrepreneur' => $pourcentageEntrepreneur,
            'pourcentageFonctionnaire' => $pourcentageFonctionnaire,

            'ancien_etudiants' => $anciensEtudiants,

            'nbTotal' => $nbTotal, // Passer le nombre total d'étudiants au template



            'data' => $data,
            'filiereData' => $filiereData,


        ]);
    }
    

         // Votre méthode filter pour le traitement des requêtes de recherche
         public function filter(Request $request, AncienEtudiantRepository $repository): Response
         {
             $query = $request->query->get('q');
             $tri = $request->query->get('tri');
             $criteria = explode(',', $query);
         
             if ($query) {
                 // Si une requête de recherche est soumise, effectuez une recherche sur plusieurs critères
                 $anciensEtudiants = $repository->findByMultipleCriteria($criteria);
             } elseif ($tri === 'diplome') {
                 // Si le tri par diplôme est spécifié, triez les anciens étudiants par diplôme
                 $anciensEtudiants = $repository->sortByDiplome();
             } elseif ($tri === 'filiere') {
                 // Si le tri par filière est spécifié, triez les anciens étudiants par filière
                 $anciensEtudiants = $repository->sortByFiliere();
             } elseif ($tri === 'statutTravail') {
                 // Si le tri par statut de travail est spécifié, triez les anciens étudiants par statut de travail
                 $anciensEtudiants = $repository->sortByStatutTravail();
             } elseif ($tri === 'contrat') {
                 // Si le tri par contrat est spécifié, triez les anciens étudiants par contrat
                 $anciensEtudiants = $repository->sortByContrat();
             } else {
                 // Par défaut, afficher les résultats sans tri
                 $anciensEtudiants = $repository->findAll();
             }
         
             return $this->render('home/index.html.twig', [
                 'ancien_etudiants' => $anciensEtudiants,
             ]);

         }   



} 
 