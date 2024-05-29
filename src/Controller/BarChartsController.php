<?php

namespace App\Controller;

use App\Repository\FiliereRepository;
use App\Repository\AncienEtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BarChartsController extends AbstractController
{
    #[Route('/barcharts', name: 'app_bar_charts')]
    public function index(FiliereRepository $filiereRepository, AncienEtudiantRepository $ancienEtudiantRepository): Response
    {
        // Récupérer toutes les filières
        $filieres = $filiereRepository->findAll();

        $data1 = [
            'labels' => [],
            'employe' => [],
            'chomage' => [],
        ];

        foreach ($filieres as $filiere) {
            $data1['labels'][] = $filiere->getNom();
        
            // Filtrer les étudiants ayant un statut défini
            $employeCount = count($filiere->getAncienEtudiants()->filter(function($etudiant) {
                return $etudiant->getStatut() && $etudiant->getStatut()->getTypeStatut() === 'Employé';
            }));
            $chomageCount = count($filiere->getAncienEtudiants()->filter(function($etudiant) {
                return $etudiant->getStatut() && $etudiant->getStatut()->getTypeStatut() === 'Chomage';
            }));
        
            $data1['employe'][] = $employeCount;
            $data1['chomage'][] = $chomageCount;
        }

        return $this->render('bar_charts/index.html.twig', [
            'data1' => $data1,
        ]);
    }
}
 
