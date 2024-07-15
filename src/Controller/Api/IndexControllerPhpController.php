<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexControllerPhpController extends AbstractController
{
    #[Route('/api/admin', name: 'app_api_index')]
    public function index(): Response
    {
        return $this->json( [
            'controller_name' => 'IndexControllerPhpController',
        ]);
    }
}
