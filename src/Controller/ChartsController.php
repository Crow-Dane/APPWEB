<?php

namespace App\Controller;

use App\Repository\AncienEtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChartsController extends AbstractController
{
    #[Route('/charts', name: 'app_PieCharts')]
    public function index(AncienEtudiantRepository $ancienEtudiantRepository): Response
    {
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

        return $this->render('charts/index.html.twig', [
            'pourcentageChomage' => $pourcentageChomage,
            'pourcentageEmploye' => $pourcentageEmploye,
            'pourcentageAutoEntrepreneur' => $pourcentageAutoEntrepreneur,
            'pourcentageEntrepreneur' => $pourcentageEntrepreneur,
            'pourcentageFonctionnaire' => $pourcentageFonctionnaire,
        ]);
    }
}
