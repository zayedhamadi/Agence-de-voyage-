<?php

namespace App\Controller;

use App\Entity\Voyage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use App\Entity\Client;
use App\Form\ClientType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class VolsController extends AbstractController
{
    #[Route('/vols', name: 'app_vols')]
   public function index(PersistenceManagerRegistry $doctrine): Response
    {
        $repository=$doctrine->getRepository(Voyage::class);
        $voyages=$repository->findAll();
        return $this->render('vols/vols.html.twig',['voyages'=>$voyages]);
    }


    #[Route('/participate/{id}', name: 'app_participate')]
public function ajouterClient(Request $request,PersistenceManagerRegistry $doctrine,$id,EntityManagerInterface $entityManager)
{

$client = new Client();
$voyage = $entityManager->getRepository(Voyage::class)->find($id);
$client->setFkVoyage($voyage);
$form = $this->createForm(ClientType::class, $client);
$form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()) {
$em = $doctrine->getManager();
$em->persist($client);
$em->flush();
return $this->redirectToRoute('app_clients');
}
return $this->render('participate/participate.html.twig', [
'formclient' => $form->createView()
]);
}

}
