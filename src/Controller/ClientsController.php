<?php

namespace App\Controller;

use App\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;


class ClientsController extends AbstractController
{
    #[Route('/clients', name: 'app_clients')]
    public function index(PersistenceManagerRegistry $doctrine): Response
    {
        $repository=$doctrine->getRepository(Client::class);
        $clients=$repository->findAll();
        return $this->render('clients/clients.html.twig',['clients'=>$clients]);
    }
}
