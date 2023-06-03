<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(Request $request): Response
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');
        $session = $request->getSession();
        // Perform authentication
        if($session->get("l")!="t"){
        if ($email === 'admin' && $password === '1234') {
            // Redirect to the admin page
            $session->set('l','t');
            return $this->redirectToRoute('ajout');
        } else {
            // Authentication failed, show error message
            $error = new AuthenticationException('Invalid credentials.');
            $this->addFlash('error', $error->getMessage());

            // Render the login form again
            return $this->render('login/login.html.twig');
          
        }}else{
            return $this->redirectToRoute('ajout');
        }
    }
}
