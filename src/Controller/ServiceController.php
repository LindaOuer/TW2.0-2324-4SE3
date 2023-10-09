<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    #[Route('/service/{nb}', name: 'app_service')]
    public function index($nb): Response
    {
        $services = [
            [
                'id' => 1, 'name' => 'Service 1', 'desc' => 'Description 1'
            ],
            [
                'id' => 2, 'name' => 'Service 2', 'desc' => 'Description 2'
            ]
        ];
        return $this->render('service/index.html.twig', [
            'classe' => '4SE3',
            'n' => $nb,
            'services' => $services
        ]);
    }

    #[Route('/show', name: 'service_show')]
    public function show(): Response
    {
        return $this->render(
            'service/show.html.twig'
        );
    }
}
