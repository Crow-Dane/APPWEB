<?php

namespace App\Controller;

use App\Repository\AncienEtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RouteController extends AbstractController
{
    #[Route('/route', name: 'app_route')]
    public function index(AncienEtudiantRepository $ancienEtudiantRepository): Response
    {
        $nbChomage = $ancienEtudiantRepository->countByStatut('Chômage');
        $nbEmploye = $ancienEtudiantRepository->countByStatut('Employé');
        $nbDut = $ancienEtudiantRepository->countByDiplome('DUT');
        $nbLicence = $ancienEtudiantRepository->countByDiplome('Licence');
        $nbMaster = $ancienEtudiantRepository->countByDiplome('Master');
        $nbFonctionnaire = $ancienEtudiantRepository->countByFonctionnaire();
        $nbEntrepreneur = $ancienEtudiantRepository->countByEntrepreneur();
        $nbAutoEntrepreneur = $ancienEtudiantRepository->countByAutoEntrepreneur();
        $nbTotal = $ancienEtudiantRepository->countTotal(); // Récupérer le nombre total d'étudiants

        return $this->render('route/index.html.twig', [
            'nbChomage' => $nbChomage,
            'nbEmploye' => $nbEmploye,
            'nbDut' => $nbDut,
            'nbLicence' => $nbLicence,
            'nbMaster' => $nbMaster,
            'nbFonctionnaire' => $nbFonctionnaire,
            'nbEntrepreneur' => $nbEntrepreneur,
            'nbAutoEntrepreneur' => $nbAutoEntrepreneur,
            'nbTotal' => $nbTotal, // Passer le nombre total d'étudiants au template
        ]);
    }
}
