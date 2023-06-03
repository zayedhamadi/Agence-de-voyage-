<?php

namespace App\Controller;
use App\Entity\Voyage;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\VoyageType;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class AdminController extends AbstractController
{
    
        /**
* @Route("/admin", name="ajout")
*/
public function ajouterVoyage(Request $request,PersistenceManagerRegistry $doctrine)
{
    $session = $request->getSession();
    if($session->get('l')=="t"){
$voyage = new Voyage();
$form = $this->createForm(VoyageType::class, $voyage);
$form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()) {
$em = $doctrine->getManager();
$em->persist($voyage);
$em->flush();
return $this->redirectToRoute('app_vols');
}
return $this->render('admin/admin.html.twig', [
'formvol' => $form->createView()
]);
}
else{
    return $this->redirectToRoute('app_login');

}
}

#[Route('/deconn', name: 'app_deconn')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        $session->set('l','f');
        
        return $this->redirectToRoute('app_login');
    }

    #[Route('/updateVoyage/{id}', name: 'app_update')]
    public function updatevoyage(Request $request,PersistenceManagerRegistry $doctrine,$id,EntityManagerInterface $entityManager)
{
    $session = $request->getSession();
    if($session->get('l')=="t"){

$voyage = $entityManager->getRepository(Voyage::class)->find($id);
$form = $this->createForm(VoyageType::class, $voyage);
$form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()) {
$em = $doctrine->getManager();
$em->persist($voyage);
$em->flush();
return $this->redirectToRoute('app_vols');
}
return $this->render('admin/admin.html.twig', [
'formvol' => $form->createView()
]);
}
else{
    return $this->redirectToRoute('app_login');

}
}
}
