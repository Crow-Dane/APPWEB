<?php

namespace App\Controller;

use App\Entity\AncienEtudiant;
use App\Form\AncienEtudiantType;
use App\Repository\AncienEtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTimeImmutable; 

#[Route('/manage')]
class ManageController extends AbstractController
{
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
     
         return $this->render('manage/index.html.twig', [
             'ancien_etudiants' => $anciensEtudiants,
         ]);
     }
     
    // Modifiez la méthode index pour appeler la méthode filter lorsqu'une requête de recherche est soumise
    #[Route('/', name: 'app_manage_index', methods: ['GET', 'POST'])]
     #[Security('is_granted("ROLE_ADMIN")')]
    public function index(Request $request, AncienEtudiantRepository $ancienEtudiantRepository, PaginatorInterface $paginator): Response
    {
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
    
        return $this->render('manage/index.html.twig', [
            'ancien_etudiants' => $anciensEtudiants, 
        ]);
    }
        

    #[Route('/new', name: 'app_manage_new', methods: ['GET', 'POST'])]
     #[Security('is_granted("ROLE_ADMIN")')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ancienEtudiant = new AncienEtudiant();
        //$ancienEtudiant ->setCreatedAt(new \DateTimeImmutable());
        $form = $this->createForm(AncienEtudiantType::class, $ancienEtudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ancienEtudiant);
            $entityManager->flush();

            return $this->redirectToRoute('app_manage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('manage/new.html.twig', [
            'ancien_etudiant' => $ancienEtudiant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_manage_show', methods: ['GET'])]
    public function show(AncienEtudiant $ancienEtudiant): Response
    {
        return $this->render('manage/show.html.twig', [
            'ancien_etudiant' => $ancienEtudiant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_manage_edit', methods: ['GET', 'POST'])]
     #[Security('is_granted("ROLE_ADMIN")')]
    public function edit(Request $request, AncienEtudiant $ancienEtudiant, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AncienEtudiantType::class, $ancienEtudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_manage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('manage/edit.html.twig', [
            'ancien_etudiant' => $ancienEtudiant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_manage_delete', methods: ['POST'])]
     #[Security('is_granted("ROLE_ADMIN")')]
    public function delete(Request $request, AncienEtudiant $ancienEtudiant, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ancienEtudiant->getId(), $request->request->get('_token'))) {
            $entityManager->remove($ancienEtudiant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_manage_index', [], Response::HTTP_SEE_OTHER);
    }



}
  
