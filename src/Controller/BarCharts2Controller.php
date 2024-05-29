<?php

namespace App\Controller;

use App\Repository\DiplomeRepository;
use App\Repository\AncienEtudiantRepository;  
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BarCharts2Controller extends AbstractController
{
    #[Route('/barcharts2', name: 'app_bar_charts2')]
    public function index(DiplomeRepository $diplomeRepository,  AncienEtudiantRepository $ancienEtudiantRepository): Response
    {
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

        return $this->render('bar_charts2/index.html.twig', [
            'data' => $data,
        ]);
    }
}
 