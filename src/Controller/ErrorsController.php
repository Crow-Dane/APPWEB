<?php

// src/Controller/ErrorsController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ErrorsController extends AbstractController
{
    public function accessDeniedPage(): Response
    {
        return $this->render('errors/access_denied.html.twig');
    }
}
